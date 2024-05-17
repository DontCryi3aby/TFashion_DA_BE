<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\index::factory(10)->create();
       // \App\Models\product::factory(35)->create();
       DB::table('accountlogin')->insert([
        [
            'email' => 'minhhoan03@gmail.com',
            'password' => bcrypt('hoanphe1@'),
            'created_at' => now(),
            'updated_at' => now(),
        ],
    ]);
    }
}
