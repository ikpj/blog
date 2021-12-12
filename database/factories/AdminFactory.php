<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Admin;

class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            Admin::NAME => $this->faker->name(),
            Admin::EMAIL => $this->faker->unique()->safeEmail(),
            Admin::PASSWORD => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            Admin::REMEMBER_TOKEN => Str::random(10),
            Admin::IS_SUPER_ADMIN => false
        ];
    }

    /**
     * Set super admin
     *
     * @return Factory
     */
    public function superAdmin(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                Admin::NAME => 'Super Admin',
                Admin::EMAIL => 'super@admin.com',
                Admin::IS_SUPER_ADMIN => true
            ];
        });
    }

    /**
     * Set base admin
     *
     * @return Factory
     */
    public function baseAdmin(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                Admin::NAME => 'Base Admin',
                Admin::EMAIL => 'base@admin.com',
            ];
        });
    }


}
