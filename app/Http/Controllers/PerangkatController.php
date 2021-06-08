<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;

class PerangkatController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $device = Device::where('status', '1')->get();

        // return $device;
        return view('perangkat', compact('device'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_device' => ['required', 'string', 'max:255'],
            'tipe_device' => ['required', 'string'],
        ]);

        $device = Device::updateOrCreate(['id' => $request->device_id],
        ['nama_device' => $request->nama_device, 'tipe_device' => $request->tipe_device, 'status' => "1"]);
        
        return response()->json(['code'=>200, 'message'=>'Device Created successfully','data' => $device], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $device = Device::find($id);

        return response()->json($device);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $device = Device::find($id);
        $device->status = "0";
        $device->save();
     
        return response()->json(['success'=>'Device deleted successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
