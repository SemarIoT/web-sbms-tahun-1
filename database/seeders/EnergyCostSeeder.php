<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EnergyCost;
class EnergyCostSeeder extends Seeder
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
                    'harga' => '1440',
                   
                ],
                
            ];
    
            foreach ($user as $key => $value) {
                EnergyCost::create($value);
            }
        }
    }
}
