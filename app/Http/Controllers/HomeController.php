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
        $total_device = Device::where('status', '=', '1')->count();
        $total_air = Device::where([['tipe_device', 'pendeteksi_banjir'], ['status', '1']])->count();
        $total_angin = Device::where([['tipe_device', 'pendeteksi_angin'], ['status', '1']])->count();

        $subquery = DB::table('tb_gps')
                    ->select(DB::raw('max(tb_gps.id) as id'))
                    ->groupBy('id_device')
                    ->pluck('id');
        $lokasi_perangkat = DB::table('tb_gps')
                            ->select('tb_gps.id', 'tb_gps.id_device', 'tb_gps.latitude', 'tb_gps.longitude', 'tb_device.nama_device', 'tb_device.tipe_device')
                            ->join('tb_device', 'tb_gps.id_device', '=', 'tb_device.id')
                            ->whereIn('tb_gps.id', $subquery)
                            ->get();
        
        // return $lokasi_perangkat;
        return view('home', compact('total_device','total_air','total_angin','lokasi_perangkat'));
    }

    public function statistik($id)
    {
        $device = Device::find($id);
        $angin = Angin::where('id_device', '=', $id)
                        ->orderBy('id', "DESC")
                        ->limit(15)->get();
        $air = Air::where('id_device', '=', $id)
                    ->orderBy('id', "DESC")
                    ->limit(15)->get()->sortBy('id');
        
        // $kecepatan_angin = $angin->pluck('kecepatan_angin');
        // $suhu_angin = $angin->pluck('suhu');

        // return $air;
        return view('statistik', compact('device', 'angin', 'air'));
        // return view('statistik', compact('device'));
    }

    public function updateChart($id)
    {
        $angin = Angin::where('id_device', '=', $id)
                        ->orderBy('id', "DESC")
                        ->limit(15)->get()->sortBy('id');
        $air = Air::where('id_device', '=', $id)
                    ->orderBy('id', "DESC")
                    ->limit(15)->get()->sortBy('id');

        $kecepatan_angin = $angin->pluck('kecepatan_angin');
        $suhu_angin = $angin->pluck('suhu');
        $kelembaban_angin = $angin->pluck('kelembaban');
        $cahaya_angin = $angin->pluck('intensitas_cahaya');
        $hujan_angin = $angin->pluck('hujan');
        $interval_angin = $angin->pluck('interval');

        $jarak_air = $air->pluck('jarak_air');
        $suhu_air = $air->pluck('suhu');
        $kelembaban_air = $air->pluck('kelembaban');
        $cahaya_air = $air->pluck('intensitas_cahaya');
        $hujan_air = $air->pluck('hujan');
        $interval_air = $air->pluck('interval');

        return response()->json(compact(
            'kecepatan_angin', 
            'suhu_angin', 
            'kelembaban_angin', 
            'cahaya_angin', 
            'hujan_angin', 
            'interval_angin',
            'jarak_air', 
            'suhu_air', 
            'kelembaban_air', 
            'cahaya_air', 
            'hujan_air', 
            'interval_air'
        ));
    }
}
