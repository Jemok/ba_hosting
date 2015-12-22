<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/13/15
 * Time: 9:16 AM
 */

namespace Md\Repos\BongoRequest;

use Md\Bongo_request;


class BongoRequestRepo {

    public function persist($request)
    {
        Bongo_request::create([

            'bongo_email' => $request->bongo_email,
            'company'     => $request->company,
            'job_title'   => $request->job_title,
            'field'       => $request->field,
            'request_link' => $this->makeRequestLink($request->bongo_email)
        ]);
    }

    private function makeRequestLInk($bongo_email)
    {
        $link = $bongo_email.'abcdefghijklmnopqrstuvwxyz';

        return md5($link);
    }

    public function all()
    {
        return  Bongo_request::all();
    }

    public function sendLink($request_id)
    {
        $request = Bongo_request::findOrFail($request_id);

        $request->update([

            'request_status' => 1

        ]);

        return $request;
    }

    public function confirm($request_link)
    {

        if(Bongo_request::where('request_link', '=', $request_link)->first() == null)
        {
            return 0;
        }
        elseif(Bongo_request::where('request_link', '=', $request_link)->first()->request_status != 1)
        {
            return 0;
        }
        else
        {
            Bongo_request::where('request_link', '=', $request_link)
                ->first()
                ->update([

                    'request_status' => 2
                ]);

            if($request = Bongo_request::where('request_link', '=', $request_link)->first()){

                if(\Md\User::where('email', '=', $request->bongo_email)->first() !=null )
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


    public function getBongoRequest($request_link)
    {

        return Bongo_request::where('request_link', '=', $request_link)->first();
    }

    public function getEmail($request_link)
    {

        return Bongo_request::where('request_link', '=', $request_link)->first()->bongo_email;
    }

} 