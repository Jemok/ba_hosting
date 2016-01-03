<?php

namespace Md\Http\Requests;

use Md\Http\Requests\Request;

class ChangePasswordRequest extends Request
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

            'old_password' => 'required',
            'password' => 'required|confirmed|min:6|max:15',
            'password_confirmation' => 'required|min:6|max:15'

        ];
    }
}
