<?php

namespace Md\Http\Requests;

use Md\Http\Requests\Request;

class RegisterModeratorRequest extends Request
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
            'first_name' => 'required|min:2|max:20',
            'last_name'  => 'required|min:2|max:20',
            'email' => 'required|email|between:3,64|unique:users',
            'password' => 'required|confirmed|min:6|max:15',
            'password_confirmation' => 'required|min:6|max:15'
        ];
    }
}
