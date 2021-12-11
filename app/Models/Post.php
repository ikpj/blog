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
        return $this->belongsTo(User::class);
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
        return self::with('user')
            ->find($id);
    }

    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public static function getPosts(int $perPage = 5): LengthAwarePaginator
    {
        return Post::with('user')
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
}
