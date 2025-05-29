<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use \Database\Factories\DemurrageStorageFactory;
use Illuminate\Database\Eloquent\Model;

class DemurrageStorage extends Model
{
    /** @use HasFactory<\Database\Factories\DemurrageStorageFactory> */

    use HasFactory;

    protected $table = 'demurrage_storages';
    protected $fillable = [
        'carrier',
        'type',
        /* 'port', */
        'fromday',
        'today',
        'tar20',
        'tar40',
        'valid',
        'tarsup'
    ];
    protected $casts = [
        'valid' => 'date'
    ];
    public $timestamps = true;


    public function localPorts(){
        return $this->belongsTo(LocalPort::class, 'port', 'plnompto');
    }
}
