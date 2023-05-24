<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DashboardSetting;

class DashboardSettingSeeder extends Seeder
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
                'nama'=>'energy_current_status',
                'status' => '1',
            ],
            [
                'nama'=>'electricity_price',
                'status' => '0',
            ],
            [
                'nama'=>'fire_alarm_status',
                'status' => '1',
            ],
            [
                'nama'=>'temp_status',
                'status' => '1',
            ],
            [
                'nama'=>'humid_status',
                'status' => '1',
            ],
            [
                'nama'=>'energy_usage_status',
                'status' => '1',
            ],
            [
                'nama'=>'month_cost_status',
                'status' => '1',
            ],
            [
                'nama'=>'previous_cost_status',
                'status' => '0',
            ],
            [
                'nama'=>'camera_status',
                'status' => '1',
            ],
            [
                'nama'=>'device_status',
                'status' => '0',
            ],
            [
                'nama'=>'voltage',
                'status' => '0',
            ],
            [
                'nama'=>'current',
                'status' => '0',
            ],
            [
                'nama'=>'frequency',
                'status' => '0',
            ],
            [
                'nama'=>'active_power',
                'status' => '0',
            ],
            [
                'nama'=>'reactive_power',
                'status' => '0',
            ],
            [
                'nama'=>'apparent_power',
                'status' => '0',
            ],
            [
                'nama'=>'dimmer_status',
                'status' => '0',
            ],
            [
                'nama'=>'light_status',
                'status' => '0',
            ],
            

            
        ];

        foreach ($user as $key => $value) {
            DashboardSetting::create($value);
        }
    }
}

