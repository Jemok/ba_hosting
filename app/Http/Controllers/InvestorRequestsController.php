<?php

/**
 * Manages investors requests workflow
 */

namespace Md\Http\Controllers;

use Md\Http\Requests;
use Md\Http\Requests\InvestorRequestRequest;
use Md\Repos\InvestorRequest\InvestorRequestRepo;
use Illuminate\Support\Facades\Session;
use Md\Mailers\AppMailer;


class InvestorRequestsController extends Controller
{
    /**
     * Get the send request view
     * @return \Illuminate\View\View
     */
    public function getSendRequest()
    {
        return view('request.send.investor');
    }

    /**
     * Saves an investor request to the database
     * @param InvestorRequestRequest $investorRequestRequest
     * @param InvestorRequestRepo $investorRequestRepo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function persistRequest(InvestorRequestRequest $investorRequestRequest, InvestorRequestRepo $investorRequestRepo)
    {
        $investorRequestRepo->persist($investorRequestRequest);

        return view('request.received');
    }

    /** Grabs all investors requests
     * @param InvestorRequestRepo $investorRequestRepo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAll(InvestorRequestRepo $investorRequestRepo)
    {
        $requests = $investorRequestRepo->all();

        return view('request.investor.all', compact('requests'));
    }

    /**
     * Sends a invitation email to investors
     * @param $request_id
     * @param InvestorRequestRepo $investorRequestRepo
     * @param AppMailer $mailer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function bongoSendLink($request_id, InvestorRequestRepo $investorRequestRepo, AppMailer $mailer)
    {
        $request = $investorRequestRepo->sendLink($request_id);
        $mailer->sendInvestorRegLinkEmail($request->request_link, $request->investor_email);

        Session::flash('flash_message', 'The email was sent successfully!');
        return redirect()->back();
    }

    /**
     * Handles investors confirmation process
     * @param $request_link
     * @param InvestorRequestRepo $investorRequestRepo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function bongoConfirmLink($request_link, InvestorRequestRepo $investorRequestRepo)
    {

        if(\Auth::check())
        {
            $email = $investorRequestRepo->getEmail($request_link);

            return view('account.logout_auth', compact('email'));
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
