<?php

/**
 * @package     Triangle Web
 * @link        https://github.com/Triangle-org
 *
 * @copyright   2018-2024 Localzet Group
 * @license     https://mit-license.org MIT
 */

namespace app\controller;

use support\{Request, Response};
use Throwable;

class Index
{
    /**
     * @param Request $request
     * @return Response
     * @throws Throwable
     */
    public function index(Request $request): Response
    {
        return response('Добро пожаловать в ' . config('app.name') . '!');
    }
}
