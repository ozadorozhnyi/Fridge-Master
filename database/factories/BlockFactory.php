<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Building;

class BlockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $rent_price_range = config('fridge.seed.blocks.price');

        return [
            'building_id' => fn () => Building::factory()->create()->id,
            'current_rent_price' => $this->faker->randomFloat(
                2, $rent_price_range['min'], $rent_price_range['max']
            ),
        ];
    }
}
