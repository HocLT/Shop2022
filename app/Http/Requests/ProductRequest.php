<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'price' => 'required',
            'photo' => 'required|image|mimes:jpg,png,jpeg,gif',
        ];

    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required!',
            'price.required' => 'Price is required!',
            //'price.min' => 'Price must be greater than 5!',
            'photo.required' => 'Image is required!',
            'photo.image' => 'Please upload image!',
            'photo.mimes' => 'Accept image type: jpg,png,jpeg,gif!',
        ];
    }

}
