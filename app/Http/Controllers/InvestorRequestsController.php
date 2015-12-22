<?php

namespace Md\Http\Controllers;

use Illuminate\Http\Request;
use Md\Http\Requests;
use Md\Http\Controllers\Controller;
use Md\Http\Requests\InvestorRequestRequest;
use Md\Repos\InvestorRequest\InvestorRequestRepo;
use Illuminate\Support\Facades\Session;
use Md\Mailers\AppMailer;


class InvestorRequestsController extends Controller
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
        return view('request.send.investor');
    }

    /**
     * Save the request to the database
     */
    public function persistRequest(InvestorRequestRequest $investorRequestRequest, InvestorRequestRepo $investorRequestRepo)
    {
        $investorRequestRepo->persist($investorRequestRequest);

        return view('request.received');
    }

    public function getAll(InvestorRequestRepo $investorRequestRepo)
    {
        $requests = $investorRequestRepo->all();

        return view('request.investor.all', compact('requests'));
    }

    public function bongoSendLink($request_id, InvestorRequestRepo $investorRequestRepo, AppMailer $mailer)
    {
        $request = $investorRequestRepo->sendLink($request_id);


        $mailer->sendInvestorRegLinkEmail($request->request_link, $request->investor_email);

        Session::flash('flash_message', 'The email was sent successfully!');
        return redirect()->back();
        //return view('request.investor.link', compact('request_link'));
    }

    public function bongoConfirmLink($request_link, InvestorRequestRepo $investorRequestRepo)
    {

        if(\Auth::check())
        {
            return view('account.logout_auth');
        }
        else{

            $confirm = $investorRequestRepo->confirm($request_link);

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
                $confirm = $investorRequestRepo->getInvestorRequest($request_link);
                return view('request.investor.register', compact('confirm'));
            }

        }

    }
}
