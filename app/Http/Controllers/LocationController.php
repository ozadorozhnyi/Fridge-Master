<?php

namespace App\Http\Controllers;

use App\Http\Resources\LocationCollection;
use App\Repository\Locations as LocationRepository;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return LocationCollection
     */
    public function index(): LocationCollection
    {
        return new LocationCollection(
            (new LocationRepository())->allWithFreeBlocks()
        );
    }
}
