<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\plc_sipil;
use DB;
use App\Exports\PlcSipilExport;
use Maatwebsite\Excel\Facades\Excel;
class PlcSipilController extends Controller
{
    public function index()
    {
        return view ('other.plcsipil');
    }
    public function plc_sipil_get(){
        $data = plc_sipil::latest()->get();
        return $data;
    }

    public function plc_sipil_post(Request $request){
        $data = new plc_sipil;
        $data->distance = $request->distance;
        $data->forces = $request->forces;
        $data->gayatarik = $request->gayatarik;
        $data->gayatekan = $request->gayatekan;
        $data->save();
        return response()->json(['message' => '201 data berhasil disimpan'], 201);
    }
    public function plc_sipil_statistik(){
        
        $plcgraph = DB::select('SELECT distance as distance, forces as forces, gayatarik as gayatarik, gayatekan as gayatekan, created_at as date FROM `plc_sipils`');
        return response()->json($plcgraph);   
    }
    public function export_plc_sipil()
	{
		return Excel::download(new PlcSipilExport, 'DataLog.xlsx');
	}
    public function truncateDataSipil()
	{
        $this->export_plc_sipil();
		plc_sipil::truncate();
        return back();
	}

}
