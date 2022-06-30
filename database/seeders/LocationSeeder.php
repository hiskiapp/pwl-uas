<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Province;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Throwable;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Throwable
     */
    public function run(): void
    {
        DB::beginTransaction();
        try{
            $provinces = RajaOngkir::provinsi()->all();
            foreach ($provinces as $province) {
                $province = Province::create([
                    'id' => $province['province_id'],
                    'name' => $province['province'],
                ]);

                $cities = RajaOngkir::kota()->dariProvinsi($province->id)->get();
                foreach ($cities as $city) {
                    City::create([
                        'id' => $city['city_id'],
                        'province_id'   => $province->id,
                        'name'          => $city['city_name'],
                    ]);
                }
            }

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
