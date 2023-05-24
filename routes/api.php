<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SensorDataController;
use App\Http\Controllers\DashboardDataController;
use App\Http\Controllers\ApiDataController;
use App\Http\Controllers\EnergyController;
use App\Http\Controllers\DoorlockStateController;
use App\Http\Controllers\PlcSipilController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//apiDHT
Route::get('Dht',[SensorDataController::class, 'getDht'])->name('getDht');
Route::post('Dht',[SensorDataController::class, 'postDht'])->name('postDht');
Route::get('DhtSensor',[SensorDataController::class, 'getDhtExtra'])->name('getDhtExtra');
Route::post('DhtSensor',[SensorDataController::class, 'postDhtExtra'])->name('postDhtExtra');
//apiFireAlarm
Route::get('FireAlarm',[SensorDataController::class, 'getAllFireAlarm'])->name('getAllFireAlarm');
Route::get('FireAlarm/{id}',[SensorDataController::class, 'getFireAlarm'])->name('getFireAlarm');
Route::post('FireAlarm/{id}',[SensorDataController::class, 'updateFireAlarm'])->name('updateFireAlarm');


Route::get('Dimmer/{id}',[SensorDataController::class, 'getDimmer']);
//Route::post('Dimmer/{id}',[SensorDataController::class, 'updateDimmer']);
Route::get('Dimmer',[SensorDataController::class, 'getAllDimmer'])->name('getAllDimmer');
//Route::post('postDimmer/{id}',[SensorDataController::class, 'postDimmer']);
//Route::post('postDimmer/{id}',[SensorDataController::class, 'postDimmer']);

//Route::get('getDashData',[DashboardDataController::class, 'getData'])->name('getDashData');
//api_light
Route::get('ApiLight/{id}',[SensorDataController::class, 'getLight'])->name('getLight');
Route::get('ApiLight',[SensorDataController::class, 'getLightAll'])->name('getLightAll');
Route::post('ApiLight/{id}',[SensorDataController::class, 'postLight'])->name('postLight');

//api monitor energy
Route::get('ApiEnergy',[SensorDataController::class,'getAllData']);
Route::get('ApiEnergy/{id}',[SensorDataController::class,'getData']);
Route::post('ApiEnergy',[SensorDataController::class,'addData']);
Route::delete('ApiEnergy/{id}',[SensorDataController::class,'deleteData']);
//api control energy
Route::get('AllEnergy',[SensorDataController::class, 'getAllEnergy']);
Route::post('AllEnergy',[SensorDataController::class, 'updateAllEnergy'])->name('postAllEnergy');
Route::get('OutletMaster',[SensorDataController::class, 'getAllOutletMaster'])->name('getAllOutletMaster');
Route::get('OutletMaster/{id}',[SensorDataController::class, 'getOutletMaster'])->name('getOutletMaster');
Route::post('OutletMaster/{id}',[SensorDataController::class, 'updateOutletMaster'])->name('postOutletMaster');
Route::get('PanelMaster',[SensorDataController::class, 'getAllPanelMaster'])->name('getAllPanelMaster');
Route::get('PanelMaster/{id}',[SensorDataController::class, 'getPanelMaster'])->name('getPanelMaster');
Route::post('PanelMaster/{id}',[SensorDataController::class, 'updatePanelMaster'])->name('postPanelMaster');
Route::get('Outlet',[SensorDataController::class, 'getAllOutlet'])->name('getAllOutlet');
Route::get('Outlet/{id}',[SensorDataController::class, 'getOutlet'])->name('getOutlet');
Route::post('Outlet/{id}',[SensorDataController::class, 'updateOutlet'])->name('postOutlet');
Route::get('Panel',[SensorDataController::class, 'getAllPanel'])->name('getAllPanel');
Route::get('Panel/{id}',[SensorDataController::class, 'getPanel'])->name('getPanel');
Route::post('Panel/{id}',[SensorDataController::class, 'updatePanel'])->name('postPanel');
//api doorlock
Route::get('Doorlock/{id}',[DoorlockStateController::class, 'Doorlock'])->name('Doorlock');

//sipill
Route::get('plc_sipil',[PlcSipilController::class, 'plc_sipil_get'])->name('plc_sipil_get');
Route::post('plc_sipil',[PlcSipilController::class, 'plc_sipil_post'])->name('plc_sipil_post');
Route::get('plc_sipil_statistik',[PlcSipilController::class, 'plc_sipil_statistik'])->name('plc_sipil_statistik');

//web view
Route::get('statistik',[SensorDataController::class, 'energyStatistik'])->name('energyStatistik');

Route::get('suhulogger',[SensorDataController::class, 'suhulogger'])->name('suhulogger');
Route::get('suhuloggerDHT1',[SensorDataController::class, 'suhulogger1'])->name('suhulogger1');
Route::get('suhulogger2',[SensorDataController::class, 'suhulogger2'])->name('suhulogger2');
Route::get('suhulogger3',[SensorDataController::class, 'suhulogger3'])->name('suhulogger3');
Route::get('suhulogger4',[SensorDataController::class, 'suhulogger4'])->name('suhulogger4');
Route::get('suhulogger5',[SensorDataController::class, 'suhulogger5'])->name('suhulogger5');

Route::get('humidlogger',[SensorDataController::class, 'humidlogger'])->name('humidlogger');
Route::get('humidlogger1',[SensorDataController::class, 'humidlogger1'])->name('humidlogger1');
Route::get('humidlogger2',[SensorDataController::class, 'humidlogger2'])->name('humidlogger2');
Route::get('humidlogger3',[SensorDataController::class, 'humidlogger3'])->name('humidlogger3');
Route::get('humidlogger4',[SensorDataController::class, 'humidlogger4'])->name('humidlogger4');
Route::get('humidlogger5',[SensorDataController::class, 'humidlogger5'])->name('humidlogger5');
