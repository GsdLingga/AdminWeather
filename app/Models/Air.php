<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Air extends Model
{
    use HasFactory;

    protected $table = 'tb_air';
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id_device', 
        'jarak_air',
        'suhu',
        'kelembaban',
        'intensitas_cahaya',
        'hujan',
        'interval'
    ];
}
