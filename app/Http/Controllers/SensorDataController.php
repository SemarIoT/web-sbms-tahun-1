<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Light;
use App\Models\Energy;
use App\Models\IkeDummy;
use App\Models\Pinpoint;
use App\Models\DhtSensor;
use App\Models\EnergyKwh;
use App\Models\FireAlarm;
use App\Models\EnergyCost;
use App\Models\EnergyPanel;
use App\Models\LightDimmer;
use App\Models\DhtExtraData;
use App\Models\EnergyOutlet;
use Illuminate\Http\Request;
use App\Models\EnergyPredict;
use App\Models\EnergiesForDev;
use Illuminate\Support\Carbon;
use App\Models\EnergyPanelMaster;
use App\Models\EnergyOutletMaster;
use Illuminate\Support\Collection;

class SensorDataController extends Controller
{
    public function getDht()
    {
        $data = DhtSensor::latest()->get();
        return $data;
    }

    public function postDht(Request $request)
    {
        $data = new DhtSensor;
        $data->temperature = $request->temperature;
        $data->humidity = $request->humidity;
        $data->save();
        return 201;
    }
    public function getDhtExtra()
    {
        $data = DhtExtraData::latest()->get();
        return $data;
    }

    public function postDhtExtra(Request $request)
    {
        $data = new DhtExtraData;
        $data->dht = $request->dht;
        $data->temperature = $request->temperature;
        $data->humidity = $request->humidity;
        $data->save();
        return 201;
    }


    public function getAllDimmer()
    {
        $data = LightDimmer::get();
        return $data;
    }

    public function getDimmer($id)
    {
        $data = LightDimmer::where('id', $id)->value('nilai');
        return $data;
    }

    public function postDimmer(Request $request, $id)
    {
        $data = DimmerSensor::where('id', $id)->update(array(
            'nilai' => $request->value
        ));
        return 201;
    }
    public function getLightAll()
    {
        $data = Light::get();
        return $data;
    }

    public function getLight($id)
    {
        $data = Light::where('id', $id)->pluck('status');
        return $data;
    }


    public function postLight(Request $request, $id)
    {
        // put data at id = $id
        if (Light::where('id', $id)->exists()) {
            $data = Light::find($id);
            $data->status = is_null($request->status) ? $data->status : $request->status;
            $data->save();

            return response()->json([
                "message" => "Data's records updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Data not found"
            ], 404);
        }
    }
    public function getAllData()
    {
        $data = Energy::latest()->take(500)->get(); //Biar gak memory warning sama hostingnya;
        //  Format the created_at timestamp
        $formattedData = $data->map(function ($item) {
            $item->created_at_formatted = $item->created_at->format('d M Y H:i:s');
            return $item;
        });

        // Hide the created_at and updated_at fields
        $formattedData->makeHidden(['created_at', 'updated_at']);
        return response($formattedData, 200);
    }

    public function getData($id)
    {
        // get data at id = $id
        if (Energy::where('id_kwh', $id)->exists()) {
            $data = Energy::where('id_kwh', $id)->get(); //()->toJson(JSON_PRETTY_PRINT);
            return response($data, 200);
        } else {
            return response()->json([
                "message" => "Data not found"
            ], 404);
        }
    }

    public function deleteData($id)
    {
        // delete data at id = $id
        if (Energy::where('id', $id)->exists()) {
            $data = Energy::find($id);
            $data->delete();

            return response()->json([
                "message" => "Data's records deleted"
            ], 202);
        } else {
            return response()->json([
                "message" => "Data not found"
            ], 404);
        }
    }

    public function addData(Request $request)
    {
        // Validasi agar data tersimpan setiap 5 menit sekali saja
        // Jaga-jaga kalau end-node error dan ngirim beberapa kali

        $latestData = Energy::where('id_kwh', $request->id_kwh)
            ->latest('created_at')
            ->first();
        if ($latestData) {
            $fiveMinutesAgo = Carbon::now()->subMinutes(4);
            if ($latestData->created_at < $fiveMinutesAgo) {
                // Save the new data
                $data = new Energy;
                $data->id_kwh = $request->id_kwh;
                $data->frekuensi = $request->frekuensi;
                $data->arus = $request->arus;
                $data->tegangan = $request->tegangan;
                $data->active_power = $request->active_power;
                $data->reactive_power = $request->reactive_power;
                $data->apparent_power = $request->apparent_power;
                $data->save();

                return response()->json([
                    "message" => "Data record added"
                ], 201);
            } else {
                return response()->json([
                    "message" => "Sorry, belum 5 menit"
                ], 400);
            }
        } else {
            // Save the new data if no previous data exists
            $data = new Energy;
            $data->id_kwh = $request->id_kwh;
            $data->frekuensi = $request->frekuensi;
            $data->arus = $request->arus;
            $data->tegangan = $request->tegangan;
            $data->active_power = $request->active_power;
            $data->reactive_power = $request->reactive_power;
            $data->apparent_power = $request->apparent_power;
            $data->save();

            return response()->json([
                "message" => "Data record added"
            ], 201);
        }
        // post data


        return response()->json([
            "message" => "data record added"
        ], 201);
    }

    public function getTotalEnergy()
    {
        $data = EnergyKwh::latest()->get();
        //  Format the created_at timestamp
        $formattedData = $data->map(function ($item) {
            $item->created_at_formatted = $item->created_at->format('d M Y H:i:s');
            return $item;
        });

        // Hide the created_at and updated_at fields
        $formattedData->makeHidden(['created_at', 'updated_at']);

        return $formattedData;
    }

    public function addTotalEnergy(Request $request)
    {
        // Validasi agar data tersimpan setiap 5 menit sekali saja
        // Jaga-jaga kalau end-node error dan ngirim beberapa kali

        $latestData = EnergyKwh::where('id_kwh', $request->id_kwh)
            ->latest('created_at')
            ->first();
        if ($latestData) {
            $fiveMinutesAgo = Carbon::now()->subMinutes(4);
            if ($latestData->created_at < $fiveMinutesAgo) {
                // Save the new data
                $data = new EnergyKwh;
                $data->id_kwh = $request->id_kwh;
                $data->total_energy = $request->total_energy;
                $data->save();

                return response()->json([
                    "message" => "Data record added"
                ], 201);
            } else {
                return response()->json([
                    "message" => "Sorry, belum 5 menit"
                ], 400);
            }
        } else {
            // Save the new data if no previous data exists
            $data = new EnergyKwh;
            $data->id_kwh = $request->id_kwh;
            $data->total_energy = $request->total_energy;
            $data->save();

            return response()->json([
                "message" => "Data record added"
            ], 201);
        }
    }

    public function addDebugEnergy(Request $request)
    {
        $data = new EnergiesForDev;
        $data->id_kwh = $request->id_kwh;
        $data->frekuensi = $request->frekuensi;
        $data->arus = $request->arus;
        $data->tegangan = $request->tegangan;
        $data->active_power = $request->active_power;
        $data->reactive_power = $request->reactive_power;
        $data->apparent_power = $request->apparent_power;
        $data->total_energy = $request->total_energy;
        $saved = $data->save();

        if ($saved) {
            return response()->json([
                "message" => "data record added"
            ], 201);
        } else {
            return response()->json([
                "message" => "Failed to add data record"
            ], 500); // You can use a different HTTP status code based on your application's needs
        }
    }

    public function getDailyEnergy()
    {
        $data = EnergyKwh::selectRaw('DATE(created_at) as date, MAX(created_at) as latest_updated')
            ->where('id_kwh', '=', '1')
            ->groupBy('id_kwh', 'date')
            ->latest('latest_updated')
            ->get();

        foreach ($data as $item) {
            $energy = EnergyKwh::select('total_energy')
                ->where('id_kwh', 1)
                ->whereDate('created_at', $item->date)
                ->latest('created_at')
                ->first();

            $item->energy_meter = $energy->total_energy;
        }

        $length = count($data);

        for ($i = 0; $i < $length - 1; $i++) {
            $data[$i]->today_energy = $data[$i]->energy_meter - $data[$i + 1]->energy_meter;
            $angka_ike = number_format($data[$i]->today_energy * 30 / 1000 / 33.1, 2); // dikali 30 agar memakai standar perbulan | 33,1 luas ruangan IoT
            $data[$i]->angka_ike = $angka_ike;
            switch ($angka_ike) {
                case $angka_ike <= 7.92:
                    $ike = 'Sangat Efisien';
                    $color = '#00ff00';
                    break;
                case $angka_ike > 7.92 && $angka_ike <= 12.08:
                    $ike = 'Efisien';
                    $color = '#009900';
                    break;
                case $angka_ike > 12.08 && $angka_ike <= 14.58:
                    $ike = 'Cukup Efisien';
                    $color = '#ffff00';
                    break;
                case $angka_ike > 14.58 && $angka_ike <= 19.17:
                    $ike = 'Agak Boros';
                    $color = '#ff9900';
                    break;
                case $angka_ike > 19.17 && $angka_ike <= 23.75:
                    $ike = 'Boros';
                    $color = '#ff3300';
                    break;
                default:
                    $ike = 'Sangat Boros';
                    $color = '#800000';
                    break;
            }
            $data[$i]->ike = $ike;
            $data[$i]->color = $color;
        }

        // Remove the last item from the collection since there is no next day for the last day
        $data->pop();

        return $data;
    }

    public function getMonthlyEnergy()
    {
        // Versi Mario
        $data = EnergyKwh::selectRaw('MONTH(created_at) as month, YEAR(created_at) as tahun, MAX(created_at) as latest_updated, MAX(total_energy) as total_energy')
            ->where('id_kwh', '=', '1')
            ->groupBy('month', 'tahun')
            ->latest('latest_updated')
            ->get();

        $price = EnergyCost::latest()->first()->pokok;

        $length = count($data);
        // $data[$length-1]->monthly_kwh = ($data[$length-1]->energy_meter - 6950)/1000; // pertama kali pasang di 30 des dengan kwh meter start dari 6950

        for ($i = 0; $i < $length - 1; $i++) {
            $data[$i]->monthly_kwh = ($data[$i]->energy_meter - $data[$i + 1]->energy_meter) / 1000; // energy perbulan dalam kWh
            $data[$i]->bill = intval($data[$i]->monthly_kwh * $price); // biaya listrik perbulan
            $angka_ike = $data[$i]->monthly_kwh / 33.1;
            $data[$i]->angka_ike = $angka_ike;
            switch ($angka_ike) {
                case $angka_ike <= 7.92:
                    $ike = 'Sangat Efisien';
                    $color = '#00ff00';
                    break;
                case $angka_ike > 7.92 && $angka_ike <= 12.08:
                    $ike = 'Efisien';
                    $color = '#009900';
                    break;
                case $angka_ike > 12.08 && $angka_ike <= 14.58:
                    $ike = 'Cukup Efisien';
                    $color = '#ffff00';
                    break;
                case $angka_ike > 14.58 && $angka_ike <= 19.17:
                    $ike = 'Agak Boros';
                    $color = '#ff9900';
                    break;
                case $angka_ike > 19.17 && $angka_ike <= 23.75:
                    $ike = 'Boros';
                    $color = '#ff3300';
                    break;
                default:
                    $ike = 'Sangat Boros';
                    $color = '#800000';
                    break;
            }
            $data[$i]->ike = $ike;
            $data[$i]->color = $color;
        }

        // Remove the last item from the collection since there is no next day for the last day
        $data->pop();

        $data->makeHidden(['energy_meter']);

        return $data;
    }

    public function getIkeDummy()
    {
        $data = IkeDummy::selectRaw('MONTH(created_at) as month, YEAR(created_at) as tahun, MAX(created_at) as latest_updated, MAX(total_energy) as monthly_kwh')
            ->groupBy('month', 'tahun')
            ->latest('latest_updated')
            ->get();

        // return $data;
        $length = count($data);

        for ($i = 0; $i < $length; $i++) {
            $angka_ike = number_format($data[$i]->monthly_kwh / 33.1, 2);
            $data[$i]->angka_ike = $angka_ike;
            switch ($angka_ike) {
                case $angka_ike <= 7.92:
                    $ike = 'Sangat Efisien';
                    $color = '#00ff00';
                    break;
                case $angka_ike > 7.92 && $angka_ike <= 12.08:
                    $ike = 'Efisien';
                    $color = '#009900';
                    break;
                case $angka_ike > 12.08 && $angka_ike <= 14.58:
                    $ike = 'Cukup Efisien';
                    $color = '#ffff00';
                    break;
                case $angka_ike > 14.58 && $angka_ike <= 19.17:
                    $ike = 'Agak Boros';
                    $color = '#ff9900';
                    break;
                case $angka_ike > 19.17 && $angka_ike <= 23.75:
                    $ike = 'Boros';
                    $color = '#ff3300';
                    break;
                default:
                    $ike = 'Sangat Boros';
                    $color = '#800000';
                    break;
            }
            $data[$i]->ike = $ike;
            $data[$i]->color = $color;
        }
        return $data;
    }

    public function getIkeDummyAnnual()
    {
        $data = IkeDummy::selectRaw('YEAR(created_at) as tahun, MAX(created_at) as latest_updated, SUM(total_energy) as annual_kwh')
            ->groupBy('tahun')
            ->latest('latest_updated')
            ->get();

        // return $data;
        $length = count($data);

        for ($i = 0; $i < $length; $i++) {
            $angka_ike = number_format($data[$i]->annual_kwh / 33.1, 2);
            $data[$i]->angka_ike = $angka_ike;
            switch ($angka_ike) {
                case $angka_ike <= 95:
                    $ike = 'Sangat Efisien';
                    $color = '#00ff00';
                    break;
                case $angka_ike > 95 && $angka_ike <= 145:
                    $ike = 'Efisien';
                    $color = '#009900';
                    break;
                case $angka_ike > 145 && $angka_ike <= 175:
                    $ike = 'Cukup Efisien';
                    $color = '#ffff00';
                    break;
                case $angka_ike > 175 && $angka_ike <= 285:
                    $ike = 'Agak Boros';
                    $color = '#ff9900';
                    break;
                case $angka_ike > 285 && $angka_ike <= 450:
                    $ike = 'Boros';
                    $color = '#ff3300';
                    break;
                default:
                    $ike = 'Sangat Boros';
                    $color = '#800000';
                    break;
            }
            $data[$i]->ike = $ike;
            $data[$i]->color = $color;
        }
        return $data;
    }

    public function debugFunc()
    {
        // Data Statistic Konsumsi Energi from Old to New Date
        $data = EnergyKwh::selectRaw('DATE(created_at) as date, MAX(created_at) as latest_updated, MAX(total_energy) as energy_meter')
            ->where('id_kwh', '=', '1')
            ->groupBy('id_kwh', 'date')
            ->oldest('latest_updated')
            ->get();

        $length = count($data);

        for ($i = 1; $i < $length; $i++) {
            $data[$i]->today_energy = $data[$i]->energy_meter - $data[$i - 1]->energy_meter;
        }

        // $data->makeHidden(['latest_updated', 'energy_meter']);

        return $data;
    }

    public function receiveForecast(Request $request)
    {
        // Process the received predictions
        $predictions = $request->all();

        // Store or update the predictions in the database
        foreach ($predictions as $prediction) {
            $existingPrediction = EnergyPredict::where('date', $prediction['date'])->first();
            if ($existingPrediction) {
                // Update the existing prediction
                $existingPrediction->update(['prediction' => $prediction['prediction']]);
            } else {
                // Create a new prediction
                EnergyPredict::create([
                    'date' => $prediction['date'],
                    'prediction' => $prediction['prediction']
                ]);
            }
        }

        // Return a response
        return response()->json(['message' => 'Predictions stored or updated successfully'], 200);
    }

    public function getAllFireAlarm()
    {
        // get all data
        $data = FireAlarm::latest()->get(); //->toJson(JSON_PRETTY_PRINT);
        return response($data, 200);
    }

    public function getFireAlarm($id)
    {
        // get data at id = $id
        if (FireAlarm::where('id', $id)->exists()) {
            $data = FireAlarm::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($data, 200);
        } else {
            return response()->json([
                "message" => "Data not found"
            ], 404);
        }
    }

    public function updateFireAlarm(Request $request, $id)
    {
        // put data at id = $id
        if (FireAlarm::where('id', $id)->exists()) {
            $data = FireAlarm::find($id);
            $data->status = is_null($request->status) ? $data->status : $request->status;
            $data->save();

            return response()->json([
                "message" => "Data's records updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Data not found"
            ], 404);
        }
    }


    //EnergyControl Outlet Master
    public function getAllOutletMaster()
    {

        $data = EnergyOutletMaster::latest()->get()->toJson(JSON_PRETTY_PRINT);
        return response($data, 200);
    }
    public function getOutletMaster($id)
    {

        if (EnergyOutletMaster::where('id', $id)->exists()) {
            $data = EnergyOutletMaster::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($data, 200);
        } else {
            return response()->json([
                "message" => "Data not found"
            ], 404);
        }
    }

    public function updateOutletMaster(Request $request, $id)
    {
        // put data at id = $id
        if (EnergyOutletMaster::where('id', $id)->exists()) {
            $data = EnergyOutletMaster::find($id);
            $data->status = is_null($request->status) ? $data->status : $request->status;
            $data->save();

            return response()->json([
                "message" => "Data's records updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Data not found"
            ], 404);
        }
    }
    //EnergyControl Panel Master
    public function getAllPanelMaster()
    {

        $data = EnergyPanelMaster::latest()->get()->toJson(JSON_PRETTY_PRINT);
        return response($data, 200);
    }
    public function getPanelMaster($id)
    {

        if (EnergyPanelMaster::where('id', $id)->exists()) {
            $data = EnergyPanelMaster::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($data, 200);
        } else {
            return response()->json([
                "message" => "Data not found"
            ], 404);
        }
    }

    public function updatePanelMaster(Request $request, $id)
    {
        // put data at id = $id
        if (EnergyPanelMaster::where('id', $id)->exists()) {
            $data = EnergyPanelMaster::find($id);
            $data->status = is_null($request->status) ? $data->status : $request->status;
            $data->save();

            return response()->json([
                "message" => "Data's records updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Data not found"
            ], 404);
        }
    }
    //EnergyControl Outlet 
    public function getAllOutlet()
    {

        $data = EnergyOutlet::latest()->get(); //->toJson(JSON_PRETTY_PRINT);
        return response($data, 200);
    }
    public function getOutlet($id)
    {

        if (EnergyOutlet::where('id', $id)->exists()) {
            $data = EnergyOutlet::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($data, 200);
        } else {
            return response()->json([
                "message" => "Data not found"
            ], 404);
        }
    }

    public function updateOutlet(Request $request, $id)
    {
        // put data at id = $id
        if (EnergyOutlet::where('id', $id)->exists()) {
            $data = EnergyOutlet::find($id);
            $data->status = is_null($request->status) ? $data->status : $request->status;
            $data->save();

            return response()->json([
                "message" => "Data's records updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Data not found"
            ], 404);
        }
    }
    //EnergyControl Panel 
    public function getAllPanel()
    {

        $data = EnergyPanel::latest()->get(); //->toJson(JSON_PRETTY_PRINT);
        return response($data, 200);
    }
    public function getPanel($id)
    {

        if (EnergyPanel::where('id', $id)->exists()) {
            $data = EnergyPanel::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($data, 200);
        } else {
            return response()->json([
                "message" => "Data not found"
            ], 404);
        }
    }

    public function updatePanel(Request $request, $id)
    {
        // put data at id = $id
        if (EnergyPanel::where('id', $id)->exists()) {
            $data = EnergyPanel::find($id);
            $data->status = is_null($request->status) ? $data->status : $request->status;
            $data->save();

            return response()->json([
                "message" => "Data's records updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Data not found"
            ], 404);
        }
    }
    public function getAllEnergy()
    {

        $data = EnergyPanel::select('nama', 'status')->oldest()->pluck('status'); //->toJson(JSON_PRETTY_PRINT);
        $data2 = EnergyPanelMaster::select('nama', 'status')->oldest()->pluck('status'); //latest()->get();//->toJson(JSON_PRETTY_PRINT);
        $data3 = EnergyOutlet::select('nama', 'status')->oldest()->pluck('status'); //->toJson(JSON_PRETTY_PRINT);
        $data4 = EnergyOutletMaster::select('nama', 'status')->oldest()->pluck('status'); //->toJson(JSON_PRETTY_PRINT);
        return response()->json(['p' => $data, 'pm' => $data2, 'om' => $data4,]);
        //return response()($data,$data2,$data3,$data4);
    }

    public function energyStatistik()
    {

        $energiwh = DB::select('SELECT date(energies.created_at) as date, SUM(energies.active_power*(energy_costs.delay/3600)) AS energy FROM energies JOIN energy_costs WHERE id_kwh = 1 GROUP BY date(energies.created_at) DESC');

        // Round the 'energy' values to 2 decimal places
        foreach ($energiwh as $item) {
            $item->energy = round($item->energy, 2);
        }

        return response()->json($energiwh);
    }

    public function suhulogger()
    {
        $suhulogger = DhtSensor::select(DhtSensor::raw('created_at as date'), DhtSensor::raw('AVG(temperature) as sale'))->groupBy(DhtSensor::raw('created_at'))->get();

        return response()->json($suhulogger);
    }
    public function suhulogger1()
    {
        $suhulogger = DhtExtraData::where('dht', 'DHT1')->select(DhtExtraData::raw('created_at as date'), DhtExtraData::raw('AVG(temperature) as sale'))->groupBy(DhtExtraData::raw('created_at'))->get();

        return response()->json($suhulogger);
    }
    public function suhulogger2()
    {
        $suhulogger = DhtExtraData::where('dht', 'DHT2')->select(DhtExtraData::raw('created_at as date'), DhtExtraData::raw('AVG(temperature) as sale'))->groupBy(DhtExtraData::raw('created_at'))->get();

        return response()->json($suhulogger);
    }
    public function suhulogger3()
    {
        $suhulogger = DhtExtraData::where('dht', 'DHT3')->select(DhtExtraData::raw('created_at as date'), DhtExtraData::raw('AVG(temperature) as sale'))->groupBy(DhtExtraData::raw('created_at'))->get();

        return response()->json($suhulogger);
    }
    public function suhulogger4()
    {
        $suhulogger = DhtExtraData::where('dht', 'DHT4')->select(DhtExtraData::raw('created_at as date'), DhtExtraData::raw('AVG(temperature) as sale'))->groupBy(DhtExtraData::raw('created_at'))->get();

        return response()->json($suhulogger);
    }
    public function suhulogger5()
    {
        $suhulogger = DhtExtraData::where('dht', 'DHT5')->select(DhtExtraData::raw('created_at as date'), DhtExtraData::raw('AVG(temperature) as sale'))->groupBy(DhtExtraData::raw('created_at'))->get();

        return response()->json($suhulogger);
    }

    public function humidlogger()
    {
        $humidlogger = DhtSensor::select(DhtSensor::raw('created_at as date'), DhtSensor::raw('AVG(humidity) as sale'))->groupBy(DhtSensor::raw('created_at'))->get();

        return response()->json($humidlogger);
    }
    public function humidlogger1()
    {
        $humidlogger = DhtExtraData::where('dht', 'DHT1')->select(DhtExtraData::raw('created_at as date'), DhtExtraData::raw('AVG(humidity) as sale'))->groupBy(DhtExtraData::raw('created_at'))->get();

        return response()->json($humidlogger);
    }
    public function humidlogger2()
    {
        $humidlogger = DhtExtraData::where('dht', 'DHT2')->select(DhtExtraData::raw('created_at as date'), DhtExtraData::raw('AVG(humidity) as sale'))->groupBy(DhtExtraData::raw('created_at'))->get();

        return response()->json($humidlogger);
    }
    public function humidlogger3()
    {
        $humidlogger = DhtExtraData::where('dht', 'DHT3')->select(DhtExtraData::raw('created_at as date'), DhtExtraData::raw('AVG(humidity) as sale'))->groupBy(DhtExtraData::raw('created_at'))->get();

        return response()->json($humidlogger);
    }
    public function humidlogger4()
    {
        $humidlogger = DhtExtraData::where('dht', 'DHT4')->select(DhtExtraData::raw('created_at as date'), DhtExtraData::raw('AVG(humidity) as sale'))->groupBy(DhtExtraData::raw('created_at'))->get();

        return response()->json($humidlogger);
    }
    public function humidlogger5()
    {
        $humidlogger = DhtExtraData::where('dht', 'DHT5')->select(DhtExtraData::raw('created_at as date'), DhtExtraData::raw('AVG(humidity) as sale'))->groupBy(DhtExtraData::raw('created_at'))->get();

        return response()->json($humidlogger);
    }
}
