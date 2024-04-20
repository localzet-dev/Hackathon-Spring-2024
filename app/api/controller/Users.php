<?php

namespace app\api\controller;

use app\model\Users as Model;
use support\Request;
use support\Response;
use Throwable;
use Triangle\Engine\Exception\AuthorizationDeniedException;
use Triangle\Engine\Exception\InvalidInputException;
use Triangle\Engine\Exception\NotFoundException;

/**
 * Список пользователей
 * @api GET /api/users
 *
 * Создание нового пользователя
 * @api POST /api/users
 *
 * Отображение конкретного пользователя
 * @api GET /api/users/{id}
 *
 * Обновление существующего пользователя
 * @api PUT /api/users/{id}
 *
 * Удаление существующего пользователя
 * @api DELETE /api/users/{id}
 *
 */
class Users
{
    /**
     * Список пользователей
     * @param Request $request
     * @return Response
     * @throws Throwable
     * @api GET /api/users
     *
     */
    public function index(Request $request): Response
    {
        return response(Model::all());
    }

    /**
     * Создание нового пользователя
     * @param Request $request
     * @return Response
     * @throws Throwable
     * @api POST /api/users
     *
     */
    public function store(Request $request): Response
    {
        if (!user() || !user('is_admin')) {
            throw new AuthorizationDeniedException('Только администратор может создавать пользователей', 403);
        }

        $data = $request->all();
        $user = Model::firstWhere(['email' => $data['email']]);
        if ($user) {
            throw new InvalidInputException('Пользователь с такой почтой уже существует', 400);
        } else {
            // TODO: Добавить ограничения полей
            return response(Model::create($data));
        }
    }

    /**
     * Отображение конкретного пользователя
     * @param Request $request
     * @param $id
     * @return Response
     * @throws Throwable
     * @api GET /api/users/{id}
     *
     */
    public function show(Request $request, $id): Response
    {
        $user = Model::find($id);
        if ($user) {
            return response($user);
        } else {
            throw new NotFoundException('Пользователь не найден', 404);
        }
    }

    /**
     * Обновление существующего пользователя
     * @param Request $request
     * @param $id
     * @return Response
     * @throws Throwable
     * @api PUT /api/users/{id}
     *
     */
    public function update(Request $request, $id): Response
    {
        if (!user() || !user('is_admin')) {
            throw new AuthorizationDeniedException('Только администратор может редактировать пользователей', 403);
        }

        $user = Model::find($id);
        if ($user) {
            // TODO: Добавить ограничения полей
            return response($user->update($request->all()));
        } else {
            throw new NotFoundException('Пользователь не найден', 404);
        }
    }

    /**
     * Удаление существующего пользователя
     * @param Request $request
     * @param $id
     * @return Response
     * @throws Throwable
     * @api DELETE /api/users/{id}
     *
     */
    public function destroy(Request $request, $id): Response
    {
        if (!user() || !user('is_admin')) {
            throw new AuthorizationDeniedException('Только администратор может удалять пользователей', 403);
        }

        $user = Model::find($id);
        if ($user) {
            return response($user->delete());
        } else {
            throw new NotFoundException('Пользователь не найден', 404);
        }
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