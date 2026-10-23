<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateChamadoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titulo' => ['sometimes','required', 'string', 'max:100'],
            'descricao' => ['sometimes','required', 'string', 'min:10'],
            'status'=> [
                    'sometimes',
                    'required',
                Rule::in(['aberto','em_atendimento', 'resolvido', 'fechado'])
            ],
            'prioridade' => [
                    'sometimes',
                    'required',
                Rule::in(['baixa', 'media', 'alta']),
            ],
            'usuario_id' => ['sometimes','required', 'integer', 'exists:usuarios,id_usuario'],
            'categoria_id' => ['sometimes','required', 'integer', 'exists:categorias,id_categoria'],
        ];
    }
}
