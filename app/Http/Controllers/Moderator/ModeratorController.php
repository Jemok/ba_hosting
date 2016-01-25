<?php

namespace Md\Http\Controllers\Moderator;

use Illuminate\Http\Request;

use Md\Http\Requests;
use Md\Http\Controllers\Controller;
use Md\Http\Requests\RegisterModeratorRequest;
use Md\Repos\Moderator\ModeratorRepo;
use Illuminate\Support\Facades\Session;

class ModeratorController extends Controller
{
    public function addNew()
    {
        return view('moderator.add');
    }

    public function store(RegisterModeratorRequest $moderatorRequest, ModeratorRepo $moderatorRepo)
    {
        $moderatorRepo->store($moderatorRequest);

        Session::flash('flash_message', 'Moderator was added successfully');

        return back();
    }
}
