<?php

namespace App\Http\Requests\V1\User\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
        $rules = [
            'email' => 'required|email|unique:users,email,' . $this->id,
            'name' => 'required',
            'userCatalogueId' => 'gt:0',
            'phone' => 'required',
        ];

        if ($this->hasFile('image')) {
            $rules['image'] = 'required|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

        return $rules;
    }
    public function messages(): array
    {
        $messages = [
            'email.required' => 'Email is required',
            'email.email' => 'Email is not valid',
            'email.unique' => 'Email is already taken',
            'name.required' => 'Name is required',
            'userCatalogueId.gt' => 'User Catalogue is required',
            'phone.required' => 'Phone is required',
        ];

        if ($this->hasFile('image')) {
            $messages[] = [
                'image.required' => 'Image is required',
                'image.mimes' => 'Image must be a file of type: jpeg, png, jpg, gif, svg',
                'image.max' => 'Image must be a file of size: 2048',
            ];
        }

        return $messages;
    }
}
