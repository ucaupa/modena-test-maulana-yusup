<?php

namespace Database\Seeders;

use App\Models\Kelurahan;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class KelurahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        $seed = json_decode(file_get_contents(database_path('data/kelurahan.json')));

        if (!$seed) throw new \Exception("Unable to load json file");

        foreach ($seed->RECORDS as $record) {
            $record->created_at = Carbon::now();
            $record->updated_at = Carbon::now();

            Kelurahan::query()->create((array)$record);
        }
    }
}
