<?php

namespace app\api\controller;

use app\model\Events as Model;
use support\Request;
use support\Response;
use Throwable;
use Triangle\Engine\Exception\AuthorizationDeniedException;
use Triangle\Engine\Exception\NotFoundException;

/**
 * Список событий
 * @api GET /api/events
 *
 * Создание нового события
 * @api POST /api/events
 *
 * Отображение конкретного события
 * @api GET /api/events/{id}
 *
 * Обновление существующего события
 * @api PUT /api/events/{id}
 *
 * Удаление существующего события
 * @api DELETE /api/events/{id}
 *
 */
class Events
{
    /**
     * Список событий
     * @param Request $request
     * @return Response
     * @throws Throwable
     *
     * @api GET /api/events
     *
     */
    public function index(Request $request): Response
    {
        // TODO: Сделать фильтрацию по пользователям
        return response(Model::all());
    }

    /**
     * Создание нового события
     * @param Request $request
     * @return Response
     * @throws Throwable
     *
     * @api POST /api/events
     *
     */
    public function store(Request $request): Response
    {
        if (!user() || !user('is_admin')) {
            throw new AuthorizationDeniedException('Только администратор может создавать события', 403);
        }

        // TODO: Реализовать рандомную генерацию событий
        return response('Фича в разработке');
    }

    /**
     * Отображение конкретного события
     * @param Request $request
     * @param $id
     * @return Response
     * @throws Throwable
     *
     * @api GET /api/events/{id}
     *
     */
    public function show(Request $request, $id): Response
    {
        $user = Model::find($id);
        if ($user) {
            // TODO: Создать реляцию и добавить with для парсинга сотрудников
            return response($user);
        } else {
            throw new NotFoundException('Событие не найдено', 404);
        }
    }

    /**
     * Обновление существующего события
     * @param Request $request
     * @param $id
     * @return Response
     * @throws Throwable
     *
     * @api PUT /api/events/{id}
     *
     */
    public function update(Request $request, $id): Response
    {
        $user = Model::find($id);
        if ($user) {
            // TODO: Добавить ограничения полей
            return response($user->update($request->all()));
        } else {
            throw new NotFoundException('Событие не найдено', 404);
        }
    }

    /**
     * Удаление существующего события
     * @param Request $request
     * @param $id
     * @return Response
     * @throws Throwable
     *
     * @api DELETE /api/events/{id}
     *
     */
    public function destroy(Request $request, $id): Response
    {
        if (!user() || !user('is_admin')) {
            throw new AuthorizationDeniedException('Только администратор может удалять события', 403);
        }

        $user = Model::find($id);
        if ($user) {
            return response($user->delete());
        } else {
            throw new NotFoundException('Событие не найдено', 404);
        }
    }
}