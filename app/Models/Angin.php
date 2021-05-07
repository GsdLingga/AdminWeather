<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Angin extends Model
{
    use HasFactory;

    protected $table = 'tb_angin';
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id_device', 
        'kecepatan_angin',
        'suhu',
        'kelembaban',
        'intensitas_cahaya',
        'hujan',
        'interval'
    ];
}
