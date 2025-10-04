<?php

namespace App\Http\Requests\Flat;

use Illuminate\Foundation\Http\FormRequest;

class CreateFlatRequest extends FormRequest
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
            'flat_number' => 'required|integer|min:1|unique:flats,flat_number',
            'rooms' => 'required|integer|min:1',
            'floor' => 'required|integer|min:0',
            'note' => 'nullable|string|max:500',
        ];
    }

    public function validatedData() {
        $data = parent::validated();

        $data['building_id'] = auth()->user()->building?->id;

        return $data;
    }
}
