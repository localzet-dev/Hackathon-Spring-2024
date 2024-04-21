<?php

/**
 * @package     Triangle Web
 * @link        https://github.com/Triangle-org
 *
 * @copyright   2018-2024 Localzet Group
 * @license     https://mit-license.org MIT
 */

use support\Request;
use Triangle\Engine\Router;

Router::disableDefaultRoute();

Router::any('/profile', function () {
    include_once view_path('pages/main_pages.php');
    return mainpages_profile();
});

Router::any('/', function () {
    include_once view_path('pages/main_pages.php');
    return error_404();
});

Router::any('/admin_users', function () {
    include_once view_path('pages/main_pages.php');
    return mainpages_admin_users();
});

Router::any('/events', function () {
    include_once view_path('pages/main_pages.php');
    return mainpages_history_events();
});

Router::any('/admin_users/{id}', function ($request, $id) {
    include_once view_path('pages/main_pages.php');
    return mainpages_admin_users_byid($id);
});

Router::fallback(function () { 
    include_once view_path('pages/main_pages.php');
    return error_404();
});

Router::any('/my', function () {
    include_once view_path('pages/main_pages.php');
    return mainpages_dashboard();
});

Router::get('/tw', function () {
    return raw_view('pages/main_pages', ['name' => 'qwertyuiop[poiuytrewq']);
//    return mainpages_landing();
});

Router::group('/auth', function () {
    Router::get('', [\app\controller\Auth::class, 'index']);
    Router::get('/google', [\app\controller\Auth::class, 'google']);
    Router::get('/logout', [\app\controller\Auth::class, 'destroy']);
});

Router::group('/api', function () {
    Router::resource('users', \app\api\controller\Users::class);
    Router::resource('events', \app\api\controller\Events::class);

    Router::get('/user', [\app\api\controller\User::class, 'show']);
    Router::put('/user', [\app\api\controller\User::class, 'update']);
    Router::get('/user/events', [\app\api\controller\User::class, 'events']);

    Router::group('/push', function () {
        Router::get('/lib.js', function (Request $request) {
            return response()->file(public_path('push.js'));
        });

        Router::post('/auth', function (Request $request) {
            $pusher = new \process\PusherApi('http://127.0.0.1:3232', 'oggetto_coffee_240419', config('process.pusher.constructor.app_info.oggetto_coffee_240419.app_secret'));
            $channel_name = $request->post('channel_name');
            $session = $request->session();
            $has_authority = true;
            if ($has_authority) {
                return response($pusher->socketAuth($channel_name, $request->post('socket_id')));
            } else {
                return response('Forbidden', 403);
            }
        });

        Router::post('/hook', function (Request $request) {

            if (!$webhook_signature = $request->header('x-pusher-signature')) {
                return response('401 Not authenticated', 401);
            }

            $body = $request->rawBody();

            $expected_signature = hash_hmac('sha256', $body, config('process.pusher.constructor.app_info.oggetto_coffee_240419.app_secret'), false);

            if ($webhook_signature !== $expected_signature) {
                return response('401 Not authenticated', 401);
            }

            $payload = json_decode($body, true);

            $channels_online = $channels_offline = [];

            foreach ($payload['events'] as $event) {
                if ($event['name'] === 'channel_added') {
                    $channels_online[] = $event['channel'];
                } else if ($event['name'] === 'channel_removed') {
                    $channels_offline[] = $event['channel'];
                }
            }

            echo 'online channels: ' . implode(',', $channels_online) . "\n";
            echo 'offline channels: ' . implode(',', $channels_offline) . "\n";

            return 'OK';
        });
    });

})->middleware([
    \app\api\middleware\AuthGuarder::class
]);
