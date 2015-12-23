<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/12/15
 * Time: 2:01 PM
 */

namespace Md\Repos\Profile;
use Md\User;


class ProfileRepository {

    public function load($innovator_id)
    {
        if(User::where('id', '=', $innovator_id )->first() == null)
        {
            return null;
        }
        else
        {
            return User::where('id', '=', $innovator_id )->first();
        }
    }

    public function setInvestorFinance($request)
    {
        \Auth::user()->update([

            'investor_finance' => 1,
            'investor_amount' => $request->financial_amount

        ]);
    }

    public function updateProfile($profile_id, $request)
    {
        $user = User::findOrFail($profile_id);

        $user->update([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'more_details' => $request->more_details
        ]);
    }

} 