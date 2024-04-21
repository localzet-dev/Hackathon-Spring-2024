<?php

namespace app\api\controller;

use app\model\Feedbacks as Model;
use support\Request;
use support\Response;
use Throwable;
use Triangle\Engine\Exception\AuthorizationDeniedException;
use Triangle\Engine\Exception\NotFoundException;

/**
 * Список фидбэков
 * @api GET /api/feedbacks
 *
 * Отображение конкретного фидбэка
 * @api GET /api/feedbacks/{id}
 *
 * Обновление существующего фидбэка
 * @api PUT /api/feedbacks/{id}
 *
 * Удаление существующего фидбэка
 * @api DELETE /api/feedbacks/{id}
 *
 */
class Feedbacks
{
    /**
     * Список фидбэков
     * @param Request $request
     * @return Response
     * @throws Throwable
     *
     * @api GET /api/feedbacks
     *
     */
    public function index(Request $request): Response
    {
        if (!user() || !user('is_admin')) {
            throw new AuthorizationDeniedException('Только администратор может просматривать все фидбэки', 403);
        }

        $eventId = $request->get('event_id');
        $userId = $request->get('user_id');
        $type = $request->get('type');
        if ($userId) {
            $user = \app\model\Users::find($userId);
            if ($user) {
                if ($type && $type == 'latest') {
                    return response($user?->feedbacks()?->where(['event_id' => $eventId])?->orderBy('date', 'desc')?->first() ?? false);
                } else {
                    return response($user->feedbacks()?->where(['event_id' => $eventId])?->get() ?? false);
                }
            } else {
                throw new NotFoundException('Пользователь не найден', 404);
            }
        } else {
            return response(Model::all());
        }
    }

    /**
     * Отображение конкретного фидбэка
     * @param Request $request
     * @param $id
     * @return Response
     * @throws Throwable
     *
     * @api GET /api/feedbacks/{id}
     *
     */
    public function show(Request $request, $id): Response
    {
        if (!user() || !user('is_admin')) {
            throw new AuthorizationDeniedException('Только администратор может просматривать фидбэки', 403);
        }

        $user = Model::find($id);
        if ($user) {
            return response($user);
        } else {
            throw new NotFoundException('Фидбэк не найден', 404);
        }
    }

    /**
     * Обновление существующего фидбэка
     * @param Request $request
     * @param $id
     * @return Response
     * @throws Throwable
     *
     * @api PUT /api/feedbacks/{id}
     *
     */
    public function update(Request $request, $id): Response
    {
        if (!user() || !user('is_admin')) {
            throw new AuthorizationDeniedException('Только администратор может редактировать фидбэки', 403);
        }

        $user = Model::find($id);
        if ($user) {
            // TODO: Добавить ограничения полей
            return response($user->update($request->all()));
        } else {
            throw new NotFoundException('Фидбэк не найден', 404);
        }
    }

    /**
     * Удаление существующего фидбэка
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
            throw new AuthorizationDeniedException('Только администратор может удалять фидбэки', 403);
        }

        $user = Model::find($id);
        if ($user) {
            return response($user->delete());
        } else {
            throw new NotFoundException('Фидбэк не найден', 404);
        }
    }
}