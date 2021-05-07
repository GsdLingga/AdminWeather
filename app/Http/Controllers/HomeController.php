<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\Air;
use App\Models\Angin;
use App\Models\GPS;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $total_device = Device::count();
        $total_air = Device::where('tipe_device', 'pendeteksi_banjir')->count();
        $total_angin = Device::where('tipe_device', 'pendeteksi_angin')->count();

        $subquery = DB::table('tb_gps')
                    ->select(DB::raw('max(tb_gps.id) as id'))
                    ->groupBy('id_device')
                    ->pluck('id');
        $lokasi_perangkat = DB::table('tb_gps')
                            ->select('tb_gps.id', 'tb_gps.id_device', 'tb_gps.latitude', 'tb_gps.longitude', 'tb_device.tipe_device')
                            ->join('tb_device', 'tb_gps.id_device', '=', 'tb_device.id')
                            ->whereIn('tb_gps.id', $subquery)
                            ->get();
        
        // return $lokasi_perangkat;
        return view('home', compact('total_device','total_air','total_angin','lokasi_perangkat'));
    }
}
