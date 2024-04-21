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
    Router::resource('feedbacks', \app\api\controller\Feedbacks::class);

    Router::get('/user', [\app\api\controller\User::class, 'show']);
    Router::put('/user', [\app\api\controller\User::class, 'update']);
    Router::get('/user/events', [\app\api\controller\User::class, 'events']);
})->middleware([
    \app\api\middleware\AuthGuarder::class
]);
