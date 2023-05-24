<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use App\Models\Energy;
use App\Models\EnergyCost;
use App\Models\EnergyOutlet;
use App\Models\EnergyOutletMaster;
use App\Models\EnergyPanel;
use App\Models\EnergyPanelMaster;
use App\Models\About;
use DB;
use App\Exports\EnergyExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Models\Driver;

class EnergyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $energies = Energy::latest()->paginate(1);
        $energy = Energy::where('id_kwh', '1')->latest()->Paginate(1);
        $energy2 = Energy::where('id_kwh', '2')->latest()->Paginate(1);
        $energy_today = Energy::where('id_kwh', '1')->select(Energy::raw("SUM(active_power) as energy_today "))->whereDate('created_at', Carbon::today())->pluck('energy_today');
        $energy_month = Energy::where('id_kwh', '1')->select(Energy::raw("SUM(active_power) as energy_month "))->whereMonth('created_at', Carbon::today())->pluck('energy_month');
        
        $energy_cost = EnergyCost::latest()->pluck('harga'); 
        $energy_cost_pokok = EnergyCost::latest()->pluck('pokok'); 
        $energy_cost_delay = EnergyCost::latest()->pluck('delay');
        $energy_submonth =Energy::where('id_kwh', '1')->select(Energy::raw("SUM(active_power) as energy_submonth "))->whereMonth('created_at', Carbon::today()->subMonth())->pluck('energy_submonth');
        
        $energy_outlet = EnergyOutlet::oldest()->Paginate(100);
        $energy_outlet_master = EnergyOutletMaster::oldest()->Paginate(1);
        $energy_panel = EnergyPanel::oldest()->Paginate(100);

        
        
        return view('energy.monitor',compact('energy','energy2','energies','energy_today','energy_month','energy_cost','energy_cost_pokok','energy_submonth','energy_panel','energy_outlet','energy_cost_delay','energy_outlet_master'));
   
    }

    // public function energyStat(){

    //     $cost_energy = Energy::select(Energy::raw('year(created_at) as year'),
    //                     Energy::raw('month(created_at) as month'),
    //                     Energy::raw('sum(active_power) as stat'))->groupBy('year')->groupBy('month')->pluck('stat');
    //     $waktu = Energy::select(Energy::raw('month(created_at) AS waktu'))->pluck('waktu');
        
    //     $cost_energy2 = Energy::select(Energy::raw('year(created_at) as year2'),
    //                     Energy::raw('month(created_at) as month2'),
    //                     Energy::raw('day(created_at) as day2'),
    //                     Energy::raw('sum(active_power) as stat2'))->groupBy('year2')->groupBy('month2')->groupBy('day2')->pluck('stat2');
    //     $waktu2 = Energy::select(Energy::raw('Day(created_at) AS waktu2'))->pluck('waktu2');
        

    //     return view('energy.statistic',compact('cost_energy','waktu','cost_energy2','waktu2'));
    // }
    public function energyCost(){
        $price = DB::select('SELECT month(energies.created_at)as month,year(energies.created_at)as tahun,SUM(energies.active_power*(energy_costs.delay/3600)) AS result,SUM(energies.active_power*energy_costs.harga) AS harga FROM energies JOIN energy_costs WHERE id_kwh = 1 GROUP BY month(energies.created_at) DESC,year(energies.created_at) DESC');
        
        return view('energy.cost',compact('price'))->with('i', (request()->input('page', 1) -1) * 5);
    }

    //panel list
    public function storePanelList(Request $request){
       
        request()->validate(
            [
                'nama'=> 'required',
                
            ]);

        $data = new EnergyPanel;
        $data->nama = $request->nama;
        $data->status = $request->status;
       
        $data->save();

        return redirect('daftar-sensor');
    }

    public function showPanelList($id){
        $panelshow = EnergyPanel::where('id',$id)->get();
        $about = About::oldest()->get();
        return view('admin.sensor.panelshow',compact('panelshow','about'));
    }

    public function updatePanelList(Request $request){
        //
        $id = $request->get('id');
        $nama = $request->get('nama-edit');
        
        $data = EnergyPanel::where('id',$id)->update(array(
        'nama' => $nama
        ));

        return redirect('daftar-sensor');
    }

    public function deletePanelList($id){
		$data = EnergyPanel::findorfail($id);
		$data->delete();

        return redirect('daftar-sensor');
	}
    public function editPanelList($id){
        $editpanel = EnergyPanel::select('*')
                    ->where('id', $id)
                    ->get();

        return view('admin.sensor.paneledit',compact('editpanel'));
    }

    //outlet list
    public function storeOutletList(Request $request){
       
        request()->validate(
            [
                'nama'=> 'required',
                
            ]);

        $data = new EnergyOutlet;
        $data->nama = $request->nama;
        $data->status = $request->status;
       
        $data->save();

        return redirect('daftar-sensor');
    }

    public function showOutletList($id){
        $outletshow = EnergyOutlet::where('id',$id)->get();
        $about = About::oldest()->get();
        return view('admin.sensor.outletshow',compact('outletshow','about'));
    }

    public function updateOutletList(Request $request){
        //
        $id = $request->get('id');
        $nama = $request->get('nama-edit');
        
        $data = EnergyOutlet::where('id',$id)->update(array(
        'nama' => $nama
        ));

        return redirect('daftar-sensor');
    }

    public function deleteOutletList($id){
		$data = EnergyOutlet::findorfail($id);
		$data->delete();

        return redirect('daftar-sensor');
	}
    public function editOutletList($id){
        $editoutlet = EnergyOutlet::select('*')
                    ->where('id', $id)
                    ->get();

        return view('admin.sensor.outletedit',compact('editoutlet'));
    }
    public function showOutletMasterList($id){
        $outletshow = EnergyOutletMaster::where('id',$id)->get();
        $about = About::oldest()->get();
        return view('admin.sensor.outletmastershow',compact('outletshow','about'));
    }
    public function showPanelMasterList($id){
        $outletshow = EnergyPanelMaster::where('id',$id)->get();
        $about = About::oldest()->get();
        return view('admin.sensor.panelmastershow',compact('outletshow','about'));
    }

    public function export_excel()
	{
		return Excel::download(new EnergyExport, 'energy.xlsx');
	}
    public function export_excel_csv()
	{
		return Excel::download(new EnergyExport, 'energy.csv');
	}

}
