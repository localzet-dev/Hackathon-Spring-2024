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
     * События текущего пользователя
     * @param Request $request
     * @return Response
     * @throws Throwable
     * @api GET /api/user/events
     *
     */
    public function events(Request $request): Response
    {
        $user = user();
        $type = $request->get('type');
        if ($user) {
            if ($type && $type == 'latest') {
                return response($user?->events()?->with('users')?->where('week', '>=', (int)date('W', time()))?->orderBy('date', 'desc')?->first() ?? false);
            } else {
                return response($user->events()?->with('users')?->get() ?? false);
            }
        } else {
            throw new NotFoundException('Пользователь не найден', 404);
        }
    }
}
