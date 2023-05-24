<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EnergyPanel;
class EnergyPanelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'nama' => 'node 1',
                'status' => '0'
               
            ],
            
        ];

        foreach ($user as $key => $value) {
            EnergyPanel::create($value);
        }
    }
}
