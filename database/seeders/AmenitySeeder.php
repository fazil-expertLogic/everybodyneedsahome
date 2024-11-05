<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $amenities = [
            ['icon' => 'assets/img/icons/amenities-icon-1.svg', 'name' => 'Air Conditioning', 'created_at' => now(), 'updated_at' => now()],
            ['icon' => 'assets/img/icons/amenities-icon-2.svg', 'name' => 'Swimming Pools', 'created_at' => now(), 'updated_at' => now()],
            ['icon' => 'assets/img/icons/amenities-icon-3.svg', 'name' => 'Sporting Facilities', 'created_at' => now(), 'updated_at' => now()],
            ['icon' => 'assets/img/icons/amenities-icon-4.svg', 'name' => 'Gym', 'created_at' => now(), 'updated_at' => now()],
            ['icon' => 'assets/img/icons/amenities-icon-5.svg', 'name' => 'Clubhouse', 'created_at' => now(), 'updated_at' => now()],
            ['icon' => 'assets/img/icons/amenities-icon-6.svg', 'name' => 'Landscaped Gardens', 'created_at' => now(), 'updated_at' => now()],
            ['icon' => 'assets/img/icons/amenities-icon-7.svg', 'name' => 'Wide-Open Spaces', 'created_at' => now(), 'updated_at' => now()],
            ['icon' => 'assets/img/icons/amenities-icon-8.svg', 'name' => 'Parks', 'created_at' => now(), 'updated_at' => now()],
            ['icon' => 'assets/img/icons/amenities-icon-9.svg', 'name' => 'Package Lockers', 'created_at' => now(), 'updated_at' => now()],
            ['icon' => 'assets/img/icons/amenities-icon-10.svg', 'name' => 'Spa', 'created_at' => now(), 'updated_at' => now()],
            ['icon' => 'assets/img/icons/amenities-icon-11.svg', 'name' => 'Surveillance Cameras', 'created_at' => now(), 'updated_at' => now()],
            ['icon' => 'assets/img/icons/amenities-icon-12.svg', 'name' => 'Billiards Table', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('amenities')->insert($amenities);
    }
}
