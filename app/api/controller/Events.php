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
 * Создание новых событий
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
        if (!user() || !user('is_admin')) {
            throw new AuthorizationDeniedException('Только администратор может просматривать все события', 403);
        }

        $userId = $request->get('user_id');
        $type = $request->get('type');
        if ($userId) {
            $user = \app\model\Users::find($userId);
            if ($user) {
                if ($type && $type == 'latest') {
                    return response($user->events()->with(['users' => function ($query) {
                        $query->withTrashed();
                    }])->where('week', '>=', (int)date('W', time()))->orderBy('date', 'desc')->first() ?? false);
                } else {
                    return response($user->events()->with(['users' => function ($query) {
                        $query->withTrashed();
                    }])->get() ?? false);
                }
            } else {
                throw new NotFoundException('Пользователь не найден', 404);
            }
        } else {
            return response(Model::all());
        }
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

        // Получаем всех пользователей и перемешиваем их
        $users = \app\model\Users::where(['status' => 'active', 'meeting_agree' => true])->get();
        $users = $users->shuffle();

        // Создаем события для каждой пары пользователей
        for ($i = 0; $i < count($users) - 1; $i += 2) {
            $data = [
                'title' => 'Встреча',
                'address' => 'Кофепоинт',
                'is_online' => false,
                'status' => 'pending',
                'date' => date_create('+3 days'),
                'is_public' => false,
                'week' => (int)date('W', time())
            ];

            $event = Model::create($data);

            // Назначаем событие для пары пользователей
            $users[$i]->events()->attach($event->id);
            $users[$i + 1]->events()->attach($event->id);

            // Сбрасываем их мнения
//            $users[$i]->update(['meeting_agree' => false]);
//            $users[$i + 1]->update(['meeting_agree' => false]);
        }

        return response('События успешно созданы');
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
        if (!user() || !user('is_admin')) {
            throw new AuthorizationDeniedException('Только администратор может просматривать события', 403);
        }

        $user = Model::find($id);
        if ($user) {
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
        if (!user() || !user('is_admin')) {
            throw new AuthorizationDeniedException('Только администратор может редактировать события', 403);
        }

        $user = Model::find($id);
        if ($user) {
            // TODO: Добавить ограничения полей
            return response($user->update($request->post()));
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