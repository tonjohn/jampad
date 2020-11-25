<?php

namespace Database\Seeders;

use App\Models\UserProduct;
use Illuminate\Database\Seeder;

class UserProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserProduct::factory()->count(5)->create();
    }
}
