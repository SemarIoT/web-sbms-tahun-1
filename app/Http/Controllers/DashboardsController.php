<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use App\Models\DhtSensor;
use App\Models\FireAlarm;
use App\Models\Energy;
use App\Models\EnergyCost;
use App\Models\EnergyOutlet;
use App\Models\EnergyOutletMaster;
use App\Models\EnergyPanel;
use App\Models\EnergyPanelMaster;
use App\Models\Light;
use App\Models\LightMaster;
use App\Models\LightDimmer;
use App\Models\DashboardSetting;
use App\Models\About;
use DB;
class DashboardsController extends Controller
{
    
    public function index(){
        $humidity = DhtSensor::latest()->paginate(1);
        $temperature = DhtSensor::latest()->paginate(1);
        $fire = FireAlarm::latest()->Paginate(1);
        $energy_today = Energy::where('id_kwh', '1')->select(Energy::raw("SUM(active_power) as energy_today "))->whereDate('created_at', Carbon::today())->pluck('energy_today');
        $energy_month = Energy::where('id_kwh', '1')->select(Energy::raw("SUM(active_power) as energy_month "))->whereMonth('created_at', Carbon::today())->pluck('energy_month');
        $energy_cost = EnergyCost::latest()->pluck('harga'); 
        $energy_cost_delay = EnergyCost::latest()->pluck('delay');
        $energy_current = Energy::where('id_kwh', '1')->latest()->paginate(1);
        $energy_cost_pokok = EnergyCost::latest()->pluck('pokok');
        $energy_submonth =Energy::where('id_kwh', '1')->select(Energy::raw("SUM(active_power) as energy_submonth "))->whereMonth('created_at', Carbon::today()->subMonth())->pluck('energy_submonth');
        $energies = Energy::latest()->paginate(1);
        $energy = Energy::where('id_kwh', '1')->latest()->Paginate(1);
        $energy2 = Energy::where('id_kwh', '2')->latest()->Paginate(1);
        $energy_outlet = EnergyOutlet::oldest()->Paginate(100);
        $energy_outlet_master = EnergyOutletMaster::oldest()->Paginate(1);
        $energy_panel = EnergyPanel::oldest()->Paginate(100);
        $controls = Light::oldest()->Paginate(100);
        $dimmer = LightDimmer::oldest()->simplePaginate(100);
        
        $energy_current_status = DashboardSetting::where('nama', 'energy_current_status')->get();
        $electricity_price = DashboardSetting::where('nama', 'electricity_price')->get();
        $fire_alarm_status = DashboardSetting::where('nama', 'fire_alarm_status')->get();
        $temp_status = DashboardSetting::where('nama', 'temp_status')->get();
        $humid_status = DashboardSetting::where('nama', 'humid_status')->get();
        $energy_usage_status = DashboardSetting::where('nama', 'energy_usage_status')->get();
        $month_cost_status = DashboardSetting::where('nama', 'month_cost_status')->get();
        $previous_cost_status = DashboardSetting::where('nama', 'previous_cost_status')->get();
        $camera_status = DashboardSetting::where('nama', 'camera_status')->get();
        $device_status = DashboardSetting::where('nama', 'device_status')->get();
        $voltage = DashboardSetting::where('nama', 'voltage')->get();
        $current = DashboardSetting::where('nama', 'current')->get();
        $frequency = DashboardSetting::where('nama', 'frequency')->get();
        $active_power = DashboardSetting::where('nama', 'active_power')->get();
        $reactive_power = DashboardSetting::where('nama', 'reactive_power')->get();
        $apparent_power = DashboardSetting::where('nama', 'apparent_power')->get();
        $dimmer_status = DashboardSetting::where('nama', 'dimmer_status')->get();
        $light_status = DashboardSetting::where('nama', 'light_status')->get();


        return view('dashboards', compact('humidity','temperature','fire','energy_today','energy_month','energy_cost','energy_cost_delay','energy_current','energy_cost_pokok','energy_submonth','energies','energy','energy2','energy_outlet','energy_outlet_master','energy_panel','controls','dimmer',
                                        'energy_current_status','electricity_price','fire_alarm_status',
                                        'temp_status','humid_status','energy_usage_status','month_cost_status','previous_cost_status',
                                        'camera_status','device_status','voltage','current','frequency',
                                        'active_power','reactive_power','apparent_power','dimmer_status','light_status'));
    }
}