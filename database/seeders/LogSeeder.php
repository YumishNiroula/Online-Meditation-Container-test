<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('logs')->insert([
            'user_id' => 1,
            'duration' => 10,
            'date' => '2024-03-20',
            'note' => 'I felt good after the meditation',
            'status' => 'completed',
            'mood' => 'calm',
            'feeling' => 'good',
            'rating' => '5',
        ]);
    }
}
