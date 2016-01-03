<?php

namespace Illuminate\Foundation\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        if($request->path() == "auth/register/innovator")
        {
            $this->create($request->all());

            Session::flash('flash_message', 'A confirmation email has been sent to you, confirm it to enable login.');

            return redirect('auth/login');
        }
        else
        {
            Auth::login($this->create($request->all()));

            return redirect($this->redirectPath());
        }


    }
}
