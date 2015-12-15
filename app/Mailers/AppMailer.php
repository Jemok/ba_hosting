<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/15/15
 * Time: 9:14 AM
 */

namespace Md\Mailers;



use Illuminate\Support\Facades\Mail;

class AppMailer {

    protected $mailer;

    protected $from = 'karokijames40@gmail.com';

    protected $to;

    protected $view;

    protected $data = [];



    public function sendActivationLinkEmail($investor_link, $investor_email)
    {
        $this->to = $investor_email;

        $this->view = "emails.email_link";

        $this->data = compact('investor_link');

        $this->deliver();
    }

    public function deliver()
    {
        Mail::send($this->view, $this->data, function($message){

            $message->from($this->from, 'Bongo Afrika Admin')
                    ->to($this->to);
        });
    }



} 