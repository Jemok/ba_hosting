<?php

namespace Md\Http\Controllers;

use Illuminate\Http\Request;
use Md\Http\Requests;
use Md\Http\Controllers\Controller;
use Md\Repos\ProfileRepository;

class ProfileController extends Controller
{

    public function loadProfile($innovator_id, ProfileRepository $profileRepository)
    {
        $profile = $profileRepository->load($innovator_id);

        if($profile == null)
        {
            return view('errors.404');
        }else
        {
            return view('profile.profile', compact('profile'));
        }
    }
}
