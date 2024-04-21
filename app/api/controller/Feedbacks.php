<?php

namespace app\api\controller;

use app\model\Feedbacks as FeedbackModel;
use support\Request;
use support\Response;
use Throwable;
use Triangle\Engine\Exception\AuthorizationDeniedException;
use Triangle\Engine\Exception\NotFoundException;

/**
 * Контроллер для работы с отзывами
 */
class Feedbacks
{
    /**
     * Получение списка отзывов
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
            throw new AuthorizationDeniedException('Только администратор может просматривать все отзывы', 403);
        }

        $eventId = $request->get('event_id');
        $userId = $request->get('user_id');
        $feedbackType = $request->get('type');

        if ($userId) {
            $user = \app\model\Users::find($userId);
            if ($user) {
                if ($feedbackType && $feedbackType == 'latest') {
                    return response($user?->feedbacks()?->where(['event_id' => $eventId])?->orderBy('date', 'desc')?->first() ?? false);
                } else {
                    return response($user->feedbacks()?->where(['event_id' => $eventId])?->get() ?? false);
                }
            } else {
                throw new NotFoundException('Пользователь не найден', 404);
            }
        } else {
            return response(FeedbackModel::all());
        }
    }

    /**
     * Отображение конкретного отзыва
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
            throw new AuthorizationDeniedException('Только администратор может просматривать отзывы', 403);
        }

        $feedback = FeedbackModel::find($id);
        if ($feedback) {
            return response($feedback);
        } else {
            throw new NotFoundException('Отзыв не найден', 404);
        }
    }

    /**
     * Обновление существующего отзыва
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
            throw new AuthorizationDeniedException('Только администратор может редактировать отзывы', 403);
        }

        $feedback = FeedbackModel::find($id);
        if ($feedback) {
            // TODO: Добавить ограничения полей
            return response($feedback->update($request->all()));
        } else {
            throw new NotFoundException('Отзыв не найден', 404);
        }
    }

    /**
     * Удаление существующего отзыва
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
            throw new AuthorizationDeniedException('Только администратор может удалять отзывы', 403);
        }

        $feedback = FeedbackModel::find($id);
        if ($feedback) {
            return response($feedback->delete());
        } else {
            throw new NotFoundException('Отзыв не найден', 404);
        }
    }
}