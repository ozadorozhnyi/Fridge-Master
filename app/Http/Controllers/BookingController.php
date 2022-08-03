<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Classes\Booking\Request\{
    DatesRange, SuitableBuildings, FreeBlock
};

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Calculate resource availability before creating resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function calculate(Request $request)
    {
        /*
        array:5 [
            "location_id" => "1"
            "requested_volume" => "34"
            "requested_temperature" => "-3"
            "start_date" => "2022-08-05"
            "end_date" => "2022-08-22"
        ]
        */

        // @todo: move into the repository
        $location = Location::find($request->post('location_id'));

        // checkers|middleware
        $datesRange = new DatesRange();
        $suitableBuildings = new SuitableBuildings();
        $freeBlock = new FreeBlock(
            config('fridge.block.volume')
        );

        $buildings = $suitableBuildings->check(
            $location, $request->post('requested_temperature')
        );

        dd(
            $datesRange->check($request->post('start_date'), $request->post('end_date')),
            $buildings->count(),
            $buildings->toArray(),
            $buildings->pluck('id'),
            $freeBlock->check(
                $buildings,
                $request->post('requested_volume'),
                $request->post('start_date')
            ),
            $freeBlock->blocks()->toArray()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
