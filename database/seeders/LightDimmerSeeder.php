<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LightDimmer;
class LightDimmerSeeder extends Seeder
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
                'nilai' => '0',
                'nama' => 'dimmer',
                'status' => '1',
            ],
        ];

        foreach ($user as $key => $value) {
            LightDimmer::create($value);
        }
    }
}
