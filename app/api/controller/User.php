<?php

namespace app\api\controller;

use support\Request;
use support\Response;
use Throwable;
use Triangle\Engine\Exception\NotFoundException;

/**
 * Отображение текущего пользователя
 * @api GET /api/user
 *
 * Обновление текущего пользователя
 * @api PUT /api/user
 *
 * События текущего пользователя
 * @api GET /api/user/events
 */
class User
{
    /**
     * Отображение текущего пользователя
     * @param Request $request
     * @return Response
     * @throws Throwable
     * @api GET /api/user
     *
     */
    public function show(Request $request): Response
    {
        return response(user());
    }

    /**
     * Обновление текущего пользователя
     * @param Request $request
     * @return Response
     * @throws Throwable
     * @api PUT /api/user
     *
     */
    public function update(Request $request): Response
    {
        $fillable = ['middlename', 'sex', 'birthdate', 'about', 'meeting_agree'];
        $data = [];

        foreach ($fillable as $field) {
            if ($request->input($field)) {
                $data[$field] = $request->input($field, user($field));
            }
        }
        $resp = user()->update($data);
        user()->save();

        return response($resp);
    }

    /**
     * Создание нового события
     * @param Request $request
     * @return Response
     * @throws Throwable
     *
     * @api POST /api/user/events
     *
     */
    public function events_index(Request $request): Response
    {
        $type = $request->get('type');

        if ($type && $type == 'latest') {
            return response(user()->events()->with(['users' => function ($query) {
                $query->withTrashed();
            }])->where('week', '>=', (int)date('W', time()))->orderBy('date', 'desc')->first() ?? false);
        } else {
            return response(user()->events()->with(['users' => function ($query) {
                $query->withTrashed();
            }])->get() ?? false);
        }
    }

    /**
     * Обновление существующего события
     * @param Request $request
     * @param $id
     * @return Response
     * @throws Throwable
     *
     * @api PUT /api/user/events/{id}
     *
     */
    public function events_update(Request $request, $id): Response
    {
        $event = user()->events()->find($id);
        if ($event) {
            // TODO: Добавить ограничения полей
            return response($event->update($request->all()));
        } else {
            throw new NotFoundException('Событие не найдено', 404);
        }
    }

    /**
     * Список фидбэков
     * @param Request $request
     * @return Response
     * @throws Throwable
     *
     * @api GET /api/user/feedbacks
     *
     */
    public function feedbacks_index(Request $request): Response
    {
        $eventId = $request->get('event_id');
        $type = $request->get('type');

        if ($type && $type == 'latest') {
            return response(user()->feedbacks()?->where(['event_id' => $eventId])?->orderBy('date', 'desc')?->first() ?? false);
        } else {
            return response(user()->feedbacks()?->where(['event_id' => $eventId])?->get() ?? false);
        }
    }

    /**
     * Обновление существующего фидбэка
     * @param Request $request
     * @param $id
     * @return Response
     * @throws Throwable
     *
     * @api PUT /api/user/feedbacks/{id}
     *
     */
    public function feedbacks_update(Request $request, $id): Response
    {
        $feedback = user()->feedbacks()->find($id);
        if ($feedback) {
            // TODO: Добавить ограничения полей
            return response($feedback->update($request->all()));
        } else {
            throw new NotFoundException('Фидбэк не найден', 404);
        }
    }
}
