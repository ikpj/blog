<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Factories\HasFactory, Relations\HasMany, SoftDeletes};
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    //table name
    public const TABLE = 'users';
    public $table = self::TABLE;

    //column of the table
    public const ID = 'id';
    public const NAME = 'name';
    public const EMAIL = 'email';
    public const EMAIL_VERIFIED_AT = 'email_verified_at';
    public const PASSWORD = 'password';
    public const REMEMBER_TOKEN = 'remember_token';
    public const DELETED_AT = 'deleted_at';


    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //relations

    /**
     * @return HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    /**
     * @param int $perPage
     * @return mixed
     */
    public static function getList(int $perPage = 10): mixed
    {
        return self::orderBy(self::ID, 'DESC')
            ->withTrashed()
            ->paginate($perPage);
    }

    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * @return false|mixed
     */
    public static function add(string $name, string $email, string $password)
    {
        $model = new self;

        $model->{self::NAME} = $name;
        $model->{self::EMAIL} = $email;
        $model->{self::PASSWORD} = Hash::make($password);

        return $model->save() ? $model->{self::ID} : false;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public static function getById(int $id): mixed
    {
        return self::withTrashed()
            ->find($id);
    }

    /**
     * @param $id
     * @param string $name
     * @param string $email
     * @param string|null $password
     * @return mixed
     */
    public static function updateAllById($id, string $name, string $email, string|null $password): mixed
    {
        $update = [
            self::NAME => $name,
            self::EMAIL => $email
        ];

        if ($password) {
            $update[self::PASSWORD] = Hash::make($password);
        }

        return self::where([
            self::ID => $id,
        ])->update($update);
    }

    /**
     * @param $id
     * @return mixed
     */
    public static function deleteById($id): mixed
    {
        $model = self::find($id);

        return $model ? $model->delete() : false;
    }

    /**
     * @return mixed
     */
    public static function total(): mixed
    {
        return self::count();
    }

    /**
     * @return mixed
     */
    public static function totalWithTrashed(): mixed
    {
        return self::withTrashed()->count();
    }

    /**
     * @param $id
     * @return bool|null
     */
    public static function restoreById($id): ?bool
    {
        $model = self::onlyTrashed()
            ->find($id);

        return $model ? $model->restore() : false;
    }
}
