<?php

namespace Md\Http\Controllers\Auth;

use Md\User;
use Illuminate\Support\Facades\Request;
use Validator;
use Md\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return \Md\Http\Controllers\Auth\AuthController
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if(Request::path() == "auth/register/investor")
        {
            return Validator::make($data, [
                'first_name' => 'required|max:255',
                'last_name'  => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|confirmed|min:6',
                //'userCategory' => 'required'
            ]);
        }elseif(Request::path() == "auth/register/innovator")
        {
            return Validator::make($data, [
                'first_name' => 'required|max:255',
                'last_name'  => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                'more_details' => 'required',
                'terms'        => 'required|numeric',
                'password' => 'required|confirmed|min:6',
                //'userCategory' => 'required'
            ]);
        }elseif(Request::path() == "auth/register/bongo-employee")
        {
            return Validator::make($data, [
                'first_name' => 'required|max:255',
                'last_name'  => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|confirmed|min:6',
                //'userCategory' => 'required'
            ]);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {

        if(Request::path() == "auth/register/investor")
        {
            return User::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'userCategory' => 2
            ]);
        }
        elseif(Request::path() == "auth/register/innovator")
        {
            return User::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'more_details' => $data['more_details'],
                'terms'   => $data['terms'],
                'userCategory' => 1
            ]);
        }
        elseif(Request::path() == "auth/register/bongo-employee")
        {
            return User::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'userCategory' => 3
            ]);
        }
    }
}
