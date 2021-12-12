<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\App;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //for testing
        if (App::environment(['local', 'staging'])) {
            //one default account
            User::factory(1)->baseUser()->create();
            User::factory(24)->create();
        }
    }
}
