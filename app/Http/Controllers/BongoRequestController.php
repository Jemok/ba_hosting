<?php

namespace Md\Http\Controllers;

use Illuminate\Http\Request;
use Md\Http\Requests;
use Md\Http\Controllers\Controller;
use Md\Http\Requests\BongoRequestRequest;

use Md\Repos\BongoRequest\BongoRequestRepo;

class BongoRequestController extends Controller
{
    public function __construct()
    {

    }
    /**
     * Get the send request view
     * @return \Illuminate\View\View
     */
    public function getSendRequest()
    {
        return view('request.send.bongo');
    }

    /**
     * Save the request to the database
     */
    public function persistRequest(BongoRequestRequest $bongoRequestRequest, BongoRequestRepo $bongoRequestRepo)
    {
        $bongoRequestRepo->persist($bongoRequestRequest);

        return view('request.received');
    }

    public function getAll(BongoRequestRepo $bongoRequestRepo)
    {
        $requests = $bongoRequestRepo->all();

        return view('request.bongo.all', compact('requests'));
    }

    public function bongoSendLink($request_id, BongoRequestRepo $bongoRequestRepo)
    {
        $request_link = $bongoRequestRepo->sendLink($request_id);

        return view('request.bongo.link', compact('request_link'));
    }

    public function bongoConfirmLink($request_link, BongoRequestRepo $bongoRequestRepo)
    {

        $confirm = $bongoRequestRepo->confirm($request_link);

        if($confirm == null)
        {
            return view('errors.404');
        }
        else
        {
            \Auth::logout();
            return view('request.bongo.register', compact('confirm'));
        }
    }

}
