<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Embargo extends Model
{

    use HasFactory;
    protected $table = 'embargos';
    protected $fillable = ['embobserv', 'emexcl', 'emusua', 'emfeca', 'emusum', 'emfecm', 'embaja'];


    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
