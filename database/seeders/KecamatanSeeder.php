<?php

namespace Database\Seeders;

use App\Models\Kecamatan;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        $seed = json_decode(file_get_contents(database_path('data/kecamatan.json')));

        if (!$seed) throw new \Exception("Unable to load json file");

        $data = [];
        foreach ($seed->RECORDS as $record) {
            $record->created_at = Carbon::now();
            $record->updated_at = Carbon::now();

            $data[] = (array)$record;
        }

        Kecamatan::query()->insert($data);
    }
}
