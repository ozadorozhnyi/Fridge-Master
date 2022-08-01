<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Location::insert(
            $this->prepare()
        );
    }

    /**
     * Prepare hardcoded location for the saving into db.
     * @return array
     */
    private function prepare():array
    {
        $now = Carbon::now();
        $hardcoded = config('fridge.seed.locations');

        return array_map(
            function ($location) use ($now, $hardcoded) {
                $location['created_at'] = $now;
                $location['updated_at'] = $now;
                return $location;
            },
            $hardcoded
        );
    }
}
