<?php

namespace Md\Http\Requests;

use Md\Http\Requests\Request;

class MessagesCreateRequest extends Request
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
            'subject' => 'required|min:1|max:80',
            'message' => 'required|min:1|max:1000',
            'recipients' => 'required'
        ];
    }
}
