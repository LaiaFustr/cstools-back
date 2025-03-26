<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DemurrageStorage;
use DateTime;
use Carbon\Carbon;

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
        //request debe tener los campos de demurragestorage (carrier, port, date, type)

        $vessel_arrival = Carbon::parse($request->vessel_arrival);
        $gate_out_full = Carbon::parse($request->gate_out_full);
        $gate_in_empty = Carbon::parse($request->gate_in_empty);

        $carrier = $request->carrier;
        $port = $request->port;
        $container = $request->container;
        $free_sto_days = $request->free_sto_days;
        $free_dem_days = $request->free_days_dem;

        //fromdays = gate_out_full - vessel_arrival
        //todays = gate_in_empty -gate_out_full

        /*  $tariffsto = [];
        $tariffdem = []; */

        $stodays = $vessel_arrival->diffInDays($gate_out_full);
        $demdays =  $gate_out_full->diffInDays($gate_in_empty);

        $priced_sto = $stodays - $request->free_storage;
        if ($priced_sto < 0)
            $priced_sto = 0;
        $priced_dem = $demdays - $request->free_demurrage;
        if ($priced_dem < 0)
            $priced_dem = 0;


        /* Esta es storage */

        /* select * from CENGEBADAD.QSDEMSTO q 
        inner join (
        select max(DSVALID) as DSVALID, DSCARRIER, DSPORT, DSTYPE
        from CENGEBADAD.QSDEMSTO t 
        where DSCARRIER = '" . $_POST['carrier_calc'] . "' and DSPORT = '" . $_POST['port_calc'] . "' and DSTYPE = 'STO' and DSVALID < '" . $_POST['gate_out_full'] . "' 
        group by DSCARRIER, DSPORT, DSTYPE) tmp on tmp.DSVALID = q.DSVALID
        where q.DSCARRIER = '" . $_POST['carrier_calc'] . "' and q.DSPORT = '" . $_POST['port_calc'] . "' and q.DSTYPE = 'STO' order by FROM */


        /* Esta es demurrage */

        /* select * from demurrage_storages q 
        inner join (
        select max(valid) as valid, carrier, port, type
        from demurrage_storages t 
        where carrier = 'HAPAG' and port = 'ALMERIA' and type = 'DEM' and valid < '2025-10-10' 
        group by carrier, port, type) tmp on tmp.valid = q.valid
        where q.carrier = 'HAPAG' and q.port = 'ALMERIA' and q.type = 'DEM'  order by fromday; */
        try {
            $subquery = DemurrageStorage::where('carrier', $carrier)
                ->where('port', $port)
                ->where('type', 'STO')
                ->where('valid', '>', $gate_in_empty)
                ->groupBy('carrier', 'port', 'type')
                ->pluck('valid')->max();

            $tariffsto = DemurrageStorage::where('carrier', $carrier)
                ->where('port', $port)
                ->where('type', 'STO')
                ->where('valid', $subquery)
                ->orderBy('fromday')->get();
        } catch (\Exception $e) {
            $tariffsto = 'No hay tarifas';
        }





        $response = [/* $vessel_arrival, $gate_out_full, $gate_in_empty, */$stodays, $demdays, $priced_sto, $priced_dem, $tariffsto];













        //$response = [$request->param1, $request->param2];

        return response()->json($response);
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
