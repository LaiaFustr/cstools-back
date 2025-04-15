<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Distance;

class DistanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $distance = Distance::all();
        return response()->json($distance);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(Request $request)
    {
        /* $request->oricountry $request->oriiso, $request->descountry, $request->desiso, $request->oripc, $request->despc, $request->oritown, $request->destown */


        //$distance = Distance::all();


        $requ = Distance::select('distkmokay', 'distm', 'distkm', 'disttimesec')
            ->where('oripai', 'ES'/* $request->oriiso */)
            ->where('despai', 'ES'/* $request->desiso */)
            ->where('oricp','03600' /* $request->oripc */)
            ->where('descp', '12100'/* $request->despc */)->get()->first();


        //$requ['distance'] = 'Falta la query y listoo';


        return response()->json($requ);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
