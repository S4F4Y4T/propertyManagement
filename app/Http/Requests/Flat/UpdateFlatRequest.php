<?php

namespace App\Http\Requests\Flat;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFlatRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'flat_number' => 'required|integer|min:1|unique:flats,flat_number,' . $this->flat->id,
            'rooms' => 'required|integer|min:1',
            'floor' => 'required|integer|min:0',
            'note' => 'nullable|string|max:500',
        ];
    }
}
