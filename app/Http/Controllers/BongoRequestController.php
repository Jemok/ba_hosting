<?php

/**
 * The Expert controller
 * which manages flow of expert input
 * and output
 *
 */

namespace Md\Http\Controllers;

use Md\Http\Requests;
use Md\Http\Requests\BongoRequestRequest;
use Md\Repos\BongoRequest\BongoRequestRepo;
use Illuminate\Support\Facades\Session;
use Md\Mailers\AppMailer;

class BongoRequestController extends Controller
{

    /**
     * Get the send request view
     * @return \Illuminate\View\View
     */
    public function getSendRequest()
    {
        return view('request.send.bongo');
    }

    /**
     * Save an Expert request to the database
     * @param BongoRequestRequest $bongoRequestRequest
     * @param BongoRequestRepo $bongoRequestRepo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function persistRequest(BongoRequestRequest $bongoRequestRequest, BongoRequestRepo $bongoRequestRepo)
    {
        $bongoRequestRepo->persist($bongoRequestRequest);

        return view('request.received');
    }

    /**
     * Get all the requests sent to Bongo by Experts
     * @param BongoRequestRepo $bongoRequestRepo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function getAll(BongoRequestRepo $bongoRequestRepo)
    {
        $requests = $bongoRequestRepo->all();

        return view('request.bongo.all', compact('requests'));
    }

    /**
     * Send an Expert registration link
     * @param $request_id
     * @param BongoRequestRepo $bongoRequestRepo
     * @param AppMailer $mailer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function bongoSendLink($request_id, BongoRequestRepo $bongoRequestRepo, AppMailer $mailer)
    {
        $request = $bongoRequestRepo->sendLink($request_id);

        $mailer->sendExpertRegLinkEmail($request->request_link, $request->bongo_email);

        Session::flash('flash_message', 'The email was sent successfully!');
        return redirect()->back();
    }

    /**
     * Handle the process of confirming an Expert confirmation request
     * @param $request_link
     * @param BongoRequestRepo $bongoRequestRepo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function bongoConfirmLink($request_link, BongoRequestRepo $bongoRequestRepo)
    {
        if(\Auth::check())
        {
            $email = $bongoRequestRepo->getEmail($request_link);

            return view('account.logout_auth', compact('email'));
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
