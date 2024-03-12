<?php

namespace App\Exports;

use DB;
use App\Models\Driver;
use App\Models\Energy;
use App\Models\EnergyKwh;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EnergyExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function headings(): array
    {
        return ["date", "energy wh"];
    }
    public function collection()
    {
        // Mas Wildan
        // return Energy::select(Energy::raw('DATE(energies.created_at) as date'), Energy::raw('SUM(energies.active_power * (energy_costs.delay/3600)) as sale'))
        //         ->join('energy_costs', 'energies.id_kwh', '=', 'energy_costs.id')
        //         ->where('energies.id_kwh', '=', 1)
        //         ->groupBy(Energy::raw('DATE(created_at)'))
        //         ->get();

        // Mario 
        $data = EnergyKwh::selectRaw('DATE(created_at) as date, MAX(created_at) as latest_updated, MAX(total_energy) as energy_meter')
            ->where('id_kwh', '=', '1')
            ->groupBy('id_kwh', 'date')
            ->oldest('latest_updated')
            ->get();

        $length = count($data);

        for ($i = 1; $i < $length; $i++) {
            $data[$i]->today_energy = $data[$i]->energy_meter - $data[$i - 1]->energy_meter;
        }

        $data->makeHidden(['latest_updated', 'energy_meter']);

        return $data;
    }
}
