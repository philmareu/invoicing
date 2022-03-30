<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
        ];
    }

    public function owner()
    {
        return $this->state(fn ($attributes) => [
            'slug' => 'owner',
            'role' => 'Owner'
        ]);
    }
}
