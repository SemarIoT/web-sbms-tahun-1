<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Light;
use App\Models\Energy;
use App\Models\Pinpoint;
use App\Models\DhtSensor;
use App\Models\EnergyKwh;
use App\Models\FireAlarm;
use App\Models\EnergyPanel;
use App\Models\LightDimmer;
use App\Models\DhtExtraData;
use App\Models\EnergyOutlet;
use Illuminate\Http\Request;
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
        // get all data
        // $data = Energy::latest()->get();//->toJson(JSON_PRETTY_PRINT);
        $data = Energy::latest()->take(3000)->get(); //Biar gak memory warning sama hostingnya;
        return response($data, 200);
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
