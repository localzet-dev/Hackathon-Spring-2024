<?php

namespace app\model;

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
 */
class Events extends Model
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

    protected $fillable = ['title', 'description', 'address', 'is_online', 'status', 'date', 'is_public'];

    public function users()
    {
        return $this->belongsToMany(Users::class);
    }
}
