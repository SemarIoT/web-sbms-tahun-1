<?php

namespace Database\Seeders;

use App\Models\LightDimmer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            DashboardSettingSeeder::class,
            EnergyCostSeeder::class,
            EnergyKwhSeeder::class,
            EnergyOutletMasterSeeder::class,
            EnergyOutletSeeder::class,
            EnergyPanelMasterSeeder::class,
            EnergyPanelSeeder::class,
            IkeDummySeeder::class,
            LightDimmerSeeder::class,
            LightMasterSeeder::class,
            LightSeeder::class,
            UserSeeder::class,
        ]);
    }
}
