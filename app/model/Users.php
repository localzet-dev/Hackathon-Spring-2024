<?php

namespace app\model;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
 */
class Users extends Model
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

    protected $fillable = ['email', 'firstname', 'lastname', 'middlename', 'last_enter_date', 'is_admin'];

    /**
     * @return HasMany
     */
    public function oauths(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Oauth::class);
    }

    /**
     * @return BelongsToMany
     */
    public function events(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Events::class);
    }
}
