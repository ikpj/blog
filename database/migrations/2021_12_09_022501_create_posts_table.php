<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\{
    Post,
    User
};

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Post::TABLE, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(Post::USER_ID);
            $table->string(Post::TITLE, 255);
            $table->text(Post::CONTENT);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign(Post::USER_ID)
                ->references(User::ID)
                ->on(User::TABLE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Post::TABLE);
    }
}
