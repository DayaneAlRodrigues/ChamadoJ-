<?php

namespace Database\Factories;

use App\Models\Chamado;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Usuario;
use App\Models\Categoria;
/**
 * @extends Factory<Chamado>
 */
class ChamadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo'=>fake()->sentence(),
            'descricao'=>fake()->paragraph(),
            'status'=>fake()->randomElement([
                'aberto',
                'em atendimento',
                'resolvido',
                'fechado'
            ]),
            'prioridade'=>fake()->randomElement([
                'baixa',
                'média',
                'alta',
                'urgente'
            ]),
            'usuario_id' => Usuario::query()
                ->inRandomOrder()
                ->value('id_usuario'),

            'categoria_id' => Categoria::query()
                ->inRandomOrder()
                ->value('id_categoria'),
        ];
    }
}
