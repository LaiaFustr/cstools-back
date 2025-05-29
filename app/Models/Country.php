<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{

    use HasFactory;


    protected $primaryKey = 'papaicod';
    protected $table = 'countries';
    protected $fillable = ['papaicod', 'papainom', 'papaibus', 'papainomp', 'papaibusp', 'papainomi', 'papaibusi', 'papainomf', 'papaibusf', 'paarecod', 'paarees', 'papaidch', 'pafmtdch', 'pacpcx', 'pacee', 'padiv', 'paestprv', 'pabaja'];
    public $timestamps = true;

    public function embargo()
    {
        return $this->hasOne(Embargo::class, 'empaicod', 'papaicod');
    }

    public function postalCodes(){
        return $this->hasMany(Postalcode::class, 'cpcouid', 'papaicod');
    }

/* 
    
    public function distanceOri(){
        return $this->hasMany(Distance::class, 'oripai', 'papaicod');
    }
    public function distanceDes(){
        return $this->hasMany(Distance::class, 'despai', 'papaicod');
    } */
}
