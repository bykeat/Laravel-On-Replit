<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Uid\Uuid;

class EventDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        for ($i = 1; $i <= 5; $i++) {
            $plusRandomStartDays = rand(1, 50);
            $plusRandomEndDays = rand(1, 50) + $plusRandomStartDays;

            DB::table('events')->insert([
                'name' => 'Event ' . $i,
                'slug' => 'event-' . $i,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'start_at' => date('Y-m-d H:i:s', strtotime($plusRandomStartDays . ' days')),
                'end_at' => date('Y-m-d H:i:s', strtotime($plusRandomEndDays . ' days')),
            ]);
        }
    }
}
