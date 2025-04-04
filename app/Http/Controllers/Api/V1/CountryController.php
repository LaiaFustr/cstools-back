<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use Illuminate\Support\Facades\Log;
use App\Models\Embargo;
use Illuminate\Support\Facades\DB;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        /* $sqlPaisDesde = "select papaicod, papainom, papaibus, paestprv, papaibusi, coalesce(EMEXCL , '') as EMB
                                                    from PAISAREA 
                                                    left join FCEMBARGO f on EMPAIS = PAPAICOD and EMBAJA = ''
                                                    order by 2"; */
        //$countries = Country::all();

        $countries = Country::with('embargo')
        ->select('papaicod', 'papainom', 'papaibus', 'paestprv', 'papaibuse')->get()
        ->map(function ($country){
            if(isset($country->embargo->emexcl)){
                $country->emb = $country->embargo->emexcl;
            }else{
                $country->emb ='';
            }
            unset($country->embargo);
            return $country;
        });


        //Log::info($countries);

        return response()->json($countries);
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
