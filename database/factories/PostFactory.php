<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{
    Post,
    User
};

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            Post::USER_ID => User::all()->random()->{User::ID},
            Post::TITLE => $this->faker->sentence(),
            Post::CONTENT => $this->faker->text(),
        ];
    }
}
