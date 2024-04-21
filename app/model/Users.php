<?php

namespace app\model;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Triangle\Engine\Database\Model;

/**
 * users
 * @property integer $id
 * @property mixed $created_at
 * @property string $email
 * @property string $firstname
 * @property string $lastname
 * @property string $middlename
 * @property mixed $last_enter_date
 * @property mixed $is_admin
 * @property mixed $updated_at
 *
 * @property Events[] $events
 */
class Users extends Model
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
    protected $table = 'users';

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
    public $timestamps = true;

    protected $guarded = [];

    /**
     * @return HasMany
     */
    public function oauths(): HasMany
    {
        return $this->hasMany(Oauth::class);
    }

    /**
     * @return HasMany
     */
    public function feedbacks(): HasMany
    {
        return $this->hasMany(Feedbacks::class);
    }

    /**
     * @return BelongsToMany
     */
    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Events::class);
    }

    protected static function booting()
    {
        parent::booting();
    }
}
