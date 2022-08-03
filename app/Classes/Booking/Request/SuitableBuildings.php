<?php

namespace App\Classes\Booking\Request;

use App\Models\Location;
use App\Repository\Buildings as BuildingRepository;
use Illuminate\Support\Collection;

class SuitableBuildings extends BookingRequest
{
    /**
     * Get count of buildings with suitable temperature for the specified location.
     *
     * @param Location $location
     * @param int $temperature
     * @return Collection
     */
    public function check(Location $location, int $temperature): Collection
    {
        return (new BuildingRepository)->withSuitableTemperaturesCount(
            $location->id, $this->getSuitableValues($temperature)
        );
    }
    /**
     * Compute allowed temperatures, “do not cross the border” 0°C
     *
     * @param int $temperature
     * @return array
     */
    private function getSuitableValues(int $temperature): array
    {
        $allowed = [];

        $min = 0;
        $max = 0;

        if (0 == $temperature) {
            $min = 0;
            $max = $min + 2;
        } else if ($temperature < 0) {
            $min = $temperature - 2;
            $max = ($temperature + 1 == 0)? 0 : $temperature + 2;
        } else if ($temperature > 0) {
            $min = ($temperature - 1 == 0)? 0 : $temperature - 2;
            $max = $temperature + 2;
        }

        // hold all suitable values
        for($i = $min; $i <= $max; $i++) {
            $allowed[] = $i;
        }

        return $allowed;
    }

}
