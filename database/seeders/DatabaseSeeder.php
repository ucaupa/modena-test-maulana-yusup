<?php

namespace Database\Seeders;

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
        $this->call([
            ProvinsiSeeder::class,
            KabupatenKotaSeeder::class,
            KecamatanSeeder::class,
            KelurahanSeeder::class,
            RoleSeeder::class,
            OrganizationSeeder::class,
            UserSeeder::class,
        ]);
    }
}
