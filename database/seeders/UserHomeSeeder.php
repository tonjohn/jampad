<?php

namespace Database\Seeders;

use App\Models\UserHome;
use Illuminate\Database\Seeder;

class UserHomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserHome::factory()->count(5)->create();
    }
}
