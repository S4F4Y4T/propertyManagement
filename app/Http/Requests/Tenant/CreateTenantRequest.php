<?php

namespace App\Http\Requests\Tenant;

use Illuminate\Foundation\Http\FormRequest;

class CreateTenantRequest extends FormRequest
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
            'contact_number' => 'required|string|max:20|unique:tenants,contact_number',
            'email' => 'nullable|email|max:255|unique:tenants,email',
            'flat_id' => 'required|exists:flats,id',
            'owner_id' => 'required|exists:users,id',
        ];
    }
}
