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
     * @api GET /api/users
     *
     * @param Request $request
     * @return Response
     * @throws Throwable
     *
     */
    public function index(Request $request): Response
    {
        if (!user() || !user('is_admin')) {
            throw new AuthorizationDeniedException('Только администратор может просматривать всех пользователей', 403);
        }

        // Фильтрация по событиям
        $eventId = $request->get('event_id');
        if ($eventId) {
            $event = \app\model\Events::find($eventId);
            if ($event) {
                return response($event->users ?? false);
            } else {
                throw new NotFoundException('Событие не найдено', 404);
            }
        } else {
            return response(Model::all());
        }
    }

    /**
     * Создание нового пользователя
     * @api POST /api/users
     *
     * @param Request $request
     * @return Response
     * @throws Throwable
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
     * @api GET /api/users/{id}
     *
     * @param Request $request
     * @param $id
     * @return Response
     * @throws Throwable
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
     * @api PUT /api/users/{id}
     *
     * @param Request $request
     * @param $id
     * @return Response
     * @throws Throwable
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
     * @api DELETE /api/users/{id}
     *
     * @param Request $request
     * @param $id
     * @return Response
     * @throws Throwable
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
}