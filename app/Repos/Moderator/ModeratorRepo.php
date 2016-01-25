<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 1/24/16
 * Time: 12:36 PM
 */

namespace Md\Repos\Moderator;
use Md\User;

use Md\Mailers\AppMailer;

class ModeratorRepo {

    protected $mailer;

    public function __construct(AppMailer $appMailer)
    {
        $this->mailer = $appMailer;

    }

    public function store($request)
    {
        $user = User::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'userCategory' => 5,
            'hash_id'     => str_random(100),
            'verified'  => 1
        ]);

        $user->prof_pic()->create([]);

        //$this->mailer ->sendConfirmEmailLink($user);

        return $user;
    }
} 