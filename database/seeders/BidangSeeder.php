<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BidangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bidangs')->insert([
            ['nama' => 'Pendidikan'],
            ['nama' => 'Kesehatan'],
            ['nama' => 'Sosial'],
            ['nama' => 'Ekonomi'],
            ['nama' => 'Keagamaan'],
        ]);
    }
}
