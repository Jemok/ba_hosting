<?php

namespace Md\Http\Controllers\Auth;

use Md\User;
use Illuminate\Support\Facades\Request;
use Validator;
use Md\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Md\Mailers\AppMailer;

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

    protected $mailer;

    /**
     * @param AppMailer $appMailer
     */
    public function __construct(AppMailer $appMailer)
    {
        $this->middleware('guest', ['except' => 'getLogout']);

        $this->mailer = $appMailer;
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
                'first_name' => 'required|min:2|max:20|alpha',
                'last_name'  => 'required|min:2|max:20|alpha',
                'email' => 'required|email|between:3,64|unique:users',
                'more_details' => 'required|alpha|between:5,144',
                'password' => 'required|confirmed|alpha|min:6|max:15',
                'password_confirmation' => 'required|alpha|min:6|max:15'
                //'userCategory' => 'required'
            ]);
        }elseif(Request::path() == "auth/register/innovator")
        {
            return Validator::make($data, [
                'first_name' => 'required|min:2|max:20|alpha',
                'last_name'  => 'required|min:2|max:20|alpha',
                'email' => 'required|email|between:3,64|unique:users',
                'more_details' => 'required|alpha|between:5,144',
                'terms'        => 'required|numeric|accepted:1',
                'password' => 'required|confirmed|alpha|min:6|max:15',
                'password_confirmation' => 'required|alpha|min:6|max:15'
                //'userCategory' => 'required'
            ]);
        }elseif(Request::path() == "auth/register/bongo-employee")
        {
            return Validator::make($data, [
                'first_name' => 'required|min:2|max:20|alpha',
                'last_name'  => 'required|min:2|max:20|alpha',
                'email' => 'required|email|between:3,64|unique:users',
                'more_details' => 'required|alpha|between:5,144',
                'password' => 'required|confirmed|alpha|min:6|max:15',
                'password_confirmation' => 'required|alpha|min:6|max:15'
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
             $user = User::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'more_details' => $data['more_details'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'userCategory' => 2,
                'hash_id'     => str_random(100)
            ]);

            //$this->mailer->sendConfirmEmailLink();

            return $user;
        }
        elseif(Request::path() == "auth/register/innovator")
        {
            $user = User::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'more_details' => $data['more_details'],
                'terms'   => $data['terms'],
                'userCategory' => 1,
                'hash_id'     => str_random(100)
            ]);

            //$this->mailer->sendConfirmEmailLink($user);

            return $user;

        }
        elseif(Request::path() == "auth/register/bongo-employee")
        {
            $user = User::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'userCategory' => 3,
                'hash_id'     => str_random(100)
            ]);

            //$this->mailer->sendConfirmEmailLink($user);

            return $user;
        }
    }
}
