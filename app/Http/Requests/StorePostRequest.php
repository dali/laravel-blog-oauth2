<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title' => 'required|unique:posts|max:255',
            'slug' => [
                'required',
                'alpha_dash',
                'unique:posts'
            ],
            'excerpt' => 'required',
            'body' => 'required',
            'published' => 'boolean',
            'publish_date' => 'nullable|date',
        ];
    }
}
