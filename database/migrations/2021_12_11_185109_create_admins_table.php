<?php

use App\Models\Admin;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Admin::TABLE, function (Blueprint $table) {
            $table->increments(Admin::ID);
            $table->string(Admin::NAME);
            $table->string(Admin::EMAIL)->unique();
            $table->string(Admin::PASSWORD);
            $table->boolean(Admin::IS_SUPER_ADMIN)->default(false);
            $table->timestamps();
            $table->rememberToken();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Admin::TABLE);
    }

}
