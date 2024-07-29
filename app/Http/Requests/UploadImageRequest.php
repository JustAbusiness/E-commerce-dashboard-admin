<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadImageRequest extends FormRequest
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
            'files.*' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048|dimesions:min_width=100,min_height=100',
        ];
    }

    public function messages(): array
    {
        return [
            'files.required' => 'Files is required',
            'files.file' => 'File must be a file',
            'files.mimes' => 'File must be a type: jpeg, png, jpg, gif, svg',
            'files.max' => 'File must be less than 2MB',
            'files.dimensions' => 'Image must be at least 100x100 pixels',
        ];
    }
}
