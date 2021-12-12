<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\App;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //two default account on any env, one super, one base
        Admin::factory(1)->superAdmin()->create();
        Admin::factory(1)->baseAdmin()->create();
        //for testing
        if (App::environment(['local', 'staging'])) {
            Admin::factory(23)->create();
        }
    }
}
