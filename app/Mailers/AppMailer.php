<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/15/15
 * Time: 9:14 AM
 */

namespace Md\Mailers;



use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Session\Session;

class AppMailer {

    protected $mailer;

    protected $from = 'karokijames40@gmail.com';

    protected $to;

    protected $view;

    protected $subject;

    protected $data = [];

     protected static $from_reset = 'karokijames40@gmail.com';

    protected static  $to_reset;

    protected static  $view_reset;

    protected static  $subject_reset;

    protected static $data_reset = [];

    public function sendConfirmEmailLink()
    {

    }

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

    public static function  sendEmailResetLink($user_email, $token)
    {
        AppMailer::$to_reset = $user_email;

        AppMailer::$view_reset = "emails.password";

        AppMailer::$data_reset = compact('token');

        AppMailer::$subject_reset = "Bongo Afrika Reset Your Password";

        AppMailer::deliverReset();
    }

    public function deliver()
    {
        Mail::send($this->view, $this->data, function($message){

            $message->from($this->from, 'Bongo Afrika Admin')
                ->to($this->to)
                ->subject($this->subject);
        });
    }

    public static function deliverReset()
    {
        Mail::send(AppMailer::$view_reset, AppMailer::$data_reset, function($message){

            $message->from(AppMailer::$from_reset, 'Bongo Afrika Admin')
                ->to(AppMailer::$to_reset)
                ->subject(AppMailer::$subject_reset);
        });
    }





} 