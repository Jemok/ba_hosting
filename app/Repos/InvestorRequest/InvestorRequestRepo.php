<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/11/15
 * Time: 9:58 AM
 */

namespace Md\Repos\InvestorRequest;

use Md\Investor_request;

use Carbon\Carbon;

class InvestorRequestRepo {


    public function persist($request)
    {
        Investor_request::create([

            'investor_email' => $request->investor_email,
            'first_name'   => $request->first_name,
            'last_name'    => $request->last_name,
            'company'      => $request->company,
            'job_title'    => $request->job_title,
            'request_link' => $this->makeRequestLink($request->investor_email)
        ]);
    }

    private function makeRequestLInk($investor_email)
    {
        $link = $investor_email.'abcdefghijklmnopqrstuvwxyz';
        return md5($link);
    }

    public function all()
    {
        return Investor_request::all();
    }

    public function sendLink($request_id)
    {
        $request = Investor_request::findOrFail($request_id);

        $request->update([

            'request_status' => 1

        ]);

        return $request;
    }

    public function confirm($request_link)
    {

        if(Investor_request::where('request_link', '=', $request_link)->first() == null)
        {
            return 0;
        }
        elseif(Investor_request::where('request_link', '=', $request_link)->first()->request_status != 1)
        {
            return 0;
        }
        else
        {
            $request = Investor_request::where('request_link', '=', $request_link)
                ->first();


            $created = new Carbon($request->created_at);
            $now = Carbon::now();
            $difference = ($created->diff($now)->days > 7)
                ? $request->update([

                    'request_status' => 2
                ])
                :$request->update([

                    'request_status' => 1
                ]) ;


            if($request = Investor_request::where('request_link', '=', $request_link)->first()){

                if(\Md\User::where('email', '=', $request->investor_email)->first() !=null )
                {
                    return 1;
                }
                else
                {
                    return 2;
                }


            }

        }
    }


    public function getInvestorRequest($request_link)
    {

        return Investor_request::where('request_link', '=', $request_link)->first();
    }

    public function getEmail($request_link)
    {

        return Investor_request::where('request_link', '=', $request_link)->first()->investor_email;
    }

} 