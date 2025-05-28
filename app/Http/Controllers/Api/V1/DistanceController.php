<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Distance;
use App\Models\Postalcode;
use App\Models\Country;
use Illuminate\Support\Facades\Http;

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
        /*  $oricountry = $validated['oricountry'];
        $descountry = $validated['descountry']; */
        $oriiso = $validated['oriiso'];
        $desiso = $validated['desiso'];
        $oripc = $validated['oripc'];
        $despc = $validated['despc'];
        /*  try { */
        $requ = Distance::select('distkmokay', 'distm', 'distkm', 'disttimesec')
            ->where('oripai',  $oriiso) //'ES'
            ->where('despai',  $desiso) //'ES'
            ->where('oricp', $oripc) //'03600'
            ->where('descp',  $despc)->first(); // '12100' 
        $requ = $requ->toArray();
        /* } catch (\Exception $e) {
           $requ = [
                'error' => 'Error al consultar la distancia: ' . $e->getMessage(),
                'status' => 'error',
                'distkmokay' => '0',
                'distm' => '0',
            ];
        } */


        if (count($requ) > 0) {
            //convertir campos a campos con unidades (km, m, m/s)
            if ($requ['distkmokay'] != 0)
                $requ['distkmokay'] = $requ['distkmokay'] . ' km';
            $requ['distm'] = $requ['distm'] . ' m';
            $requ['distkm'] = $requ['distkm'] . ' km';
            $requ['disttimesec'] = date('H:i:s', mktime(0, 0, $requ['disttimesec']));
        } else {

            $oricountry = str_replace(' ', '%20', Country::where('papaicod', $validated['oriiso'])->value('papainome')); //sacar nombre en inglés
            $descountry = str_replace(' ', '%20', Country::where('papaicod', $validated['desiso'])->value('papainome')); //sacar nombre en inglés
            $oritown =  str_replace(' ', '%20', Postalcode::where('cpstrpcori', $validated['oripc'])->where('cpendpcori', $validated['oripc'])->where('cpcouid', $oriiso)->value('cptownm'));
            $destown =  str_replace(' ', '%20', Postalcode::where('cpstrpcori', $validated['despc'])->where('cpendpcori', $validated['despc'])->where('cpcouid', $desiso)->value('cptownm'));

            /*  $requ = $destown; */
            $apidist = Http::withOptions(
                [
                    'verify' => false,
                ]
            )->get('https://api.distancematrix.ai/maps/api/distancematrix/json?origins=' . $oritown . ',' . $oripc . ',' . $oricountry . '&destinations=' . $destown . ',' . $despc . ',' . $descountry . '&key=tWA1vz82hpZKSmwRHBuL5bY9lAOufJ2LPEnjEw4Q46b6bkoq5iKZDOcHgkH7kJf5'); //5
            $response = $apidist->json();

            /*  $requ =$oricountry; */
            try {
                if (count($response) > 0) {
                    /*  $requ = $response; */
                    if (isset($response['origin_addresses'][0])) {
                        $orinom = $response['origin_addresses'][0];
                        /* try {
                            Postalcode::where('cpstrpcori', $oripc)
                                ->where('cpendpcori', $oripc)
                                ->where('cpcouid', $oriiso)
                                ->first();
                        } catch (\Exception $e) {
                            Postalcode::create([
                                'cpcouid' => $oriiso,
                                'cptownm' => strtoupper($orinom),
                                'cptownmori' => strtoupper($orinom),
                                'cpstrpcori' => $oripc,
                                'cpendpcori' => $oripc,
                                'cpstrpc' => $oripc,
                                'cpendpc' => $oripc,
                            ]);
                        } */
                    } else
                        $orinom = '';
                    if (isset($response['destination_addresses'][0]))
                        $desnom =  $response['destination_addresses'][0];
                    else
                        $desnom = '';
                    if (isset($response['rows'][0]['elements'][0]['distance']['value']))
                        $distm = $response['rows'][0]['elements'][0]['distance']['value'];
                    else
                        $distm = 0;
                    if (isset($response['rows'][0]['elements'][0]['duration']['value']))
                        $disttimesec = $response['rows'][0]['elements'][0]['duration']['value'];
                    else
                        $disttimesec = null;
                    if (isset($response['status']))
                        $status = $response['status'];
                    else
                        $status = 'Unknown';
                    $distkm = ceil($distm / 1000);

                    try {
                        Distance::create([
                            'oripai' => $oriiso,
                            'oricp' => $oripc,
                            'despai' => $desiso,
                            'descp' => $despc,
                            'tramocp' => $oriiso . $oripc . $desiso . $despc,
                            'dtpuerto' => 'O',
                            'orinom' => $orinom,
                            'desnom' => $desnom,
                            'distkmokay' => 0,
                            'distm' => $distm,
                            'distkm' => $distkm,
                            'disttimesec' => $disttimesec,
                            'font' => 'WSE',
                            'state' => $status,
                            'datecalc' => date('Y-m-d'),
                            'discharge' => '',
                        ]);
                    } catch (\Exception $e) {
                        $requ = [
                            'error' => 'Error al crear distancia: ' . $e->getMessage(),
                            'status' => 'error',
                            'distkmokay' => '0',
                            'distm' => '0',
                        ];
                    }

                    $requ = Distance::select('distkmokay', 'distm', 'distkm', 'disttimesec')
                        ->where('oripai',  $oriiso) //'ES'
                        ->where('despai',  $desiso) //'ES'
                        ->where('oricp', $oripc) //'03600'
                        ->where('descp',  $despc)->first(); // '12100'
                    $requ = $requ->toArray();

                    if ($requ['distkmokay'] != 0)
                        $requ['distkmokay'] = $requ['distkmokay'] . ' km';
                    $requ['distm'] = $requ['distm'] . ' m';
                    $requ['distkm'] = $requ['distkm'] . ' km';
                    $requ['disttimesec'] = date('H:i:s', mktime(0, 0, $requ['disttimesec']));
                }
            } catch (\Exception $e) {
                $requ = [
                    'error' => 'Error al procesar la solicitud: ' . $e->getMessage(),
                    'status' => 'error',
                    'distkmokay' => '0',
                    'distm' => '0',
                ];
            }
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
