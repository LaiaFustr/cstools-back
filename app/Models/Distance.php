<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distance extends Model
{
    protected $table = 'distances';
    protected $fillable = ['oripai', 'oricp', 'despai', 'descp', 'tramocp', 'dtpuerto', 'orinom', 'desnom', 'distkmokay', 'distm', 'distkm', 'disttimesec', 'font', 'state', 'datecalc', 'discharge'];
    public $timestamps = true;

    public function Country(){
        return $this->belongsTo(Country::class);
    }
}
