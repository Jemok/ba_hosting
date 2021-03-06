<?php

/**
 * This controller manages profile input and output flow
 *
 */

namespace Md\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Md\Http\Requests;
use Md\Repos\Profile\ProfileRepository;
use Md\Http\Requests\InvestorFundRequest;
use Illuminate\Support\Facades\Session;
use Md\Http\Requests\ProfileUpdation;
use Md\Http\Requests\ProfileUpdationMother;
use Md\Http\Requests\ChangePasswordRequest;
use Md\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class ProfileController extends Controller
{
    /**
     * @var \Md\Repos\Profile\ProfileRepository
     */
    protected $repo;

    /**
     * @param ProfileRepository $profileRepository
     */
    public function __construct(ProfileRepository $profileRepository)
    {
        $this->repo = $profileRepository;
    }

    public function getTerms(){

       return view('pages.terms');

    }

    /**
     * Displays a profile
     * @param $innovator_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function loadProfile($innovator_id)
    {
        $profile = $this->repo->load($innovator_id);

        if($profile == null)
        {
            return view('errors.404');
        }else
        {
            return view('profile.profile', compact('profile'));
        }
    }

    /**
     * Sets an investors amount on their profile
     * @param InvestorFundRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function SetInvestorAmount(InvestorFundRequest $request)
    {
        $this->repo->setInvestorFinance($request);

        Session::flash('flash_message', 'You can now browse and fund innovations');

        return redirect('/home');
    }

    /**
     * Updates an innovators profile
     * @param $profile_id
     * @param ProfileUpdation $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfileInnovator($profile_id,  ProfileUpdation $request)
    {
        $this->repo->updateProfileInnovator($profile_id, $request);

        Session::flash('flash_message', 'Profile was updated successfully');
        return redirect()->back();

    }

    /**
     * Updates an investors profile
     * @param $profile_id
     * @param ProfileUpdation $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfileInvestor($profile_id,  ProfileUpdation $request)
    {
        $this->repo->updateProfileInvestor($profile_id, $request);

        Session::flash('flash_message', 'Profile was updated successfully');
        return redirect()->back();

    }

    /**
     * updates the expert profile
     * @param $profile_id
     * @param ProfileUpdation $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfileExpert($profile_id,  ProfileUpdation $request)
    {
        $this->repo->updateProfileExpert($profile_id, $request);

        Session::flash('flash_message', 'Profile was updated successfully');
        return redirect()->back();
    }

    /**
     * Updates the mother profile
     * @param $profile_id
     * @param ProfileUpdation $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfileMother($profile_id,  ProfileUpdation $request)
    {
        $this->repo->updateProfileMother($profile_id, $request);

        Session::flash('flash_message', 'Profile was updated successfully');
        return redirect()->back();
    }

    /**
     * Updates passwords
     * @param ChangePasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        $user = User::find(\Auth::user()->id);

        $old_password =  $request->old_password;
        $password = $request->password;

        if(Hash::check($old_password, $user->password))
        {
            $user->password = Hash::make($password);

            if($user->save())
            {
                Session::flash('flash_message', 'Password was successfully changed');

                return redirect()->back();
            }
        }else
        {
            Session::flash('flash_message_error', 'Password was not changed, try again');
            return redirect()->back();
        }
    }

    /**
     * Updates a profile picture
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function uploadProfPic()
    {
        // getting all of the post data
        $file = array('image' => Input::file('image'));
        // setting up rules
        $rules = array('image' => 'required'); //mimes:jpeg,bmp,png and for max size max:10000
        // doing the validation, passing post data, rules and the messages
        $validator = Validator::make($file, $rules);
        if ($validator->fails()) {
            // send back to the page with the input data and errors
            return redirect()->back()->withInput()->withErrors($validator);
        }
        else {
            // checking file is valid.
            if (Input::file('image')->isValid()) {
                $destinationPath = 'uploads'; // upload path
                $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                $fileName = rand(11111,99999).'.'.$extension; // renameing image
                Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
                // sending back with message

                Auth::user()->prof_pic()->update([

                    'image' => $fileName

                ]);

                Session::flash('flash_message', 'Profile Picture was set');
                return redirect()->back();
            }
            else {
                // sending back with error message.
                Session::flash('error', 'uploaded file is not valid');
                return redirect()->back();
            }
        }
    }

}
