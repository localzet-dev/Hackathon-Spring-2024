<?php

namespace app\model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Triangle\Engine\Database\Model;

/**
 * oauth
 * @property integer $id
 * @property string $provider
 * @property string $identifier
 * @property string $websiteurl
 * @property string $profileurl
 * @property string $photourl
 * @property string $displayname
 * @property string $description
 * @property string $firstname
 * @property string $lastname
 * @property string $middlename
 * @property string $gender
 * @property string $language
 * @property string $age
 * @property string $birthday
 * @property string $birthmonth
 * @property string $birthyear
 * @property string $email
 * @property string $emailverified
 * @property string $phone
 * @property string $address
 * @property string $country
 * @property string $region
 * @property string $city
 * @property string $zip
 * @property integer $user_id
 */
class Oauth extends Model
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
    protected $table = 'oauth';

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

    protected $fillable = ["provider", "identifier", "websiteurl", "profileurl", "photourl", "displayname", "description", "firstname", "lastname", "middlename", "gender", "language", "age", "birthday", "birthmonth", "birthyear", "email", "emailverified", "phone", "address", "country", "region", "city", "zip"];

    /**
     * @return BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Users::class);
    }
}
