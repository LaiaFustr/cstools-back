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
        $oriiso = $validated['oriiso'];
        $desiso = $validated['desiso'];
        $oripc = $validated['oripc'];
        $despc = $validated['despc'];
        $requ = Distance::select('distkmokay', 'distm', 'distkm', 'disttimesec')
            ->where('oripai',  $oriiso) //'ES'
            ->where('despai',  $desiso) //'ES'
            ->where('oricp', $oripc) //'03600'
            ->where('descp',  $despc)->get(); // '12100' 



        if (count($requ) > 0) {
            //convertir campos a campos con unidades (km, m, m/s)

        } else {

            $oricountry = str_replace(' ', '%20', Country::where('papaicod', $validated['oriiso'])->value('papainome')); //sacar nombre en inglés
            $descountry = str_replace(' ', '%20', Country::where('papaicod', $validated['desiso'])->value('papainome')); //sacar nombre en inglés
            $oritown =  str_replace(' ', '%20', Postalcode::where('cpstrpcori', $validated['oripc'])->where('cpendpcori', $validated['oripc'])->where('cpcouid', $oriiso)->value('cptownm'));
            $destown =  str_replace(' ', '%20', Postalcode::where('cpstrpcori', $validated['despc'])->where('cpendpcori', $validated['despc'])->where('cpcouid', $desiso)->value('cptownm'));

                /*  $requ = $destown; */
                $apidist = Http::withOptions([
                'verify' => false, 
               ]
            )->get('https://api.distancematrix.ai/maps/api/distancematrix/json?origins=' . $oritown . ',' . $oripc . ',' . $oricountry . '&destinations=' . $destown . ',' . $despc . ',' . $descountry . '&key=tWA1vz82hpZKSmwRHBuL5bY9lAOufJ2LPEnjEw4Q46b6bkoq5iKZDOcHgkH7kJf6');//5
            $response = $apidist->json();

            /*  $requ =$oricountry; */

            if (count($response) > 0) {
                /*  $requ = $response; */
                $orinom = $response['origin_addresses'][0];
                $desnom =  $response['destination_addresses'][0];
                $distm = isset($response['rows'][0]['elements'][0]['distance']['value']);
                $disttimesec = isset($response['rows'][0]['elements'][0]['duration']['value']);
                $status = $response['status'];
                if ($distm == false)
                    $distm = 0;

                if ($disttimesec== false || $disttimesec == null)
                    $disttimesec = null;
                   
                if ($status== false || $status == null)
                    $status = 'Unknown';

                $distkm = ceil($distm / 1000);

                /* try { */
                Distance::create([
                    'oripai' => $oriiso,
                    'oricp' => $oripc,
                    'despai' => $desiso,
                    'descp' => $despc,
                    'tramocp' => $oricountry . $oripc . $descountry . $despc,
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
                /*  } catch (\Exception $e) { */
                /*  $requ = $e; */
                /*  } */

                $requ = Distance::select('distkmokay', 'distm', 'distkm', 'disttimesec')
                    ->where('oripai',  $oriiso) //'ES'
                    ->where('despai',  $desiso) //'ES'
                    ->where('oricp', $oripc) //'03600'
                    ->where('descp',  $despc)->get(); // '12100'

            } /* else {
            } */
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
