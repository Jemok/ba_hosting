<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/13/15
 * Time: 9:16 AM
 */

namespace Md\Repos\BongoRequest;

use Md\Bongo_request;
use Carbon\Carbon;

class BongoRequestRepo {

    public function persist($request)
    {
        Bongo_request::create([

            'bongo_email' => $request->bongo_email,
            'first_name'  => $request->first_name,
            'last_name'   => $request->last_name,
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
            $request = Bongo_request::where('request_link', '=', $request_link)
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

    public function getThem()
    {
        return Bongo_request::where('request_status', '=', 0)->get();
    }

} 