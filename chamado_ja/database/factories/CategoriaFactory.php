<?php

namespace Database\Factories;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Categoria>
 */
class CategoriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome_categoria'=>fake()->randomElement([
                'Computador',
                'Sistema',
                'Rede',
                'Impressora',
                'Periféricos',
                'Banco de Dados',
                'Aplicativos',
                'Segurança'
            ]),
            'tipo'=>fake()->randomElement([
                'Hardware',
                'Software',
                'Infraestrutura',
                'Suporte',
                'Comunicação'
            ])
        ];
    }
}
