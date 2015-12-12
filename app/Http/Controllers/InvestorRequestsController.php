<?php

namespace Md\Http\Controllers;

use Illuminate\Http\Request;
use Md\Http\Requests;
use Md\Http\Controllers\Controller;
use Md\Http\Requests\InvestorRequestRequest;
use Md\Repos\InvestorRequest\InvestorRequestRepo;
use Illuminate\Support\Facades\Session;

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

    public function bongoSendLink($request_id, InvestorRequestRepo $investorRequestRepo)
    {
        $request_link = $investorRequestRepo->sendLink($request_id);

        return view('request.investor.link', compact('request_link'));
    }

    public function bongoConfirmLink($request_link, InvestorRequestRepo $investorRequestRepo)
    {

        $confirm = $investorRequestRepo->confirm($request_link);


        if($confirm == null)
        {
            return view('errors.404');
        }
        else
        {
            \Auth::logout();
            return view('request.investor.register', compact('confirm'));
        }
    }

}
