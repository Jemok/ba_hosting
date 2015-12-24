<?php

namespace Md\Http\Requests;

use Md\Http\Requests\Request;

class InvestorRequestRequest extends Request
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

            'investor_email' => 'email|required|between:3,64|unique:investor_requests',
            'first_name' => 'required|min:2|max:20|alpha',
            'last_name'  => 'required|min:2|max:20|alpha',
            'company'     => 'required|alpha_dash|min:2|max:200',
            'job_title'   => 'required|alpha_dash|min:2|max:30',
        ];
    }
}
