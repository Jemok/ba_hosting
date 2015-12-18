<?php

namespace Md\Http\Controllers;

use Illuminate\Http\Request;
use Md\Http\Requests;
use Md\Http\Controllers\Controller;
use Md\Repos\Profile\ProfileRepository;
use Md\Http\Requests\InvestorFundRequest;
use Illuminate\Support\Facades\Session;

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
}
