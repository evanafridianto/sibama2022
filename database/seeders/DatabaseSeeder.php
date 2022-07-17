<?php

namespace Database\Seeders;

use App\Models\R24;
use App\Models\Drainase2022;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $sql1 = file_get_contents(public_path('drainase2020.sql'));
        $sql2 = file_get_contents(public_path('drainase2022.sql'));

        DB::unprepared($sql1);
        DB::unprepared($sql2);
        // Drainase2022::factory(50)->create();
        R24::factory(1)->create();
    }
}