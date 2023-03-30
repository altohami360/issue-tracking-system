<?php

namespace App\Http\Requests;

use App\Enums\TicketStatus;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTicketRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required'],
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'priority' => ['required'],
            'role' => ['required'],
            'resolved' => ['required'],
        ];
    }

    public function prepareforvalidation()
    {
        $this->merge([
            'status' => TicketStatus::NEW->value,
            'user_id' => auth()->user()->id,
            'resolved' => false
        ]);
    }
}
