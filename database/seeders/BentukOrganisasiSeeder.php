<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BentukOrganisasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bentuk_organisasis')->insert([
            ['nama' => 'Lembaga Swadaya Masyarakat/LSM'],
            ['nama' => 'Yayasan'],
            ['nama' => 'Perkumpulan'],
            ['nama' => 'Organisasi Kemasyarakatan Tak Berbadan Hukum'],
            ['nama' => 'Forum'],
        ]);
    }
}
