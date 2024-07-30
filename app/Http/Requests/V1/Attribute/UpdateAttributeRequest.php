<?php

namespace App\Http\Requests\V1\Attribute;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAttributeRequest extends FormRequest
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
            'name' => 'required',
            'code' => 'required|unique:attribute_catalogues,code, ' . $this->id . '',

        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'code.required' => 'Code is required',
            'code.unique' => 'Code must be unique',
        ];
    }
}
