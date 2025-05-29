<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distance extends Model
{
    protected $table = 'distances';
    protected $fillable = [/* 'oripai', 'oricp', 'despai','descp', */ 'tramocp', 'dtpuerto', 'orinom', 'desnom', 'distkmokay', 'distm', 'distkm', 'disttimesec', 'font', 'state', 'datecalc', 'discharge'];
    public $timestamps = true;

    /*   public function oriCountry(){
        return $this->belongsTo(Country::class, 'oripai');
    }
    public function desCountry(){
        return $this->belongsTo(Country::class, 'despai');
    }
 */

    /* public function oriPai(){
        return $this->belongsTo(Postalcode::class, 'oripai', );
    } */

    public function oriPai()
    {
        return $this->belongsTo(Postalcode::with('countries'), 'oripai', 'cpcouid');
    }

    public function desPai()
    {
        return $this->belongsTo(Postalcode::with('countries'), 'despai', 'cpcouid');
    }

    public function oriCp()
    {
        return $this->belongsTo(Postalcode::class, 'oricp', 'cpstrpc');
    }

    public function desCp()
    {
        return $this->belongsTo(Postalcode::class, 'descp', 'cpstrpc');
    }
}
