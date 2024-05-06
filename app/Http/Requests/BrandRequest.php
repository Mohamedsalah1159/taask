<?php

namespace App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'brand_name' => 'required|string|max:150',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }

    public function messages()
    {
        return [
            'brand_name.required' => 'Brand Name is Required.',
            'brand_name.max' => 'Brand Name must not more than 150',
        ];
    }
}
