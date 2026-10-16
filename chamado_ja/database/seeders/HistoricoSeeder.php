<?php

namespace Database\Seeders;

use App\Models\HistoricoStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HistoricoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HistoricoStatus::factory()->count(10)->create();
    }
}
