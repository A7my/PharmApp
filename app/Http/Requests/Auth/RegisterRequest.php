<?php

namespace App\Http\Requests\Auth;

use App\Helpers\helper;
use Nette\Utils\Helpers;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{

    public function __construct(){
        $this->helper = new helper();
    }
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
            'phone_number' => 'required|unique:users',
            'password' => 'required|confirmed',
            'address' => 'required',
            'email' => 'required|email|unique:users',
        ];
    }


public function messages(){
    return [
        'name.required' => __('apis.NameRequired'),

        'phone_number.required' => __('apis.PhoneRequired'),
        'phone_number.unique' => __('apis.PhoneUnique'),

        'password.required' => __('apis.PasswordRequired'),
        'password.confirmed' => __('apis.PasswordConfirm'),

        'address.required' => __('apis.AddressRequired'),


        'email.required' => __('apis.EmailRequired'),
        'email.email' => __('apis.EmailType'),
        'email.unique' => __('apis.EmailUnique')
    ];
}
}
