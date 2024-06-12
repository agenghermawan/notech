<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:products',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:100',
            'sale_price' => 'required|numeric',
            'purchase_price' => 'required|numeric',
            'stock' => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Item name is required',
            'photo.required' => 'Item photo is required',
            'sale_price.required' => 'Sale price is required',
            'purchase_price.required' => 'Purchase price is required',
            'stock.required' => 'Stock is required',
            'name.unique' => 'Item name must be unique',
            'photo.image' => 'Item photo must be an image',
            'photo.mimes' => 'Item photo must be a jpeg, png, jpg',
            'photo.max' => 'Item photo must be less than 100KB',
            'sale_price.numeric' => 'Sale price must be a number',
            'purchase_price.numeric' => 'Purchase price must be a number',
            'stock.integer' => 'Stock must be an integer',
            'stock.min' => 'Stock must be at least 1',
        ];
    }
}
