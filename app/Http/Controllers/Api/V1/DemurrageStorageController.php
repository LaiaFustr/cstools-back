<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DemurrageStorage;

class DemurrageStorageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function indexCarrier()
    {

        /* dd(DemurrageStorage::select('carrier')->distinct()->get()); */
        return response()->json(DemurrageStorage::select('carrier')->distinct()->get());
    }

    public function indexPorts()
    {
        return response()->json(DemurrageStorage::select('port')->distinct()->get());
    }



    public function portsWhereCarrier($carrier)
    {

        return response()->json(DemurrageStorage::select('port')->where('carrier', $carrier)->distinct()->get());
    }

    public function carriersWherePort($port)
    {
        return response()->json(DemurrageStorage::select('carrier')->where('port', $port)->distinct()->get());
    }

    public function calcRes(Request $request)
    {
        $vessel_arrival = request('vessel_arrival');
        $gate_out_full = request('gate_out');
        $gate_empty = request('gate_empty');

        $carrier = request('carrier');
        $port = request('port');
        $fromday = 0;
        $today = 0;

        $type = request('type');
        $freeSto = request('freeSto');
        $freeDem = request('freeDem');

        if (request('tar20')) {
            $tar = request('tar20');
        } else {
            $tar = request('tar40');
        }

        $tarsup = request('tarsup');

        $today = $vessel_arrival - $gate_out_full;

        $storage = DemurrageStorage::where('carrier', $carrier)
            ->where('port', $port)
            ->where('fromday', '<=', 0)
            ->where('today', '>=', $today)
            ->where('type', 'STO')
            ->get();

        $demurrage = DemurrageStorage::where('carrier', $carrier)
            ->where('port', $port)
            ->where('fromday', '<=', $fromday)
            ->where('today', '>=', $today)
            ->where('type', 'DEM')
            ->get();



        return response()->json($storage, $demurrage);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
