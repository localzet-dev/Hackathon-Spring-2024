<?php

namespace app\model;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Triangle\Engine\Database\Model;

/**
 * events
 * @property integer $id
 * @property mixed $created_at
 * @property string $title
 * @property string $description
 * @property string $address
 * @property mixed $is_online
 * @property string $status
 * @property mixed $date
 * @property mixed $is_public
 *
 * @property Users[] $users
 */
class Events extends Model
{
    use SoftDeletes;

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
    protected $table = 'events';

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
     * @return BelongsToMany
     */
    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Users::class);
    }

    /**
     * @return HasMany
     */
    public function feedbacks(): HasMany
    {
        return $this->hasMany(Feedbacks::class);
    }
}
