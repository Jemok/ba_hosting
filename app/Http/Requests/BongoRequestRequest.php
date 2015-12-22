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
            'bongo_email' => 'email|required|unique:bongo_requests',
            'first_name'  => 'required',
            'last_name'   => 'required',
            'company'     => 'required',
            'job_title'   => 'required',
            'field'       => 'required'
        ];
    }
}
