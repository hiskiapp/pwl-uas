<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Services\FileService;
use Throwable;

class ProductSeeder extends Seeder
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
        try {
            $faker = \Faker\Factory::create();

            $categories = [];
            for ($i = 0; $i < 3; $i++) {
                $name = ucwords($faker->unique()->word);
                $categories[] = [
                    'name' => $name,
                    'slug' => Str::slug($name),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            Category::query()->insert($categories);

            $products = [];
            for ($i = 0; $i < 10; $i++) {
                $name = $faker->sentence(3);
                $products[] = [
                    'photo' => 'uploads/files/sample-product.png',
                    'slug' => Str::slug($name),
                    'name' => $name,
                    'description' => $faker->text(200),
                    'weight' => $faker->numberBetween(1, 5),
                    'stock' => $faker->numberBetween(0, 100),
                    'price' => $faker->numberBetween(10000, 100000),
                    'seen_total' => $faker->numberBetween(0, 100),
                    'category_id' => $faker->numberBetween(1, 3),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            Product::query()->insert($products);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::debug($e->getMessage());
            throw $e;
        }
    }
}
