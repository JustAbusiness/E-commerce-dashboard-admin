<?php

namespace App\Http\Requests\V1\User;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
          'email' => 'required|email|unique:users.email,'.$this->id,
          'name' => 'required',
          'password' => 'required|string|min:6',
          'repassword' => 'required|same:password',
          'userCatalogueId' => 'gt:0',
          'phone' => 'required',
        //   'image' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email is required',
            'email.email' => 'Email is not valid',
            'name.required' => 'Name is required',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 6 characters',
            'repassword.required' => 'Repassword is required',
            'repassword.same' => 'Repassword must be the same as password',
            'userCatalogueId.gt' => 'User Catalogue is required',
            'phone.required' => 'Phone is required',
            // 'image.required' => 'Image is required',
            // 'image.file' => 'Image must be a file',
            // 'image.mimes' => 'Image must be a file of type: jpeg, png, jpg, gif, svg',
            // 'image.max' => 'Image must be a file of size: 2048',
        ];
    }
}
