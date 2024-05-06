<?php

namespace App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class CampainRequest extends FormRequest
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
            'campain_name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'type' => 'required|in:ready,live',
            'video' => 'nullable|mimes:mp4,mov,ogg',
        ];
    }

    public function messages()
    {
        return [
            'campain_name.required' => 'Campain Name is Required.',
        ];
    }
}
