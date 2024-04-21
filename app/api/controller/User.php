<?php

namespace app\api\controller;

use support\Request;
use support\Response;
use Throwable;
use Triangle\Engine\Exception\NotFoundException;

/**
 * Контроллер для работы с текущим пользователем
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
        $fillableFields = ['middlename', 'sex', 'birthdate', 'about', 'meeting_agree'];
        $userData = [];

        foreach ($fillableFields as $field) {
            if ($request->input($field)) {
                $userData[$field] = $request->input($field, user($field));
            }
        }
        $updateResponse = user()->update($userData);
        user()->save();

        return response($updateResponse);
    }

    /**
     * Получение событий текущего пользователя
     * @param Request $request
     * @return Response
     * @throws Throwable
     *
     * @api GET /api/user/events
     *
     */
    public function events_index(Request $request): Response
    {
        $eventType = $request->get('type');

        if ($eventType && $eventType == 'latest') {
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
     * Обновление события текущего пользователя
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
     * Получение отзывов текущего пользователя
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
        $feedbackType = $request->get('type');

        if ($feedbackType && $feedbackType == 'latest') {
            return response(user()->feedbacks()?->where(['event_id' => $eventId])?->orderBy('date', 'desc')?->first() ?? false);
        } else {
            return response(user()->feedbacks()?->where(['event_id' => $eventId])?->get() ?? false);
        }
    }

    /**
     * Обновление отзыва текущего пользователя
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
            throw new NotFoundException('Отзыв не найден', 404);
        }
    }
}