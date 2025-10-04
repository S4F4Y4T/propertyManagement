<?php

namespace App\Http\Requests\Bill;

use Illuminate\Foundation\Http\FormRequest;

class CreateBillRequest extends FormRequest
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
            'bills' => ['required', 'array', 'min:1'],
            'bills.*.month' => ['required', 'date_format:Y-m'],
            'bills.*.total_amount' => ['required', 'numeric', 'min:0'],
            'bills.*.bill_category_id' => ['required', 'exists:bill_categories,id'],
        ];
    }
}
