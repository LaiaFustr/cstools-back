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


        $validated = $request->validate([
            'descountry' => 'required',
            'desiso' => 'required',
            'despc' => 'required',
            'oricountry' => 'required',
            'oriiso' => 'required',
            'oripc' => 'required',
        ]);

        $requ = Distance::select('distkmokay', 'distm', 'distkm', 'disttimesec')
            ->where('oripai', /* 'ES' */ $validated['oriiso'])
            ->where('despai', /* 'ES' */ $validated['desiso'])
            ->where('oricp',/* '03600' */ $validated['oripc'])
            ->where('descp', /* '12100' */ $validated['despc'])->get()->first();


        if (!$requ) {
            //aquí llamará a la api de pago

            //de momento pasa valor nulo
            $requ = Distance::select('distkmokay', 'distm', 'distkm', 'disttimesec')
                ->where('oripai', 'ES')
                ->where('despai', 'ES')
                ->where('oricp', '03600')
                ->where('descp', '12100')->get()->first();
            $requ->distkm = '-';
            $requ->distkmokay = '-';
            $requ->distm = '-';
        } else {

            $requ->distkm = $requ->distkm . ' Km';
            $requ->distkmokay =  $requ->distkmokay . ' Km';
             $requ->distm = $requ->distm . ' m';
        }

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
