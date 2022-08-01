<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Building;
use App\Models\Block;

class BlockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $blocks_range = config('fridge.seed.blocks.range');
        Building::all()->each(
            function($building) use ($blocks_range) {
                $blocks_quantity = mt_rand($blocks_range['min'], $blocks_range['max']);
                $building->blocks()->saveMany(
                    Block::factory()->count($blocks_quantity)->create([
                        'building_id' => $building,
                    ])
                );
            }
        );
    }
}
