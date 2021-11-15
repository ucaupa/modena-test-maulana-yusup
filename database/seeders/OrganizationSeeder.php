<?php

namespace Database\Seeders;

use App\Models\Organization;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Organization::query()->insert([
            [
                'organization' => 'SVC - 01 Service Jakarta 1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'organization' => 'SVC - 02 Service Jakarta 2',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
