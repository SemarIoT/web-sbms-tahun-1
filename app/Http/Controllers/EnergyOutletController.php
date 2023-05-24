<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EnergyOutlet;
use App\Models\EnergyOutletMaster;
use App\Models\EnergyPanel;
use App\Models\EnergyPanelMaster;

class EnergyOutletController extends Controller
{
    public function __construct()
    { 
        $this->middleware('auth');
    }
    public function showData(){
        $energy_outlet_master = EnergyOutletMaster::latest()->Paginate(10);
        $energy_panel_master = EnergyPanelMaster::latest()->Paginate(10);
        $energy_outlet = EnergyOutlet::oldest()->Paginate(10);
        $energy_panel = EnergyPanel::oldest()->Paginate(10);
       return view('energy.control',compact('energy_outlet_master','energy_panel_master','energy_outlet','energy_panel'));
   } 
   public function changePanelMaster($id)
   {
    $getStatus = EnergyPanelMaster::select('status')->where('id',$id)->first();
    if($getStatus->status==1){
        $status = 0;
    }else{
        $status = 1;
    }
    EnergyPanelMaster::where('id',$id)->update(['status'=>$status]);
    EnergyOutletMaster::query()->update(['status'=>$status]);
    EnergyOutlet::query()->update(['status'=>$status]);
    EnergyPanel::query()->update(['status'=>$status]);
    return back();
    }

    public function changeOutletMaster($id)
   {
    $getStatus = EnergyOutletMaster::select('status')->where('id',$id)->first();
    if($getStatus->status==1){
        $status = 0;
    }else{
        $status = 1;
    }
    EnergyOutletMaster::where('id',$id)->update(['status'=>$status]);
    EnergyOutlet::query()->update(['status'=>$status]);
    return back();
    }

    public function changePanel($id)
   {
    $getStatus = EnergyPanel::select('status')->where('id',$id)->first();
    if($getStatus->status==1){
        $status = 0;
    }else{
        $status = 1;
    }
    EnergyPanel::where('id',$id)->update(['status'=>$status]);
    return back();
    }

    public function changeOutlet($id)
   {
    $getStatus = EnergyOutlet::select('status')->where('id',$id)->first();
    if($getStatus->status==1){
        $status = 0;
    }else{
        $status = 1;
    }
    EnergyOutlet::where('id',$id)->update(['status'=>$status]);
    return back();
    }
}
