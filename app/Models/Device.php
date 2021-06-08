<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $table = 'tb_device';
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'nama_device', 'tipe_device', 'status'
    ];
}
