<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postalcode extends Model
{
    /** @use HasFactory<\Database\Factories\PostalcodeFactory> */
    use HasFactory;

    protected $table = 'postalcodes';
    protected $fillable = ['cptownm', 'cptownmori', 'cpstrpcori','cpendpcori','cpstrpc','cpendpc','cpprvid','cpprvcod','cpprvnom','cptownpcode','cptownplace',/* 'cpdeststat','cptownid', */'cpaliasin',/* 'cpmarcaesp', */'cpbaja'];

    public function country()
    {
        return $this->belongsTo(Country::class, 'cpcouid', 'papaicod');
    }
}
