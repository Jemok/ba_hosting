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

    protected $subject;

    protected $data = [];

    public function sendInvestorRegLinkEmail($investor_link, $investor_email)
    {
        $this->to = $investor_email;

        $this->view = "emails.email_link_investor";

        $this->data = compact('investor_link');

        $this->subject = "Bongo Afrika Investor Account Registration";

        $this->deliver();
    }

    public function sendExpertRegLinkEmail($expert_link, $expert_email)
    {
        $this->to = $expert_email;

        $this->view = "emails.email_link_expert";

        $this->data = compact('expert_link');

        $this->subject = "Bongo Afrika Expert Account Registration";

        $this->deliver();
    }

    public function deliver()
    {
        Mail::send($this->view, $this->data, function($message){

            $message->from($this->from, 'Bongo Afrika Admin')
                ->to($this->to)
                ->subject($this->subject);
        });
    }



} 