<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PaymentMethodRequest extends FormRequest
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
                    'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'name' => 'required|min:1|max:255',
                    'account_number' => 'required|min:5|max:255',
                    'account_owner' => 'required|min:5|max:255',
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'name' => 'required|min:1|max:255',
                    'account_number' => 'required|min:5|max:255',
                    'account_owner' => 'required|min:5|max:255',
                ];
            default:
                return [];
                break;
        }
    }
}
