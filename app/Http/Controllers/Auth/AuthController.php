<?php

namespace Md\Http\Controllers\Auth;

use Md\User;
use Md\Bongo_request;
use Md\Investor_request;
use Illuminate\Support\Facades\Request;
use Validator;
use Md\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Md\Mailers\AppMailer;
use Illuminate\Support\Facades\Session;

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

    private $bongo_request;

    private $investor_request;

    /**
     * @param AppMailer $appMailer
     */
    public function __construct(AppMailer $appMailer, Bongo_request $bongo_request, Investor_request $investor_request)
    {
        $this->middleware('guest', ['except' => 'getLogout']);

        $this->mailer = $appMailer;

        $this->bongo_request =$bongo_request;

        $this->investor_request = $investor_request;
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

        if(Request::path() == "auth/register/innovator")
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
                'first_name' => 'required|min:2|max:20',
                'last_name'  => 'required|min:2|max:20',
                'email' => 'required|email|between:3,64|unique:users',
                'more_details' => 'required|between:5,144',
                'password' => 'required|confirmed|min:6|max:15',
                'password_confirmation' => 'required|min:6|max:15'
                //'userCategory' => 'required'
            ]);
        }elseif(Request::path() == "auth/register/innovator")
        {
            return Validator::make($data, [
                'first_name' => 'required|min:2|max:20',
                'last_name'  => 'required|min:2|max:20',
                'email' => 'required|email|between:3,64|unique:users',
                'more_details' => 'required|between:5,144',
                'terms'        => 'required|numeric|accepted:1',
                'password' => 'required|confirmed|min:6|max:15',
                'password_confirmation' => 'required|min:6|max:15'
                //'userCategory' => 'required'
            ]);
        }elseif(Request::path() == "auth/register/expert")
        {
            return Validator::make($data, [
                'first_name' => 'required|min:2|max:20',
                'last_name'  => 'required|min:2|max:20',
                'email' => 'required|email|between:3,64|unique:users',
                'more_details' => 'required|between:5,144',
                'password' => 'required|confirmed|min:6|max:15',
                'password_confirmation' => 'required|min:6|max:15'
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
             $user = $this->investor_request->where('investor_email', '=', $data['email'])->first()->user()->create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'more_details' => $data['more_details'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'userCategory' => 2,
                'hash_id'     => str_random(100),
                'verified' => 1
            ]);

            $user->prof_pic()->create([]);

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
                'hash_id'     => str_random(100),
                'verified'  => 0
            ]);

            $user->prof_pic()->create([]);

            $this->mailer->sendConfirmEmailLink($user);

            return $user;

        }
        elseif(Request::path() == "auth/register/expert")
        {
            $user = $this->bongo_request->where('bongo_email', '=', $data['email'])->first()->user()->create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'more_details' => $data['more_details'],
                'userCategory' => 3,
                'hash_id'     => str_random(100),
                'verified'    => 1
            ]);

            $user->prof_pic()->create([]);

            //$this->mailer->sendConfirmEmailLink($user);

            return $user;
        }
    }

    public function confirmEmail($token)
    {
        User::whereToken($token)->firstOrFail()->confirmEmail();

        Session::flash('flash_message', 'Account was successfully confirmed, you can now publish your innovations!');


        return redirect('/home');
    }
}
