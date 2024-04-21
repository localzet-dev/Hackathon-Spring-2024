<?php

namespace app\model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Triangle\Engine\Database\Model;

/**
 * feedbacks 
 * @property integer $id
 * @property integer $event_id
 * @property integer $users_id
 * @property string $text
 */
class Feedbacks extends Model
{
    /**
     * Соединение для модели
     *
     * @var string|null
     */
    protected $connection = 'pgsql';
    
    /**
     * Таблица, связанная с моделью.
     *
     * @var string
     */
    protected $table = 'feedbacks';

    /**
     * Первичный ключ, связанный с таблицей.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Указывает, должна ли модель быть временной меткой.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $guarded = [];

    protected $with = ['users'];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(Users::class);
    }

    /**
     * @return BelongsTo
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Events::class);
    }
}
