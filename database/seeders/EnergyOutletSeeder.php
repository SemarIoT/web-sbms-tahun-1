<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EnergyOutlet;
class EnergyOutletSeeder extends Seeder
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
                'nama'=>'node1',
                'status' => '0',
            ],
            [
                'nama'=>'node2',
                'status' => '0',
            ],
            [
                'nama'=>'node3',
                'status' => '0',
            ],
            [
                'nama'=>'node4',
                'status' => '0',
            ],
            
        ];

        foreach ($user as $key => $value) {
            EnergyOutlet::create($value);
        }
    }
}
