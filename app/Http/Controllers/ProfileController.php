<?php

namespace Md\Http\Controllers;

use Illuminate\Http\Request;
use Md\Http\Requests;
use Md\Http\Controllers\Controller;
use Md\Repos\Profile\ProfileRepository;
use Md\Http\Requests\InvestorFundRequest;
use Illuminate\Support\Facades\Session;
use Md\Http\Requests\ProfileUpdation;
use Md\Http\Requests\ProfileUpdationMother;
class ProfileController extends Controller
{
    protected $repo;

    public function __construct(ProfileRepository $profileRepository)
    {
        $this->repo = $profileRepository;
    }

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

    public function SetInvestorAmount(InvestorFundRequest $request)
    {
        $this->repo->setInvestorFinance($request);

        Session::flash('flash_message', 'You can now browse and fund innovations');

        return redirect('/home');
    }

    public function updateProfileInnovator($profile_id,  ProfileUpdation $request)
    {
        $this->repo->updateProfileInnovator($profile_id, $request);

        Session::flash('flash_message', 'Profile was updated successfully');
        return redirect()->back();

    }

    public function updateProfileInvestor($profile_id,  ProfileUpdation $request)
    {
        $this->repo->updateProfileInvestor($profile_id, $request);

        Session::flash('flash_message', 'Profile was updated successfully');
        return redirect()->back();

    }

    public function updateProfileExpert($profile_id,  ProfileUpdation $request)
    {
        $this->repo->updateProfileExpert($profile_id, $request);

        Session::flash('flash_message', 'Profile was updated successfully');
        return redirect()->back();

    }

    public function updateProfileMother($profile_id,  ProfileUpdationMother $request)
    {
        $this->repo->updateProfileExpert($profile_id, $request);

        Session::flash('flash_message', 'Profile was updated successfully');
        return redirect()->back();

    }

}
