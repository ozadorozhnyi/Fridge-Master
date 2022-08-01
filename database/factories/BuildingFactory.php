<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Location;

class BuildingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $range = config('fridge.seed.building.temperature');

        return [
            'location_id' => fn () => Location::factory()->create()->id,
            'temperature' => mt_rand($range['min'], $range['max'])
        ];
    }
}
