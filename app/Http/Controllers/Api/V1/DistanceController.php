<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Distance;
use App\Models\Postalcode;
use App\Models\Country;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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
            'oritown' => 'required',
            'destown' => 'required'
        ]);
        /*  
        $oricountry = $validated['oricountry'];
        $descountry = $validated['descountry']; 
        */
        $oriiso = $validated['oriiso'];
        $desiso = $validated['desiso'];
        $oripc = $validated['oripc'];
        $despc = $validated['despc'];
        $oritown  = $validated['oritown'];
        $destown = $validated['destown'];
        $str = '';
        try {
            $requ = Distance::select('distkmokay', 'distm', 'distkm', 'disttimesec')
                ->where('oripai',  $oriiso) //'ES'
                ->where('oricp', $oripc) //'03600'
                ->where('despai',  $desiso) //'ES'
                ->where('descp',  $despc) // '12100'
                ->where('cptownori',  $oritown)
                ->where('cptowndest',  $destown)->first();
        } catch (\Exception $e) {
            /* $requ = [
                'error' => 'Error al consultar la distancia: ' . $e->getMessage(),
                'status' => 'error',
                'distkmokay' => '0',
                'distm' => '0',
            ]; */
            $str = 'Fallo en primer orip';
            Log::info($str);
            Log::info($e);
        }


        if ($requ) {
            //convertir campos a campos con unidades (km, m, m/s)
            if ($requ->distkmokay != '0')
                $requ->distkmokay = $requ->distkmokay . ' km';
            $requ->distm = $requ->distm . ' m';
            $requ->distkm =  $requ->distkm . ' km';
            $requ->disttimeformat = date('H:i:s', mktime(0, 0, $requ->disttimesec));
            $requ->disttimesec = $requ->disttimesec . ' s';
        } else {

            $oricountry = str_replace(' ', '%20', Country::where('papaicod', $validated['oriiso'])->value('papainome')); //sacar nombre en inglés
            $descountry = str_replace(' ', '%20', Country::where('papaicod', $validated['desiso'])->value('papainome')); //sacar nombre en inglés


            /*  $requ = $destown; */
            $apidist = Http::withOptions(
                [
                    'verify' => false,
                ]
            )->get('https://api.distancematrix.ai/maps/api/distancematrix/json?origins=' . $oritown . ',' . $oripc . ',' . $oricountry . '&destinations=' . $destown . ',' . $despc . ',' . $descountry . '&key=tWA1vz82hpZKSmwRHBuL5bY9lAOufJ2LPEnjEw4Q46b6bkoq5iKZDOcHgkH7kJf5'); //5

            if (!$apidist->successful()) {
                return response()->json([
                    'error' => 'Alguno de los datos no existe: ',
                    'status' => 'error',
                    'distkmokay' => '-',
                    'distm' => '-',
                ]);
            }

            $response = $apidist->json();


            /* ********************************************************************************************************************* */

            try {
                if (count($response) > 0) {

                    if (isset($response['origin_addresses'][0])) {
                        $aux = $response['origin_addresses'][0];
                        $aux = explode(", ", $aux);
                        if (isset($aux[2])) {
                            $cpprvnom = $aux[1];
                            $aux = explode(" ", $aux[0]);
                            array_shift($aux);
                            $orinom = '';
                            foreach ($aux as $word) {
                                $orinom .= $word . ' ';
                            }
                            //$orinom = $aux[1];
                        } else {
                            $aux = explode(" ", $aux[0]);
                            $orinom = $aux[1];
                            $cpprvnom = '';
                        }
                        $orinom = trim($orinom);

                        /*  try { */
                        $postalcodeori =  Postalcode::where('cpstrpcori', $oripc)
                            // ->where('cpendpcori', $oripc)
                            ->where('cpcouid', $oriiso)
                            ->first();
                        /*  } catch (\Exception $e) { */
                        if (!$postalcodeori) {
                            try {

                                Postalcode::create([
                                    'cpcouid' => $oriiso,
                                    'cptownm' => strtoupper($orinom),
                                    'cptownmori' => strtoupper($orinom),
                                    'cpstrpcori' => $oripc,
                                    'cpendpcori' => $oripc,
                                    'cpstrpc' => $oripc,
                                    'cpendpc' => $oripc,
                                    'cpprvid' => '',
                                    'cpprvcod' => '',
                                    'cpprvnom' =>  $cpprvnom,
                                    'cptownpcode' => '54893',
                                    'cptownplace' => 'N',
                                    'cpaliasin' => 'Y',
                                    'cpbaja' => '',
                                ]);
                            } catch (\Exception $e) {

                                Log::info($e);
                            }
                        }
                        /*  } */
                    } else
                        $orinom = '';
                    if (isset($response['destination_addresses'][0])) {
                        $aux = $response['destination_addresses'][0];
                        $aux = explode(", ", $aux);
                        if (isset($aux[2])) {
                            $cpprvnom = $aux[1];
                            $aux = explode(" ", $aux[0]);
                            Log::info($aux);
                            array_shift($aux);
                            $desnom = '';
                            foreach ($aux as $word) {
                                $desnom .= $word . ' ';
                            }
                            $desnom = $aux[0];
                            Log::info($aux);
                        } else {
                            //Log::info($aux);
                            $aux = explode(" ", $aux[0]);
                            $desnom = $aux[0];
                            $cpprvnom = '';
                            //Log::info($aux);
                        }
                        $desnom = trim($desnom);
                        /*  try { */
                        $postalcodedes = Postalcode::where('cpstrpcori', $despc)
                            ->where('cpcouid', $desiso)
                            ->first();
                        /* } catch (\Exception $e) { */
                        if (!$postalcodedes) {
                            try {
                                Postalcode::create([
                                    'cpcouid' => $desiso,
                                    'cptownm' => strtoupper($desnom),
                                    'cptownmori' => strtoupper($desnom),
                                    'cpstrpcori' => $despc,
                                    'cpendpcori' => $despc,
                                    'cpstrpc' => $despc,
                                    'cpendpc' => $despc,
                                    'cpprvid' => '',
                                    'cpprvcod' => '',
                                    'cpprvnom' =>  $cpprvnom,
                                    'cptownpcode' => '54893',
                                    'cptownplace' => 'N',
                                    'cpaliasin' => 'Y',
                                    'cpbaja' => '',
                                ]);
                            } catch (\Exception $e) {
                                Log::info($e);
                            }
                        }
                        /* } */
                    } else
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
                        /* 
                        Distance::create([
                            'oripai' => $oriiso,
                            'oricp' => $oripc,
                            'cptownori' => $oritown, //una vez añadidas los parámetros a validated y las variables que recojan los datos de validated, añadir variables a cptownori y cptowndest
                            'despai' => $desiso,
                            'descp' => $despc,
                            'cptowndest' => $destown,
                            'tramocp' => $oriiso . $oripc . $desiso . $despc,
                            'dtpuerto' => 'O',
                            'orinom' => $orinom,
                            'desnom' => $desnom,
                            'distkmokay' => '0',
                            'distm' => $distm,
                            'distkm' => $distkm,
                            'disttimesec' => $disttimesec,
                            'font' => 'WSE',
                            'state' => $status,
                            'datecalc' => date('Y-m-d'),
                            'discharge' => '',
                        ]); */

                        $distance = new Distance();

                        $distance->setAttribute('oripai', $oriiso);
                        $distance->setAttribute('oricp', $oripc);
                        $distance->setAttribute('despai', $desiso);
                        $distance->setAttribute('descp', $despc);
                        $distance->setAttribute('cptownori', $oritown);
                        $distance->setAttribute('cptowndest', $destown);

                        $distance->fill([
                            'tramocp' => $oriiso . $oripc . $desiso . $despc,
                            'dtpuerto' => 'O',
                            'orinom' => $orinom,
                            'desnom' => $desnom,
                            'distkmokay' => '0',
                            'distm' => $distm,
                            'distkm' => $distkm,
                            'disttimesec' => $disttimesec,
                            'font' => 'WSE',
                            'state' => $status,
                            'datecalc' => date('Y-m-d'),
                            'discharge' => '',
                        ]);

                        $distance->save();
                    } catch (\Exception $e) {
                        $str = 'Fallo en segubdo orip';
                        Log::info($str);
                        Log::info($e);
                    }
                    /*  try { */
                    $requ = Distance::select('distkmokay', 'distm', 'distkm', 'disttimesec')
                        ->where('oripai',  $oriiso) //'ES'
                        ->where('despai',  $desiso) //'ES'
                        ->where('oricp', $oripc) //'03600'
                        ->where('descp',  $despc) // '12100'
                        ->where('cptownori',  $oritown)->where('cptowndest',  $destown)->first();
                    if ($requ) {
                        if ($requ->distkmokay != '0')
                            $requ->distkmokay = $requ->distkmokay . ' km';
                        $requ->distm = $requ->distm . ' m';
                        $requ->distkm =  $requ->distkm . ' km';
                        $requ->disttimeformat = date('H:i:s', mktime(0, 0, $requ->disttimesec));
                        $requ->disttimesec = $requ->disttimesec . ' s';
                        $requ = 'Holi';
                        /* } catch (\Exception $e) { */
                    } else {
                        $str = 'Fallo en tercer orip';
                        Log::info($str);
                        Log::info($e);
                    }
                } else {
                    $requ = [
                        'error' => 'Alguno de los datos no existe: ',
                        'status' => 'error',
                        'distkmokay' => '-',
                        'distm' => '-',
                    ];
                }
            } catch (\Exception $e) {
                $str = 'Pilla el fallo de la ultima linea';
                Log::info($str);
                Log::info($e);
            }
        }









        /*  Log::info($requ); */
        /*  Log::info($e); */
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
