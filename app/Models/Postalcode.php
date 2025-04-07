<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postalcode extends Model
{
    /** @use HasFactory<\Database\Factories\PostalcodeFactory> */
    use HasFactory;
    

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
