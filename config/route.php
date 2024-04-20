<?php

/**
 * @package     Triangle Web
 * @link        https://github.com/Triangle-org
 *
 * @copyright   2018-2024 Localzet Group
 * @license     https://mit-license.org MIT
 */

use Triangle\Engine\Router;

Router::disableDefaultRoute();

Router::group('/auth', function () {
    Router::get('', [\app\controller\Auth::class, 'index']);
    Router::get('/google', [\app\controller\Auth::class, 'google']);
    Router::get('/logout', [\app\controller\Auth::class, 'destroy']);
});

Router::group('/api', function () {
    Router::resource('users', \app\api\controller\Users::class);
    Router::resource('event', \app\api\controller\Events::class);

    Router::get('/user', [\app\api\controller\User::class, 'show']);
    Router::put('/user', [\app\api\controller\User::class, 'update']);

})->middleware([
    \app\api\middleware\AuthGuarder::class
]);
