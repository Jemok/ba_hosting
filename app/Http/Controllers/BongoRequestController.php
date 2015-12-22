<?php

namespace Md\Http\Controllers;

use Illuminate\Http\Request;
use Md\Http\Requests;
use Md\Http\Controllers\Controller;
use Md\Http\Requests\BongoRequestRequest;
use Md\Repos\BongoRequest\BongoRequestRepo;
use Illuminate\Support\Facades\Session;
use Md\Mailers\AppMailer;

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

    public function bongoSendLink($request_id, BongoRequestRepo $bongoRequestRepo, AppMailer $mailer)
    {
        $request = $bongoRequestRepo->sendLink($request_id);

        $mailer->sendExpertRegLinkEmail($request->request_link, $request->bongo_email);

        Session::flash('flash_message', 'The email was sent successfully!');
        return redirect()->back();
        //return view('request.bongo.link', compact('request_link'));
    }

    public function bongoConfirmLink($request_link, BongoRequestRepo $bongoRequestRepo)
    {
        if(\Auth::check())
        {
            return view('account.logout_auth');
        }
        else
        {
            $confirm = $bongoRequestRepo->confirm($request_link);

            if($confirm == 0)
            {
                return view('errors.invalid_link');
            }
            elseif($confirm == 1)
            {
                Session::flash('flash_message', 'Already have an account, Login with your bongo account and then visit your profile page to activate other bongo accounts');

                return view('auth.login');
            }
            elseif($confirm == 2)
            {
                \Auth::logout();
                $confirm = $bongoRequestRepo->getBongoRequest($request_link);

                return view('request.bongo.register', compact('confirm'));
            }
        }
    }
}
