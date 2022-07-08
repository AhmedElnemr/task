<?php

namespace App\Http\Traits;

trait SendEmail
{
    public function send_email($to_email_address , $from_email , $subject,$view , $other_data)
    {
        $data = [
            'to_email_address'=>$to_email_address,
            'from_email'=>$from_email,
            'subject'=>$subject,
            'token'=>$other_data,
        ];
       // $view = "hr::employees.emails.auth-email";
        $headers = "";
        \Mail::send($view, ['data' => $data],
            function ($message) use (&$headers, $to_email_address , $from_email , $subject ) {
                $message->to($to_email_address)
                    ->from($from_email)
                    ->subject($subject);
                $headers = $message->getHeaders();
            });
    }//end fun


}//end class
