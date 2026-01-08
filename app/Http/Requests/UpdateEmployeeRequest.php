<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // يسمح للـController باستخدام هذا الطلب
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'email' => [
                'sometimes',
                'required',
                'email',
                Rule::unique('employees')->ignore($this->route('employee'))
            ],
            'position' => 'sometimes|required|string|max:255',
            'salary' => 'sometimes|required|numeric',
            'status' => 'sometimes|required|in:active,inactive',
        ];
    }
}
