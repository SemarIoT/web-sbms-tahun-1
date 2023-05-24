<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LightMaster;
class LightMasterSeeder extends Seeder
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
                'status' => '0',
            ],
            
            
        ];

        foreach ($user as $key => $value) {
            LightMaster::create($value);
        }
        
        
    }
}
