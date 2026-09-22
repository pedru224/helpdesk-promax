<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
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
            'title' => ['required','string','min:5','max:150'],
            'department_id' => ['required','integer','exists:departments,id'],
            'requester_name' => ['required','string','min:3','max:100'],
            'priority' => ['required','in:Baixa,Média,Alta,Urgente'],
            'description' => ['required','string','min:10','max:2000'],
            'status' => ['nullable','in:Aberto,Em Atendimento,Concluído']
        ];
    }
}
