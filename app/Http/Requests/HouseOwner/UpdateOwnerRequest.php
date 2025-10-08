<?php

namespace App\Http\Requests\HouseOwner;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UpdateOwnerRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $this->house_owner->id,
            'password' => 'nullable|string|min:6',

            'building' => 'required|array',
            'building.name' => 'required|string|max:255',
            'building.address' => 'required|string|max:500',
            'building.note' => 'nullable|string|max:500',
        ];
    }

    public function validatedData()
    {
        $validatedData = parent::validated();
        if(!empty($validatedData['password'])){
             $validatedData['password'] = Hash::make($validatedData['password']);
        }
        return $validatedData;
    }
}
