<?php

namespace App\Http\Requests\Flat;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

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
            'flat_number' => 'required|min:1|unique:flats,flat_number',
            'rooms' => 'required|integer|min:1',
            'floor' => 'required|integer|min:0',
            'note' => 'nullable|string|max:500',
        ];
    }

    public function validatedData(): array
    {
        $data = parent::validated();

        $buildingId = auth()->user()->building?->id;

        info($buildingId);

        if (!$buildingId) {
            throw ValidationException::withMessages([
                'building_id' => ['Owner doesnt have any building yet.'],
            ]);
        }

        $data['building_id'] = $buildingId;

        return $data;
    }
}
