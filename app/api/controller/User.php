<?php

namespace app\api\controller;

use support\Request;
use support\Response;
use Throwable;

/**
 * Отображение текущего пользователя
 * @api GET /api/user
 *
 * Обновление текущего пользователя
 * @api PUT /api/user
 *
 */
class User
{
    /**
     * Отображение текущего пользователя
     * @api GET /api/user
     *
     * @param Request $request
     * @return Response
     * @throws Throwable
     */
    public function show(Request $request): Response
    {
        return response(user());
    }

    /**
     * Обновление текущего пользователя
     * @api PUT /api/user
     *
     * @param Request $request
     * @return Response
     * @throws Throwable
     */
    public function update(Request $request): Response
    {
        return response(user()->update($request->all()));
    }

    /**
     * @param Request $request
     * @return Response
     * @throws Throwable
     */
    public function events(Request $request): Response
    {
        // TODO: Добавить обратную реляцию и собрать события пользователя
        return response('Фича в разработке');
    }
}
