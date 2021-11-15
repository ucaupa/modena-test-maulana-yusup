<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Arr::pluck(Role::query()->select('key')->get()->toArray(), 'key');
        $organization = Arr::pluck(Organization::query()->select('id')->get()->toArray(), 'id');

        $faker = Faker::create('id_ID');

        $user = new User();
        $user->username = 'admin';
        $user->nik = $this->generateRandomNumber();
        $user->name = 'Admin Modena';
        $user->email = 'admin@modena.com';
        $user->email_verified_at = Carbon::now();
        $user->phone = $faker->phoneNumber;
        $user->bank_name = 'BCA';
        $user->bank_account = $this->generateRandomNumber(8);
        $user->npwp = Str::substr(Str::uuid(), 16, 32);
        $user->postal_code = 45257;
        $user->sub_district = 28334;
        $user->district = 2222;
        $user->city = 169;
        $user->province_id = 12;
        $user->address = $faker->address;
        $user->organization_id = $organization[array_rand($organization)];
        $user->role_id = 'admin';
        $user->password = bcrypt('password');
        $user->is_active = true;
        $user->is_access_mobile = true;
        $user->cti_usage = false;
        $user->save();

        for ($i = 1; $i < 50; $i++) {
            $username = $faker->userName;

            $user = new User();
            $user->username = $username;
            $user->nik = $this->generateRandomNumber();
            $user->name = $faker->name;
            $user->email = $username . '@modena.com';
            $user->email_verified_at = Carbon::now();
            $user->phone = $faker->phoneNumber;
            $user->bank_name = 'BCA';
            $user->bank_account = $this->generateRandomNumber(8);
            $user->npwp = Str::substr(Str::uuid(), 16, 32);
            $user->postal_code = 45257;
            $user->sub_district = 28334;
            $user->district = 2222;
            $user->city = 169;
            $user->province_id = 12;
            $user->address = $faker->address;
            $user->organization_id = $organization[array_rand($organization)];
            $user->role_id = $role[array_rand($role)];
            $user->password = bcrypt('password');
            $user->is_active = true;
            $user->is_access_mobile = true;
            $user->save();
        }
    }

    protected function generateRandomNumber($length = 16)
    {
        try {
            $time = substr(time(), 0, 10);
            if ($length <= 10)
                $time = substr(time(), (10 - ($length / 2)));

            $end = (string)random_int(100, 1000);

            return $time . '' . sprintf("%0" . ($length - 10) . "d", $end);
        } catch (\Exception $e) {
            return time();
        }
    }
}
