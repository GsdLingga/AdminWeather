<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GPS extends Model
{
    use HasFactory;

    protected $table = 'tb_gps';
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id_device', 
        'latitude',
        'longitude',
        'interval'
    ];
}
