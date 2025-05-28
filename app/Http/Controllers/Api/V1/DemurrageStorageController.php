<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DemurrageStorage;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class DemurrageStorageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /*  public function index()
    {
        //
    } */

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

        $vessel_arrival = Carbon::parse($request->vessel_arrival); //llegada
        $gate_out_full = Carbon::parse($request->gate_out_full); //salida
        $gate_in_empty = Carbon::parse($request->gate_in_empty); // retorno

        $stodays = $vessel_arrival->diffInDays($gate_out_full); //stodays
        $demdays =  $vessel_arrival->diffInDays($gate_in_empty); //demdays


        $carrier = $request->carrier;
        $port = $request->port;
        $container = $request->container; //container
        $free_storage =  $request->free_storage; //free_sto_days
        $free_demurrage = $request->free_demurrage; //free_dem_days
        $query_free_sto = '';
        $query_free_dem = '';

        $total_tariff_sto = [];
        $tariff_sto_detail = [];
        $total_value_sto = [];
        $total_tariff_dem = [];
        $tariff_dem_detail = [];
        $total_value_dem = [];



        if ($free_storage <= 0 || !is_numeric($free_storage) || $free_storage == null) {

            try {
                $query_free_sto = DemurrageStorage::where('carrier', $carrier)
                    ->where('port', $port)
                    ->where('type', 'STO')
                    ->where('fromday', 0)->get()->first();

                if (!$query_free_sto) {
                    $free_storage = 0;
                } else {
                    $free_storage = $query_free_sto['today'];
                }
            } catch (\Exception $e) {
                $query_free_sto = $e;
            }
        }

        if ($free_demurrage <= 0 || !is_numeric($free_demurrage) || $free_demurrage == null) {

            try {
                $query_free_dem = DemurrageStorage::where('carrier', $carrier)
                    ->where('port', $port)
                    ->where('type', 'DEM')
                    ->where('fromday', 0)->get()->first();

                if (!$query_free_dem) {
                    $free_demurrage = 0;
                } else {
                    $free_demurrage = $query_free_dem['today'];
                }
            } catch (\Exception $e) {
                $query_free_dem = $e;
            }
        }

        if ($container == 20)
            $container = 'tar20';
        else
            $container = 'tar40';


        $stodays = $stodays + 1;
        $demdays = $demdays + 1;
        $priced_sto = $stodays - $free_storage;
        $priced_dem = $demdays - $free_demurrage;

        if ($priced_sto  < 0) {
            $priced_sto = 0;
        }


        if ( $priced_dem < 0) {
            $priced_dem = 0;
        }

        try {
            $queryapi =  Http::get('https://api.exchangerate-api.com/v4/latest/EUR');
            $rates_USD = $queryapi['rates']['USD'];
            $rates_USD *= 1.01;
        } catch (\Exception $e) {
            $queryapi =  $e;
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
                )
                ->orderBy('fromday')->get();
            $stobool = false;
            $total_sto = 0;
            $sto_tarsup = 0;
            foreach ($querysto as $rowsto) {
                if ($rowsto['today'] > $free_storage && $rowsto['fromday'] <= $stodays) {

                    if ($free_storage == $rowsto['fromday']) {
                        $day_sto_range =  $rowsto['today'] - $rowsto['fromday'];
                    } else {
                        $day_sto_range = $rowsto['today'] - ($rowsto['fromday'] - 1);
                    }

                    if ($free_storage >= $rowsto['fromday'] && $free_storage <= $rowsto['today']) {
                        $priced_sto_range = $rowsto['today'] - $free_storage;
                    } else {
                        $priced_sto_range = $stodays - ($rowsto['fromday'] - 1);
                    }


                    $daysTariffsto = min($day_sto_range, $priced_sto_range, $priced_sto);

                    $price = $daysTariffsto . ' x ' . number_format($rowsto[$container], 2, ',', ' ') . ' €/Day';
                    $total_sto += $daysTariffsto *  $rowsto[$container];
                    $sto_tarsup = $rowsto['tarsup'];
                    array_push($total_tariff_sto, $price);
                    $stobool = true;
                }
            }



            if ($stobool) {
                $tmp = $total_sto;

                $total_sto = number_format($total_sto + $sto_tarsup, 2, ',', ' ') . ' €';
                $todal_sto_usd =  number_format(($tmp + $sto_tarsup) * $rates_USD, 2, ',', ' ') . ' $';
            } else {
                $total_sto = 0;
                $tmp = $total_sto;
                $total_sto = number_format($total_sto + $sto_tarsup, 2, ',', ' ') . ' €';
                $todal_sto_usd =  number_format(($tmp + $sto_tarsup) * $rates_USD, 2, ',', ' ') . ' $';
            }

            if ($sto_tarsup > 0) {
                $price = number_format($sto_tarsup, 2, ',', ' ') . ' € x Cont';
                array_push($total_tariff_sto, $price);
            }
            $total_value_sto = ['SPE' => $total_sto, 'USD' => $todal_sto_usd];


            foreach ($querysto as $rowsto_d) {
                if ($stodays >= $rowsto_d['fromday']) {
                    $inc = true;
                } else {
                    $inc = false;
                }
                $days = 'From ' . $rowsto_d['fromday'] . ' to ' . $rowsto_d['today'] . ' Days';
                if ($rowsto_d['tarsup'] <> 0) {
                    $detail = number_format($rowsto_d[$container], 2, ',', ' ') . ' €/Day + ' . number_format($rowsto_d['tarsup'], 2, ',', ' ') . ' € x Cont';
                } else {
                    $detail  = number_format($rowsto_d[$container], 2, ',', ' ') . ' €/Day';
                }
                array_push($tariff_sto_detail, ['included' => $inc, 'detail_sto_day_range' => $days, 'detail_sto_price' => $detail]);
            }
        } catch (\Exception $e) {
            $querysto =  $e;
        }

        $dembool = false;
        $total_dem = 0;
        $dem_tarsup = 0;
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
                )
                ->orderBy('fromday')->get();


            foreach ($querydem as $rowdem) {
                if ($rowdem['today'] > $free_demurrage && $rowdem['fromday'] <= $demdays) {

                    if ($free_demurrage == $rowdem['fromday']) {
                        $day_dem_range = $rowdem['today'] - $rowdem['fromday'];
                    } else {
                        $day_dem_range = $rowdem['today'] - ($rowdem['fromday'] - 1);
                    }

                    if ($free_demurrage >= $rowdem['fromday'] && $free_demurrage <= $rowdem['today']) {
                        $priced_dem_range = $rowdem['today'] - $free_demurrage;
                    } else {
                        $priced_dem_range = $demdays - ($rowdem['fromday'] - 1);
                    }


                    $daysTariffDem = min($day_dem_range, $priced_dem_range, $priced_dem);
                    $price = $daysTariffDem . ' x ' . number_format($rowdem[$container], 2, ',', ' ') . ' €/Day';
                    $total_dem += $daysTariffDem *  $rowdem[$container];
                    $dem_tarsup = $rowdem['tarsup'];
                    array_push($total_tariff_dem, $price);
                    $dembool = true;
                }
            }



            if ($dembool) {
                $tmp = $total_dem;

                $total_dem = number_format($total_dem + $dem_tarsup, 2, ',', ' ') . ' €';
                $todal_dem_usd =  number_format(($tmp + $dem_tarsup) * $rates_USD, 2, ',', ' ') . ' $';
            } else {
                $total_dem = 0;
                $tmp = $total_dem;
                $total_dem = number_format($total_dem + $dem_tarsup, 2, ',', ' ') . ' €';
                $todal_dem_usd =  number_format(($tmp + $dem_tarsup) * $rates_USD, 2, ',', ' ') . ' $';
            }

            if ($dem_tarsup > 0) {
                $price = number_format($dem_tarsup, 2, ',', ' ') . ' € x Cont';
                array_push($total_tariff_dem, $price);
            }
            $total_value_dem = ['SPE' => $total_dem, 'USD' => $todal_dem_usd];



            foreach ($querydem as $rowdem_d) {
                if ($demdays >= $rowdem_d['fromday']) {
                    $incd = true;
                } else {
                    $incd = false;
                }
                $daysd = 'From ' . $rowdem_d['fromday'] . ' to ' . $rowdem_d['today'] . ' Days';
                if ($rowdem_d['tarsup'] <> 0) {
                    $detaild = number_format($rowdem_d[$container], 2, ',', ' ') . ' €/Day + ' . number_format($rowdem_d['tarsup'], 2, ',', ' ') . ' € x Cont';
                } else {
                    $detaild  = number_format($rowdem_d[$container], 2, ',', ' ') . ' €/Day';
                }
                array_push($tariff_dem_detail, ['included' => $incd, 'detail_dem_day_range' => $daysd, 'detail_dem_price' => $detaild]);
            }
        } catch (\Exception $e) {
            $querydem = '' . $e;
        }




        $response = ['sto_tariff' => $total_tariff_sto,  'tariff_sto_detail' => $tariff_sto_detail,  'tariff_dem_detail' => $tariff_dem_detail, 'stodays' => $stodays, 'demdays' => $demdays, 'priced_sto' => $priced_sto, 'priced_dem' => $priced_dem, 'dem_tariff' => $total_tariff_dem, 'total_sto' => $total_value_sto, 'total_dem' => $total_value_dem];

        Log::info(response()->json($response));


        //$response = [$request->param1, $request->param2];

        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     */
    /* public function store(Request $request)
    {
        //
    } */

    /**
     * Display the specified resource.
     */
    /* public function show(string $id)
    {
        //
    } */

    /**
     * Update the specified resource in storage.
     */
    /*  public function update(Request $request, string $id)
    {
        //
    } */

    /**
     * Remove the specified resource from storage.
     */
    /* public function destroy(string $id)
    {
        //
    } */
}
