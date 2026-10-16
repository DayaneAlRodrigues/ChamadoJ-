<?php

namespace Database\Factories;

use App\Models\Comentario;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Chamado;
/**
 * @extends Factory<Comentario>
 */
class ComentarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'comentario'=>fake()->text(),
            'created_at'=>fake()->dateTime(),
            'chamado_id'=> Chamado::query()
                ->inRandomOrder()
                ->value('id_chamado'),

        ];
    }
}
