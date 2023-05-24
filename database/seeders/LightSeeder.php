<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Light;
class LightSeeder extends Seeder
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
                'nama'=>'D1',
                'status' => '0',
            ],
            [
                'nama'=>'D2',
                'status' => '0',
            ],
            [
                'nama'=>'D3',
                'status' => '0',
            ],
            [
                'nama'=>'D4',
                'status' => '0',
            ],
            
        ];

        foreach ($user as $key => $value) {
            Light::create($value);
        }
        
        
    }
}
