<?php

namespace Md\Http\Requests;

use Md\Http\Requests\Request;

class PartialFundingRequest extends Request
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
            'partialFund' => 'required|numeric|min:1'
        ];
    }
}
