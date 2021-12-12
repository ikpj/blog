<?php

namespace App\Models;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\{
    Model,
    SoftDeletes,
    Factories\HasFactory,
    Relations\BelongsTo
};
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    //table name
    public const TABLE = 'posts';
    public $table = self::TABLE;

    //column of the table
    public const ID = 'id';
    public const USER_ID = 'user_id';
    public const TITLE = 'name';
    public const CONTENT = 'content';
    public const DELETED_AT = 'deleted_at';

    //Format output on columns
    protected $casts = [
        self::USER_ID => 'integer'
    ];

    //relations

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        $relation = $this->belongsTo(User::class);

        if (Auth::guard('admin')->check()) {
            $relation = $relation->withTrashed();
        }

        return $relation;
    }

    /**
     * @return bool
     */
    public function isOwner(): bool
    {
        return Auth::id() === $this->{self::USER_ID};
    }

    /**
     * @param int $userId
     * @param string $title
     * @param string $content
     * @return mixed
     */
    public static function add(int $userId, string $title, string $content): mixed
    {
        $model = new self;

        $model->{self::USER_ID} = $userId;
        $model->{self::TITLE} = $title;
        $model->{self::CONTENT} = $content;

        return $model->save() ? $model->{self::ID} : false;
    }

    /**
     * @param $id
     * @return mixed
     */
    public static function getById($id): mixed
    {
        $model = new self;

        if (Auth::guard('admin')->check()) {
            $model = $model->withTrashed();
        }

        return $model
            ->with('user:' . User::ID . ',' . User::NAME)
            ->find($id);
    }


    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public static function getPosts(int $perPage = 5): LengthAwarePaginator
    {
        return Post::with('user')
            ->orderBy(self::ID, 'DESC')
            ->paginate($perPage);
    }

    /**
     * @param $id
     * @param int $userId
     * @param string $title
     * @param string $content
     * @return mixed
     */
    public static function updateByIdAndUserId($id, int $userId, string $title, string $content): mixed
    {
        return self::where([
            self::ID => $id,
            self::USER_ID => $userId
        ])->update([
            self::TITLE => $title,
            self::CONTENT => $content
        ]);
    }

    /**
     * @param $id
     * @param string $title
     * @param string $content
     * @return mixed
     */
    public static function updateById($id, string $title, string $content): mixed
    {
        return self::where([
            self::ID => $id
        ])->update([
            self::TITLE => $title,
            self::CONTENT => $content
        ]);
    }

    /**
     * @param $id
     * @param int $userId
     * @return mixed
     */
    public static function deleteByIdAndUserId($id, int $userId): mixed
    {
        $model = self::where([
            self::ID => $id,
            self::USER_ID => $userId
        ])->first();

        return $model ? $model->delete() : false;
    }

    /**
     * @param int $perPage
     * @return mixed
     */
    public static function getList(int $perPage = 10)
    {
        return self::with('user')
            ->withTrashed()
            ->orderBy(self::ID, 'DESC')
            ->paginate($perPage);
    }

    /**
     * @param $id
     * @return mixed
     */
    public static function deleteById($id): mixed
    {
        $model = self::where([
            self::ID => $id
        ])->first();

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

    /**
     * @param $userId
     * @return bool|null
     */
    public static function deleteByUserId($userId): ?bool
    {
        $model = self::where(self::USER_ID, $userId);

        return $model ? $model->delete() : false;
    }

    /**
     * @param int $userId
     * @param int $perPage
     * @return mixed
     */
    public static function getMyPosts(int $userId, int $perPage = 1)
    {
        return self::where(self::USER_ID, $userId)
            ->orderBy(self::ID, 'DESC')
            ->paginate($perPage);
    }
}
