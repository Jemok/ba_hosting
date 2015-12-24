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
            'subject' => 'required|min:1|max:30|alpha_dash',
            'message' => 'required|min:1|max:144|alpha_dash',
            'recipients' => 'required'
        ];
    }
}
