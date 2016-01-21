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

            'innovationTitle' => 'required|min:2|max:30',
            'innovationShortDescription' => 'required|min:10|max:300',
            'innovationDescription' => 'required|min:100|max:50000',
            'innovationCategory' => 'required|numeric',
            'innovationFund' => 'required|numeric|min:1',
            'justifyFund'    => 'required|min:2'
        ];
    }
}
