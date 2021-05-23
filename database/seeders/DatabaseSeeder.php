<?php

namespace Database\Seeders;

use App\Models\Entete;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(WilayaTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(EnteteTableSeeder::class);
    }
}
