<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/11/15
 * Time: 9:58 AM
 */

namespace Md\Repos\InvestorRequest;

use Md\Investor_request;

class InvestorRequestRepo {


    public function persist($request)
    {
      Investor_request::create([

          'investor_email' => $request->investor_email,
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

        return $request->request_link;
    }

    public function confirm($request_link)
    {

        if(Investor_request::where('request_link', '=', $request_link)->first() == null)
        {
            return null;
        }
        else
        {
            return Investor_request::where('request_link', '=', $request_link)->first();

        }
    }

} 