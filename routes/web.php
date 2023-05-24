<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KontrolController;
use App\Http\Controllers\FireAlarmController;
use App\Http\Controllers\DashbaordController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CameraController;
use App\Http\Controllers\LightControlController;
use App\Http\Controllers\AdminListController;
use App\Http\Controllers\EnergyController;
use App\Http\Controllers\EnergyOutletController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PinpointController;
use App\Http\Controllers\DhtExtraController;
use App\Http\Controllers\IntegratedSystemController;
use App\Http\Controllers\DhtSensorTemperatureController;
use App\Http\Controllers\DhtSensorHumidityController;
use App\Http\Controllers\PinpointMapController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\DoorlockStateController;
use App\Http\Controllers\DoorlockAccessController;
use App\Http\Controllers\DoorlockHistoryController;
use App\Http\Controllers\PlcSipilController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('/', \App\Http\Controllers\DashboardsController::class);
Route::get('/login',function(){
    return view('auth.login');
});
//Profil page -> digunakan untuk mengatur hal hal yang berkaitan dengan halaman profile
Route::get('/changePassword', [AuthController::class, 'showChangePasswordForm'])->name('changePassword');
Route::post('/changePassword', [AuthController::class, 'changePassword'])->name('changePassword');
Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
Route::get('showprofile/{id}',[AuthController::class, 'showprofile'])->name('showprofile');
Route::post('updateprofile',[AuthController::class, 'updateprofile'])->name('updateprofile');
//digunakan untuk mengatur hal hal yang berkaitan dengan halaman about
Route::get('/about',[AboutController::class,'index']);
Route::get('/aboutedit/{id}',[AboutController::class, 'aboutedit'])->name('aboutedit');
Route::post('aboutupdate',[AboutController::class, 'aboutupdate'])->name('aboutupdate');
//digunakan untuk mengatur hal hal yang berkaitan dengan halaman dashbooard
Route::resource('/dashboard', \App\Http\Controllers\DashboardController::class);
//digunakan untuk mengatur hal hal yang berkaitan dengan halaman dashbooards (landing page tanpa login)
Route::resource('/dashboards', \App\Http\Controllers\DashboardsController::class);
//digunakan untuk mengatur hal hal yang berkaitan dengan halaman integrated system
Route::get('/integratedsystem',[IntegratedSystemController::class,'index']);
Route::post('/storeintegratedsystemList',[IntegratedSystemController::class, 'storeintegratedsystemList'])->name('storeintegratedsystemList');
Route::post('updateintegratedsystemList',[IntegratedSystemController::class, 'updateintegratedsystemList'])->name('updateintegratedsystemList');
Route::get('deleteintegratedsystemList/{id}',[IntegratedSystemController::class, 'deleteintegratedsystemList']);
Route::get('/daftar-integratedsystem-create',function(){return view('admin.sensor.integratedsystemcreate');});
Route::get('/daftar-integratedsystem-edit/{id}',[IntegratedSystemController::class, 'editintegratedsystemList'])->name('editintegratedsystemList')->middleware('auth');
//digunakan untuk mengatur hal hal yang berkaitan dengan halaman pinpoint
Route::get('/pinpoint',[PinpointController::class,'index']);
Route::get('/pinpointset',[PinpointController::class,'pinpointset']);
Route::post('editpinpoint',[PinpointController::class,'updatePinpoint'])->name('updatePinpoint');
Route::get('deletepinpoint/{id}',[PinpointController::class, 'deletepinpoint']);
Route::get('/createpinpoint',function(){return view('pinpointcreate');});
Route::post('/storepinpoint',[PinpointController::class, 'storepinpoint'])->name('storepinpoint');
Route::get('/pinpointmap',[PinpointMapController::class,'index']);
Route::post('pinpointmapupdate',[PinpointMapController::class,'pinpointmapupdate'])->name('pinpointmapupdate');
//digunakan untuk mengatur hal hal yang berkaitan dengan halaman energy monitoring
Route::resource('/monitor', \App\Http\Controllers\EnergyController::class);
Route::get('/cost', [EnergyController::class,'energyCost']);
Route::get('/statistic', [EnergyController::class,'energyStat']);
Route::get('/control',[EnergyOutletController::class,'showData']);
Route::get('/control-change-status-panel-master/{id}',[EnergyOutletController::class,'changePanelMaster']);
Route::get('/control-change-status-outlet-master/{id}',[EnergyOutletController::class,'changeOutletMaster']);
Route::get('/control-change-status-panel/{id}',[EnergyOutletController::class,'changePanel']);
Route::get('/control-change-status-outlet/{id}',[EnergyOutletController::class,'changeOutlet']);
Route::get('/energyexportxlxs',[EnergyController::class,'export_excel']);
Route::get('/energyexportcsv',[EnergyController::class,'export_excel_csv']);
//digunakan untuk mengatur hal hal yang berkaitan dengan halaman sensor suhu dan kelembaban
Route::resource('/temperature', \App\Http\Controllers\DhtSensorTemperatureController::class);
Route::resource('/humidity', \App\Http\Controllers\DhtSensorHumidityController::class);
Route::get('/dhtsensorexportxlxs',[DhtSensorTemperatureController::class,'export_excel']);
Route::get('/dhtsensorexportcsv',[DhtSensorTemperatureController::class,'export_excel_csv']);
Route::get('/dhtsensorexporthumidxlxs',[DhtSensorHumidityController::class,'export_excel']);
Route::get('/dhtsensorexporthumidcsv',[DhtSensorHumidityController::class,'export_excel_csv']);
Route::get('showdhtapi',[DhtExtraController::class, 'showdhtapi']);
//digunakan untuk mengatur hal hal yang berkaitan dengan halaman alarm kebakaran
Route::get('/fire-alarm',[FireAlarmController::class,'showData']);
Route::get('/change-fire-alarm-status/{id}',[FireAlarmController::class,'changeStatus']);
//digunakan untuk mengatur hal hal yang berkaitan dengan halaman kamera keamanan
Route::get('/camera',[CameraController::class,'index']);
////digunakan untuk mengatur hal hal yang berkaitan dengan halaman dashbooard (tapi gk jadi dipake)
Route::get('/kontrol',[KontrolController::class,'showData']);
Route::get('/change-status/{id}',[KontrolController::class,'changeStatus']);
//digunakan untuk mengatur hal hal yang berkaitan dengan halaman light
Route::get('/light',[LightControlController::class,'showData']);
Route::get('/change-light-status/{id}',[LightControlController::class,'changeStatus']);
Route::get('/change-light-master-status/{id}',[LightControlController::class,'changeMasterStatus']);
Route::get('/change-light-dimmer-status/{id}',[LightControlController::class,'changeDimmerStatus']); 
Route::post('/change-light-dimmer-value/{id}',[LightControlController::class,'changeDimmerValue']); 
Route::get('/light',[LightControlController::class,'showData']);
//adminpage
////digunakan untuk mengatur hal hal yang berkaitan dengan halaman daftar hak akses (admin, user, developer)
Route::resource('daftar-admin',\App\Http\Controllers\AdminListController::class);
Route::post('/addUser',[App\Http\Controllers\AdminListController::class, 'storeUser'])->name('addUser');
Route::post('updateUser',[App\Http\Controllers\AdminListController::class, 'updateUser'])->name('updateUser');
Route::get('showUser/{id}',[App\Http\Controllers\AdminListController::class, 'showUser']);
Route::get('deleteUser/{id}',[App\Http\Controllers\AdminListController::class, 'delete']);
Route::get('/daftar-admin-create',function(){return view('admin.create');});
Route::get('/daftar-admin-edit/{id}',[App\Http\Controllers\AdminListController::class, 'editUser'])->name('editUser')->middleware('auth');
////digunakan untuk mengatur hal hal yang berkaitan dengan halaman daftar perangkat/sensor (energy, sensor suhu, kamera, sensor kebakaran), tapi cuma routing doang
Route::resource('daftar-sensor',\App\Http\Controllers\SensorListController::class);
//digunakan untuk mengatur hal hal yang berkaitan dengan halaman pengaturan (ubah harga, dan fitur2 lainya di halaman setting)
Route::get('setting-admin',[SettingController::class,'index']);
Route::get('setting-ubah-harga-energy-admin/{id}',[SettingController::class,'editHarga'])->name('editHarga');
Route::post('settingupdatehargaenergyadmin',[SettingController::class,'updateHarga'])->name('updateHarga');
Route::get('setting_dhtexportxlxs',[SettingController::class,'Dht_export_excel']);
Route::get('setting_dhtexportcsv',[SettingController::class,'Dht_export_excel_csv']);
Route::get('truncateDataDht',[SettingController::class,'truncateDataDht']);
Route::get('setting_energyexportxlxs',[SettingController::class,'Energy_export_excel']);
Route::get('setting_energyexportcsv',[SettingController::class,'Energy_export_excel_csv']);
Route::get('truncateDataEnergy',[SettingController::class,'truncateDataEnergy']);
Route::get('ubahstatusdashboard/{id}',[SettingController::class,'ubahstatusdashboard']);
//lampu//digunakan untuk mengatur hal hal yang berkaitan dengan halaman daftar sensor - daftar lampu
Route::post('/storeLightList',[LightControlController::class, 'storeLightList'])->name('storeLightList');
Route::post('updateLightList',[LightControlController::class, 'updateLightList'])->name('updateLightList');
Route::get('showLightList/{id}',[LightControlController::class, 'showLightList']);
Route::get('deleteLightList/{id}',[LightControlController::class, 'deleteLightList']);
Route::get('/daftar-light-create',function(){return view('admin.sensor.lightcreate');});
Route::get('/daftar-light-edit/{id}',[LightControlController::class, 'editLightList'])->name('editLightList')->middleware('auth');
//lampudimmer//digunakan untuk mengatur hal hal yang berkaitan dengan halaman daftar sensor - daftar lampu dimmer
Route::post('/storeLightDimmerList',[LightControlController::class, 'storeLightDimmerList'])->name('storeLightDimmerList');
Route::post('updateLightDimmerList',[LightControlController::class, 'updateLightDimmerList'])->name('updateLightDimmerList');
Route::get('showLightDimmerList/{id}',[LightControlController::class, 'showLightDimmerList']);
Route::get('deleteLightDimmerList/{id}',[LightControlController::class, 'deleteLightDimmerList']);
Route::get('/daftar-lightDimmer-create',function(){return view('admin.sensor.lightdimmercreate');});
Route::get('/daftar-lightDimmer-edit/{id}',[LightControlController::class, 'editLightDimmerList'])->name('editLightDimmerList')->middleware('auth');
//Fire-alarm//digunakan untuk mengatur hal hal yang berkaitan dengan halaman daftar sensor - daftar fire alarm
Route::post('/storeFireAlarmList',[FireAlarmController::class, 'storeFireAlarmList'])->name('storeFireAlarmList');
Route::post('updateFireAlarmList',[FireAlarmController::class, 'updateFireAlarmList'])->name('updateFireAlarmList');
Route::get('showFireAlarmList/{id}',[FireAlarmController::class, 'showFireAlarmList']);
Route::get('deleteFireAlarmList/{id}',[FireAlarmController::class, 'deleteFireAlarmList']);
Route::get('/daftar-FireAlarm-create',function(){return view('admin.sensor.firealarmcreate');});
Route::get('/daftar-FireAlarm-edit/{id}',[FireAlarmController::class, 'editFireAlarmList'])->name('editFireAlarmList')->middleware('auth');
//camera//digunakan untuk mengatur hal hal yang berkaitan dengan halaman daftar sensor - daftar kamera
Route::post('/storeCameraList',[CameraController::class, 'storeCameraList'])->name('storeCameraList');
Route::post('updateCameraList',[CameraController::class, 'updateCameraList'])->name('updateCameraList');
Route::get('deleteCameraList/{id}',[CameraController::class, 'deleteCameraList']);
Route::get('/daftar-Camera-create',function(){return view('admin.sensor.cameracreate');});
Route::get('/daftar-Camera-edit/{id}',[CameraController::class, 'editCameraList'])->name('editCameraList')->middleware('auth');
//panel//digunakan untuk mengatur hal hal yang berkaitan dengan halaman daftar sensor - daftar panel
Route::post('/storePanelList',[EnergyController::class, 'storePanelList'])->name('storePanelList');
Route::post('updatePanelList',[EnergyController::class, 'updatePanelList'])->name('updatePanelList');
Route::get('showPanelList/{id}',[EnergyController::class, 'showPanelList']);
Route::get('deletePanelList/{id}',[EnergyController::class, 'deletePanelList']);
Route::get('/daftar-Panel-create',function(){return view('admin.sensor.panelcreate');});
Route::get('/daftar-Panel-edit/{id}',[EnergyController::class, 'editPanelList'])->name('editPanelList')->middleware('auth');
Route::get('showPanelMasterList/{id}',[EnergyController::class, 'showPanelMasterList']);
//Outlet////digunakan untuk mengatur hal hal yang berkaitan dengan halaman daftar sensor - daftar outlet
Route::post('/storeOutletList',[EnergyController::class, 'storeOutletList'])->name('storeOutletList');
Route::post('updateOutletList',[EnergyController::class, 'updateOutletList'])->name('updateOutletList');
Route::get('showOutletList/{id}',[EnergyController::class, 'showOutletList']);
Route::get('deleteOutletList/{id}',[EnergyController::class, 'deleteOutletList']);
Route::get('/daftar-Outlet-create',function(){return view('admin.sensor.Outletcreate');});
Route::get('/daftar-Outlet-edit/{id}',[EnergyController::class, 'editOutletList'])->name('editOutletList')->middleware('auth');
Route::get('showOutletMasterList/{id}',[EnergyController::class, 'showOutletMasterList']);
//ExtraDHT//digunakan untuk mengatur hal hal yang berkaitan dengan halaman daftar sensor - daftar sensor dht (kuatur max 5 doang)
Route::post('/storeDhtxList',[DhtExtraController::class, 'storeDhtxList'])->name('storeDhtxList');
Route::post('updateDhtxList',[DhtExtraController::class, 'updateDhtxList'])->name('updateDhtxList');
Route::get('showDhtxList/{id}',[DhtExtraController::class, 'showDhtxList']);
Route::get('deleteDhtxList/{id}',[DhtExtraController::class, 'deleteDhtxList']);
Route::get('/daftar-Dhtx-create',function(){return view('admin.sensor.dhtextracreate');});
Route::get('/daftar-Dhtx-edit/{id}',[DhtExtraController::class, 'editDhtxList'])->name('editDhtxList')->middleware('auth');
Route::get('/daftar-Dhtx-status/{id}',[DhtExtraController::class,'changeDhtStatus']);
//doorlock akses
//akses ini pake kode qr di depan pintu
Route::get('/doorlock-iot',[DoorlockStateController::class,'index']);
Route::get('/doorlock_open',[DoorlockStateController::class,'doorlock_open']);
Route::get('/doorlock_list',[DoorlockAccessController::class,'index']);
Route::get('/change_state_doorlock/{id}',[DoorlockStateController::class,'change_state_doorlock'])->name('change_state_doorlock');
Route::get('/validate_doorlockAccess/{id}',[DoorlockAccessController::class,'validate_doorlockAccess'])->name('validate_doorlockAccess');
Route::get('/create_doorlockAccess',function(){return view('admin.doorlockaccesscreate');});
Route::get('/createmandiri_doorlockAccess',function(){return view('security.doorlockaccesscreatemandiri');});
Route::post('/storemandiri_doorlockAccess',[DoorlockStateController::class, 'storemandiri_doorlockAccess'])->name('storemandiri_doorlockAccess');
Route::post('/proses_token_doorlock_iot', [DoorlockStateController::class,'proses_token_doorlock_iot'])->name('proses_token_doorlock_iot');
Route::post('/store_doorlockAccess',[DoorlockAccessController::class, 'store_doorlockAccess'])->name('store_doorlockAccess');
Route::get('/delete_doorlockAccess/{id}',[DoorlockAccessController::class, 'delete_doorlockAccess']);
Route::get('/edit_doorlockAccess/{id}',[DoorlockAccessController::class, 'edit_doorlockAccess'])->name('edit_doorlockAccess')->middleware('auth');
Route::post('/update_doorlockAccess',[DoorlockAccessController::class, 'update_doorlockAccess'])->name('update_doorlockAccess');
Route::get('/doorlock_history',[DoorlockHistoryController::class,'index']);
//ruang
Route::get('/doorlock_list_room',[DoorlockAccessController::class,'doorlock_list_room']);
Route::post('/store_doorlockRoom',[DoorlockAccessController::class, 'store_doorlockRoom'])->name('store_doorlockRoom');
Route::post('/update_doorlockRoom',[DoorlockAccessController::class, 'update_doorlockRoom'])->name('update_doorlockRoom');
Route::get('/delete_doorlockRoom/{id}',[DoorlockAccessController::class, 'delete_doorlockRoom']);
Route::get('/create_doorlockRoom',function(){return view('admin.doorlockaccessroomcreate');});
Route::get('/edit_doorlockRoom/{id}',[DoorlockAccessController::class, 'edit_doorlockRoom'])->name('edit_doorlockRoom')->middleware('auth');

//sipil
Route::get('/plc_sipil',[PlcSipilController::class,'index']);
Route::get('/export_plc_sipil',[PlcSipilController::class,'export_plc_sipil']);
Route::get('truncateDataSipil',[PlcSipilController::class,'truncateDataSipil']);

//login multi level user-proses autentikasi login
Route::get('/login', [AuthController::class, 'index'])->name('login');
// Route::get('register', 'App\Http\Controllers\AuthController@register')->name('register');
Route::post('/proses_login', [AuthController::class,'proses_login'])->name('proses_login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['cek_login:admin']], function () {
        Route::resource('admin', \App\Http\Controllers\DashboardController::class);
    });
    Route::group(['middleware' => ['cek_login:editor']], function () {
        Route::resource('editor', \App\Http\Controllers\DashboardController::class);
    });
    
});