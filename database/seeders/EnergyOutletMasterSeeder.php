<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EnergyOutletMaster;

class EnergyOutletMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {
            $user = [
                [
                    'nama' => 'master',
                    'status' => '0'
                   
                ],
                
            ];
    
            foreach ($user as $key => $value) {
                EnergyOutletMaster::create($value);
            }
        }
    }
}
