<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $last = Customer::orderBy('id', 'desc')->first();

        return [
            'id' => $last->id + 1,
        	'name' => $this->faker->name(),
        	'phone' => '(258) 846563885'
        ];
    }
}
