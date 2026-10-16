<?php

namespace Database\Factories;

use App\Models\HistoricoStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Chamado;

/**
 * @extends Factory<HistoricoStatus>
 */
class HistoricoStatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
    
            return [
            'status'=>fake()->randomElement([
                'aberto',
                'em atendimento',
                'resolvido',
                'fechado'
            ]),
            'created_at'=>fake()->dateTime(),
            'chamado_id'=> Chamado::query()
                ->inRandomOrder()
                ->value('id_chamado')
        ];
        
    }
}
