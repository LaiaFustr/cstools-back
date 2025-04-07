<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LocalPort extends Model
{
    use HasFactory;
    protected $table = 'local_ports';
    protected $fillable = ['plptoloc', 'plcodpos', 'plnompto', 'pldlgni', 'pldlgne', 'plfecalt', 'plbaja'];
}
