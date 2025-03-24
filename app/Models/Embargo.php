<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Embargo extends Model
{
    protected $table = 'embargos';
    protected $fillable = ['embobserv', 'emexcl', 'emusua', 'emfeca', 'emusum', 'emfecm', 'embaja'];


    public function country()
    {
        return $this->belongsTo(Country::class, 'empaicod');
    }
}
