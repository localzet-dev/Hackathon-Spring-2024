<?php

namespace process;

use app\model\Events as Model;
use localzet\Cron;

class Scheduler
{
    public function onServerStart()
    {
        // Каждое воскресенье
        new Cron('0 0 * * 0', function () {
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
                    'week' => date('W')
                ];

                $event = Model::create($data);

                // Назначаем событие для пары пользователей
                $users[$i]->events()->attach($event->id);
                $users[$i + 1]->events()->attach($event->id);

                // Сбрасываем их мнения
                $users[$i]->update(['meeting_agree' => false]);
                $users[$i + 1]->update(['meeting_agree' => false]);
            }
        });
    }
}