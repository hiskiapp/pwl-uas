<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            ['slug' => 'whatsapp_number', 'title' => 'Whatsapp Number (Untuk Konfirmasi Pembayaran)', 'value' => '6285155064115'],
        ];

        foreach($settings as $setting) {
            Setting::create($setting);
        }
    }
}
