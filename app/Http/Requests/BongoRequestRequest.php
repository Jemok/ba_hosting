<?php

namespace Md\Http\Requests;

use Md\Http\Requests\Request;

class BongoRequestRequest extends Request
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
            'bongo_email' => 'email|required|between:3,64|unique:bongo_requests',
            'first_name' => 'required|min:2|max:20',
            'last_name'  => 'required|min:2|max:20',
            'company'     => 'required|min:2|max:200',
            'job_title'   => 'required|min:2|max:20',
            'field'       => 'required|min:2|max:20'
        ];
    }
}
