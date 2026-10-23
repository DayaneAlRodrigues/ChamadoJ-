<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreChamadoRequest extends FormRequest
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
            
            'titulo' => ['required', 'string', 'max:100'],
            'descricao' => ['required', 'string', 'min:10'],
            'prioridade' => [
                    'required',
                Rule::in(['baixa', 'media', 'alta']),
            ],
            'usuario_id' => ['required', 'integer', 'exists:usuarios,id_usuario'],
            'categoria_id' => ['required', 'integer', 'exists:categorias,id_categoria'],
        ];
    }
}
