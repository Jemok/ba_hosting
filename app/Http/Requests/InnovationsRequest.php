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

            'innovationTitle' => 'required',
            'innovationShortDescription' => 'required|max:144',
            'innovationDescription' => 'required',
            'innovationCategory' => 'required',
            'innovationFund' => 'required | numeric',
            'justifyFund'    => 'required'
        ];
    }
}
