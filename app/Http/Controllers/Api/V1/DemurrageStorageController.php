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
        $query_free_sto = '';
        //fromdays = gate_out_full - vessel_arrival
        //todays = gate_in_empty -gate_out_full

        $total_tariff_sto = [];
        $tariff_sto_detail = [];
        $total_tariff_dem = [];
        $tariff_dem_detail = [];


        $stodays = $vessel_arrival->diffInDays($gate_out_full) + 1;
        $demdays =  $vessel_arrival->diffInDays($gate_in_empty) + 1;
        if ($free_sto_days <= 0 || !is_numeric($free_sto_days) || $free_sto_days == null) {

            try {
                $query_free_sto = DemurrageStorage::where('carrier', $carrier)
                    ->where('port', $port)
                    ->where('type', 'STO')
                    ->where('fromday', 0)->get()->first();

                if (!$query_free_sto) {
                    $free_sto_days = 0;
                } else {
                    $free_sto_days = $query_free_sto['today'];
                }
            } catch (\Exception $e) {
                $query_free_sto = $e;
            }
        }

        if ($free_dem_days <= 0 || !is_numeric($free_dem_days) ||$free_dem_days == null) {

            try {
                $query_free_dem = DemurrageStorage::where('carrier', $carrier)
                    ->where('port', $port)
                    ->where('type', 'DEM')
                    ->where('fromday', 0)->get()->first();

                if (!$query_free_sto) {
                    $free_dem_days = 0;
                } else {
                    $free_dem_days = $query_free_dem['today'];
                }
            } catch (\Exception $e) {
                $query_free_dem = $e;
            }
        }

        if ($container == 20)
            $container = 'tar20';
        else
            $container = 'tar40';

        $priced_sto = $stodays - $free_sto_days;
        $priced_dem = $demdays - $free_dem_days;

        if ($priced_sto < 0) {
            $priced_sto = 0;
        } else {
            $priced_sto = $stodays - $free_sto_days;
        }


        if ($priced_dem < 0) {
            $priced_dem = 0;
        } else {
            $priced_dem = $demdays - $free_dem_days;
        }

        try {
            $querysto = DemurrageStorage::where('carrier', $carrier)
                ->where('port', $port)
                ->where('type', 'STO')
                ->where(
                    'valid',
                    DemurrageStorage::where('carrier', $carrier)
                        ->where('port', $port)
                        ->where('type', 'STO')
                        ->where('valid', '<',  $gate_out_full) //gate_out_full
                        ->max('valid')
                )->orderBy('fromday')->get();

            foreach ($querysto as $rowsto) {
                if ($rowsto['today'] > $free_sto_days && $rowsto['fromday'] <= $stodays) {

                    if ($free_sto_days == $rowsto['fromday']) {
                        $day_sto_range = $rowsto['today'] - $rowsto['fromday'];
                    } else {
                        $day_sto_range = $rowsto['today'] - ($rowsto['fromday'] - 1);
                    }

                    if ($free_sto_days >= $rowsto['fromday'] && $free_sto_days <= $rowsto['today']) {
                        $priced_sto_range = $rowsto['fromday'] - $free_sto_days;
                    } else {
                        $priced_sto_range = $rowsto['fromday'] - ($free_sto_days - 1);
                    }


                    $daysTariff = min($day_sto_range, $priced_sto_range, $priced_sto);
                    $price = $daysTariff . ' x ' . $rowsto[$container] . ' €/Day';

                   

                    array_push($total_tariff_sto, $price);
                }
            }


            foreach ($querysto as $rowsto_d) {
                if ($stodays >= $rowsto_d['fromday']) {
                    $inc = true;
                } else {
                    $inc = false;
                }
                $days = 'From ' . $rowsto_d['fromday'] . ' to ' . $rowsto_d['today'].' Days';
                if ($rowsto_d['tarsup'] <> 0) {
                    $detail = $rowsto_d[$container] . ' €/Day + ' . $rowsto_d['tarsup'] . ' € x Cont';
                } else {
                    $detail  = $rowsto_d[$container] . ' €/Day';
                }
                array_push($tariff_sto_detail,['included' => $inc, 'detail_sto_day_range' => $days, 'detail_sto_price' => $detail]);
                
            }
           
        } catch (\Exception $e) {
            $querysto =  $e;
        }


        try {
            $querydem = DemurrageStorage::where('carrier', $carrier)
                ->where('port', $port)
                ->where('type', 'DEM')
                ->where(
                    'valid',
                    DemurrageStorage::where('carrier', $carrier)
                        ->where('port', $port)
                        ->where('type', 'DEM')
                        ->where('valid', '<', $gate_in_empty) //gate_in_empty
                        ->max('valid')
                )->orderBy('fromday')->get();



                foreach ($querydem as $rowdem_d) {
                    if ($demdays >= $rowdem_d['fromday']) {
                        $incd = true;
                    } else {
                        $incd = false;
                    }
                    $daysd = 'From ' . $rowdem_d['fromday'] . ' to ' . $rowdem_d['today'].' Days';
                    if ($rowdem_d['tarsup'] <> 0) {
                        $detaild = $rowdem_d[$container] . ' €/Day + ' . $rowdem_d['tarsup'] . ' € x Cont';
                    } else {
                        $detaild  = $rowdem_d[$container] . ' €/Day';
                    }
                    array_push($tariff_dem_detail,['included' => $incd, 'detail_dem_day_range' => $daysd, 'detail_dem_price' => $detaild]);
                    
                }
        } catch (\Exception $e) {
            $querydem = '' . $e;
        }




        $response = [$querysto, 'sto_tariff' => $total_tariff_sto,  'tariff_sto_detail'=> $tariff_sto_detail,  'tariff_dem_detail'=> $tariff_dem_detail,'stodays' => $stodays, 'demdays' => $demdays, 'priced_sto' => $priced_sto, 'priced_dem' => $priced_dem,/* 'querysto' => $querysto, 'querydem' => $querydem, 'query_free_sto' => $query_free_sto, 'free_sto_days' => $free_sto_days  */];













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
