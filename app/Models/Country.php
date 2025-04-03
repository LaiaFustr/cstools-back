<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{

    use HasFactory;


    protected $table = 'countries';
    protected $fillable = ['papaicod', 'papainom', 'papaibus', 'papainomp', 'papaibusp', 'papainomi', 'papaibusi', 'papainomf', 'papaibusf', 'paarecod', 'paarees', 'papaidch', 'pafmtdch', 'pacpcx', 'pacee', 'padiv', 'paestprv', 'pabaja'];
    public $timestamps = true;

    public function embargo()
    {
        return $this->hasOne(Embargo::class, 'empaicod', 'papaicod');
    }
}
