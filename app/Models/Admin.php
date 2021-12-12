<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Admin extends Authenticatable
{
    use HasFactory, SoftDeletes;

    //table name
    public const TABLE = 'admins';
    public $table = self::TABLE;

    //column of the table
    public const ID = 'id';
    public const NAME = 'name';
    public const EMAIL = 'email';
    public const PASSWORD = 'password';
    public const REMEMBER_TOKEN = 'remember_token';
    public const DELETED_AT = 'deleted_at';
    public const IS_SUPER_ADMIN = 'is_super_admin';

    /**
     * @param int $id
     * @return mixed
     */
    public static function getById(int $id)
    {
        return self::withTrashed()->find($id);
    }

    /**
     * @param $id
     * @param string $name
     * @param string $email
     * @return mixed
     */
    public static function updateById($id, string $name, string $email): mixed
    {
        return self::where([
            self::ID => $id,
        ])->update([
            self::NAME => $name,
            self::EMAIL => $email
        ]);
    }

    /**
     * @param $id
     * @param string $password
     * @return mixed
     */
    public static function updatePasswordById($id, string $password): mixed
    {
        return self::where([
            self::ID => $id,
        ])->update([
            self::PASSWORD => Hash::make($password)
        ]);
    }

    /**
     * @param int $perPage
     * @return mixed
     */
    public static function getList(int $perPage = 10)
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
