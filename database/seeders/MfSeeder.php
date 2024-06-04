<?php

namespace Database\Seeders;

use App\Models\Mf;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Mf::factory()
            ->count(6)
            ->Create();
    }
}
