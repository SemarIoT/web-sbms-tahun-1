<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\kontrol;
class KontrolSeeder extends Seeder
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
            kontrol::create($value);
        }
    }
}
