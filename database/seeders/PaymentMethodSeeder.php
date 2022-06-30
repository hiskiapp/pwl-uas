<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        $paymentMethods = [];
        $banks = ['Bank Mandiri', 'Bank BTPN', 'Bank CIMB', 'Bank BRI', 'Bank Mandiri', 'Bank BNI', 'Bank Permata'];
        foreach ($banks as $bank) {
            $name = ucwords($faker->name);
            $paymentMethods[] = [
                'icon' => 'uploads/files/sample-icon.png',
                'name' => $name,
                'account_number' => $faker->numberBetween(100000000, 999999999),
                'account_owner' => $bank,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        PaymentMethod::query()->insert($paymentMethods);
    }
}
