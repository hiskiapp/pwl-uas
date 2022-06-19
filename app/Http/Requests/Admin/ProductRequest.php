<?php

namespace App\Http\Requests\Admin;

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
        return auth('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                return [];
            case 'POST':
                return [
                    'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'name' => 'required|min:5|max:255',
                    'description' => 'nullable|min:5|max:255',
                    'stock' => 'required|integer',
                    'price' => 'required|integer',
                    'category_id' => 'required|integer|exists:categories,id',
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'name' => 'required|min:5|max:255',
                    'description' => 'nullable|min:5|max:255',
                    'stock' => 'required|integer',
                    'price' => 'required|integer',
                    'category_id' => 'required|integer|exists:categories,id',
                ];
            default:
                return [];
                break;
        }
    }
}
