<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            User::NAME => $this->faker->name(),
            User::EMAIL => $this->faker->unique()->safeEmail(),
            User::PASSWORD => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            User::REMEMBER_TOKEN => Str::random(10),
        ];
    }

    /**
     * @return UserFactory
     */
    public function baseUser()
    {
        return $this->state(function (array $attributes) {
            return [
                User::NAME => 'User',
                User::EMAIL => 'user@user.com',
            ];
        });
    }
}
