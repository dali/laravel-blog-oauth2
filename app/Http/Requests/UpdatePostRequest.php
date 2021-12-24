<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
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
            'meta_title' => 'required|max:60',
            'meta_description' => 'required|max:150',
            'title' => [
                'required',
                'max:255',
                Rule::unique('posts')->ignore($this->route('post'))
            ],
            'slug' => [
                'required',
                'alpha_dash',
                Rule::unique('posts')->ignore($this->route('post'))
            ],
            'excerpt' => 'required',
            'body' => 'required',
            'published' => 'boolean',
            'publish_date' => 'nullable|date',
        ];
    }
}
