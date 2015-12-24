<?php

namespace Md\Http\Requests;

use Md\Http\Requests\Request;

class ProfileUpdation extends Request
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
        if(\Auth::user()->isInnovator())
        {
        return [
            'first_name' => 'required|min:2|max:20|alpha',
            'last_name'  => 'required|min:2|max:20|alpha',
            'more_details' => 'required|alpha|between:5,144',
            'email'        => 'required|email|between:3,64|max:255|unique:users,email,'.\Auth::user()->id
        ];
        }

        if(\Auth::user()->isInvestor())
        {

         return [
                'first_name' => 'required|min:2|max:20|alpha',
                'last_name'  => 'required|min:2|max:20|alpha',
                'more_details' => 'required|alpha_dash|between:5,144',
                'email'        => 'required|email|between:3,64|max:255|unique:users,email,'.\Auth::user()->id,
                'financial_amount' => 'required|numeric|min:1'
            ];
        }

        if(\Auth::user()->isMother())
        {

            return [
                'first_name' => 'required|min:2|max:20|alpha',
                'last_name'  => 'required|min:2|max:20|alpha',
                'email'        => 'required|email|between:3,64|max:255|unique:users,email,'.\Auth::user()->id,
            ];
        }

        if(\Auth::user()->isAdmin())
        {

            return [
                'first_name' => 'required|min:2|max:20|alpha',
                'last_name'  => 'required|min:2|max:20|alpha',
                'more_details' => 'required|alpha_dash|between:5,144',
                'email'        => 'required|email|between:3,64|unique:users,email,'.\Auth::user()->id,
            ];
        }


    }
}
