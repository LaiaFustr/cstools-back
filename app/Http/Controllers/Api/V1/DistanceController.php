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

        $validated = $request->validate([
            'descountry' => 'required',
            'desiso' => 'required',
            'despc' => 'required',
            'oricountry' => 'required',
            'oriiso' => 'required',
            'oripc' => 'required',
        ]);

        $oriiso = $validated['oriiso'];
        $desiso = $validated['desiso'];
        $oripc = $validated['oripc'];
        $despc = $validated['despc'];

        if ($request->oritown != null && $request->oritown != '')
            $oritown  = $request->oritown;
        else
            $oritown  = '';
        if ($request->destown != null && $request->destown != '')
            $destown = $request->destown;
        else
            $destown = '';

        $str = '';
        /*  try { */

        Log::info([
            'oripai' => $oriiso,
            'oricp' => $oripc,
            'despai' => $desiso,
            'descp' => $despc,
            'cptownori' => $oritown,
            'cptowndest' => $destown,
        ]);
        $requ = Distance::select('distkmokay', 'distm', 'distkm', 'disttimesec')
            ->where('oripai',  $oriiso) //'ES'
            ->where('oricp', $oripc) //'03600'
            ->where('despai',  $desiso) //'ES'
            ->where('descp',  $despc) // '12100'
            ->where('cptownori',  $oritown)
            ->where('cptowndest',  $destown)->first();

        Log::info('Resultado consulta tabla:', ['result' => $requ]);
        /*  } catch (\Exception $e) { */
        /* $requ = [
                'error' => 'Error al consultar la distancia: ' . $e->getMessage(),
                'status' => 'error',
                'distkmokay' => '0',
                'distm' => '0',
            ]; */
        /* $str = 'Fallo en primer orip';
        Log::info($str); */
        /* Log::info($e); */
        /*  } */

        try {
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


                try {
                    if (count($response) > 0) {

                        if (isset($response['origin_addresses'][0])) {
                            $aux = $response['origin_addresses'][0];
                            $aux = trim($aux);
                            $aux = explode(",", $aux);

                           // Log::info($aux);
                            if (isset($aux[2])) {
                                $cpprvnom = $aux[1];
                                $aux = explode(" ", $aux[0]);
                                //Log::info($aux);
                                array_shift($aux);
                                $orinom = '';
                                foreach ($aux as $word) {
                                    $orinom .= $word . ' ';
                                }
                                //Log::info($aux);
                                //$orinom = $aux[1];
                            } else {
                                $aux = explode(" ", $aux[0]);
                                //Log::info($aux);
                                $orinom = $aux[1];
                                $cpprvnom = '';
                            }
                            $orinom = trim($orinom);
                            $orinom = strtoupper($orinom);
                            /*  try { */
                            $postalcodeori =  Postalcode::where('cpstrpcori', $oripc)
                                ->where('cptownm',  $orinom)
                                ->where('cpcouid', $oriiso)
                                ->first();
                            /*  } catch (\Exception $e) { */
                            if (!$postalcodeori) {
                                try {
                                    $postalcodeori = new Postalcode();
                                    $postalcodeori->setAttribute('cpcouid', $oriiso);
                                    $postalcodeori->setAttribute('cptownm', $orinom);
                                    $postalcodeori->setAttribute('cpstrpc', $oripc);

                                    $postalcodeori->fill([
                                        'cptownmori' => $orinom,
                                        'cpstrpcori' => $oripc,
                                        'cpendpcori' => $oripc,

                                        'cpendpc' => $oripc,
                                        'cpprvid' => '',
                                        'cpprvcod' => '',
                                        'cpprvnom' =>  $cpprvnom,
                                        'cptownpcode' => '',
                                        'cptownplace' => 'N',
                                        'cpaliasin' => 'N',
                                        'cpbaja' => '',
                                        'created_at' => now(),
                                        'updated_at' => now(),
                                    ]);

                                    $postalcodeori->save();
                                    /* Postalcode::create([
                                        
                                        'cptownmori' => $orinom,
                                        'cpstrpcori' => $oripc,
                                        'cpendpcori' => $oripc,
                                        
                                        'cpendpc' => $oripc,
                                        'cpprvid' => '',
                                        'cpprvcod' => '',
                                        'cpprvnom' =>  $cpprvnom,
                                        'cptownpcode' => '54893',
                                        'cptownplace' => 'N',
                                        'cpaliasin' => 'Y',
                                        'cpbaja' => '',
                                        'created_at' => now(),
                                        'updated_at' => now(),
                                    ]); */
                                } catch (\Exception $e) {
                                    $str = 'Peta postalcode de ori';
                                    Log::info($str);
                                    Log::info($e);
                                }
                            }
                            /*  } */
                        } else
                            $orinom = '';
                        if (isset($response['destination_addresses'][0])) {
                            $aux = $response['destination_addresses'][0];
                            $aux = trim($aux);
                            $aux = explode(",", $aux);
                            //Log::info($aux);
                            if (isset($aux[2])) {
                                //Log::info($aux);
                                $cpprvnom = $aux[1];
                                $aux = explode(" ", $aux[0]);
                                //Log::info($aux);
                                array_shift($aux);
                                //Log::info($aux);
                                $desnom = '';
                                foreach ($aux as $word) {
                                    $desnom .= $word . ' ';
                                }

                                // Log::info($aux);
                            } else {
                                $aux = explode(" ", $aux[0]);
                                $desnom = $aux[1];
                                $cpprvnom = '';
                                //Log::info($aux);
                            }
                            $desnom = trim($desnom);
                            $desnom = strtoupper($desnom);
                            /*  try { */
                            $postalcodedes = Postalcode::where('cpstrpc', $despc)
                                ->where('cpcouid', $desiso)
                                ->where('cptownm',  $desnom)
                                ->first();
                            /* } catch (\Exception $e) { */
                            if (!$postalcodedes) {
                                try {
                                    /* Postalcode::create([
                                        'cpcouid' => $desiso,
                                        'cptownm' => $desnom,
                                        'cptownmori' => $desnom,
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
                                        'created_at' => now(),
                                        'updated_at' => now(),
                                    ]); */

                                    $postalcodedes = new Postalcode();
                                    $postalcodedes->setAttribute('cpcouid', $desiso);
                                    $postalcodedes->setAttribute('cptownm', $desnom);
                                    $postalcodedes->setAttribute('cpstrpc', $despc);

                                    $postalcodedes->fill([
                                        'cptownmori' => $desnom,
                                        'cpstrpcori' => $despc,
                                        'cpendpcori' => $despc,

                                        'cpendpc' => $despc,
                                        'cpprvid' => '',
                                        'cpprvcod' => '',
                                        'cpprvnom' =>  $cpprvnom,
                                        'cptownpcode' => '',
                                        'cptownplace' => 'N',
                                        'cpaliasin' => 'N',
                                        'cpbaja' => '',
                                        'created_at' => now(),
                                        'updated_at' => now(),
                                    ]);

                                    $postalcodedes->save();
                                } catch (\Exception $e) {
                                    $str = 'Peta postalcode de destino';
                                    Log::info($str);
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
                            $disttimesec = '';
                        if (isset($response['status']))
                            $status = $response['status'];
                        else
                            $status = 'Unknown';
                        $distkm = ceil($distm / 1000);

                        try {
                            /* if ($oritown == '')
                                $oritown = '-';
                            if ($destown == '')
                                $destown = '-'; */
                            $distance = new Distance();

                            $distance->setAttribute('oripai', $oriiso);
                            $distance->setAttribute('cptownori', $orinom);
                            $distance->setAttribute('oricp', $oripc);
                            $distance->setAttribute('despai', $desiso);
                            $distance->setAttribute('cptowndest', $desnom);
                            $distance->setAttribute('descp', $despc);

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
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                            $distance->save();

                        } catch (\Exception $e) {
                            Log::info('Resultado distancia:', ['result' => $distance]);
                            $str = 'Fallo en segundo orip: creacion de distance.';
                            Log::info($str);
                            Log::info($e->getMessage());
                        }
                        /*  try { */
                        $requ = Distance::select('distkmokay', 'distm', 'distkm', 'disttimesec')
                            ->where('oripai',  $oriiso) //'ES'
                            ->where('despai',  $desiso) //'ES'
                            ->where('oricp', $oripc) //'03600'
                            ->where('descp',  $despc) // '12100'
                            ->where('cptownori',  $orinom)->where('cptowndest',  $desnom)->first();
                        if ($requ) {
                            if ($requ->distkmokay != '0')
                                $requ->distkmokay = $requ->distkmokay . ' km';
                            $requ->distm = $requ->distm . ' m';
                            $requ->distkm =  $requ->distkm . ' km';
                            $requ->disttimeformat = date('H:i:s', mktime(0, 0, $requ->disttimesec));
                            $requ->disttimesec = $requ->disttimesec . ' s';

                            Log::info('Resultado consulta api:', ['result' => $requ]);
                            /* } catch (\Exception $e) { */
                        } else {
                            /*  $str = 'Fallo en tercer orip';
                        Log::info($str); */
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
        } catch (\Exception $e) {
            $str = 'Es un error que no se';
            Log::info($str);
            Log::info($e);
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
