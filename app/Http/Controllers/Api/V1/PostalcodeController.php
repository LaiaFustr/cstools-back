<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Postalcode;
use Illuminate\Support\Facades\Log;

class PostalcodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        /*  select CPTOWNM, CPTOWNMORI, CPPRVNOM, PAESTPRV, CPPRVCOD, min(CPSTRPC) as MINCP, max(CPENDPC) as MAXCP
    from CENGEBADAD.CXCODPOS  
    left join CENGEBADAD.PAISAREA on PAPAICOD = CPCOUID
    where CPCOUID = '$country' and $where
    group by CPTOWNM, CPTOWNMORI, CPPRVNOM, PAESTPRV, CPPRVCOD
    order by CPTOWNM, CPPRVNOM, PAESTPRV, CPPRVCOD"; */
        /* $country = 'AK'; */
        $pc = Postalcode::with('country')->where('cpcouid', $request['country'])->select('cpcouid','cptownm as nametown', 'cptownmori as nametownori','cpprvnom as nameprov','cpprvcod as codeprov', 'cpendpcori as minpc')->get();
        
        /* Log::info('Country recibido: ' . $request['country']);
        Log::info($pc); */
        
        return response()->json($pc);
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
    public function show(string $id)
    {
        //
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
