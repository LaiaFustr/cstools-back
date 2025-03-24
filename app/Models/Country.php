<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';
    protected $fillable = ['papaicod', 'papainom', 'papaibus', 'papainomp', 'papaibusp', 'papainomi', 'papaibusi', 'papainomf', 'papaibusf', 'paarecod', 'paarees', 'papaidch', 'pafmtdch', 'pacpcx', 'pacee', 'padiv', 'paestprv', 'pabaja'];


    public function embargo()
    {
        return $this->hasOne(Embargo::class);
    }
}
