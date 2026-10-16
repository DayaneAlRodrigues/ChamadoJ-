<?php

namespace Database\Seeders;

use App\Models\Chamado;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChamadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Chamado::factory()->count(10)->create();
    }
}
