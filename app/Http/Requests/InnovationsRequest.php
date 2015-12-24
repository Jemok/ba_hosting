<?php

namespace Md\Http\Requests;

use Md\Http\Requests\Request;

class InnovationsRequest extends Request
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

            'innovationTitle' => 'required|alpha_dash|min:2|max:60',
            'innovationShortDescription' => 'required|alpha_dash|min:10|max:144',
            'innovationDescription' => 'required|alpha_dash|min:100|max:50000',
            'innovationCategory' => 'required|numeric',
            'innovationFund' => 'required|numeric|min:1',
            'justifyFund'    => 'required|alpha_dash|min:2'
        ];
    }
}
