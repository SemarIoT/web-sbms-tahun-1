<?php

namespace App\Exports;

use DB;
use App\Models\Energy;
use App\Models\Driver;
use Maatwebsite\Excel\Concerns\WithHeadings;    
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;

class EnergyExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings() :array
    {
        return [ "date","total energy"];
    }
    public function collection()
    {
        // return Energy::select(Energy::raw('DATE(created_at) as date'), energy::raw('SUM(active_power) as sale'))->
        // where('id_kwh', '=', 1)->
        // groupBy(Energy::raw('DATE(created_at)'))->
        // get();
        return Energy::select(Energy::raw('DATE(energies.created_at) as date'), Energy::raw('SUM(energies.active_power * (energy_costs.delay/3600)) as sale'))
                ->join('energy_costs', 'energies.id_kwh', '=', 'energy_costs.id')
                ->where('energies.id_kwh', '=', 1)
                ->groupBy(Energy::raw('DATE(created_at)'))
                ->get();
    }
}
