<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail;

class InquiryForwarder extends Controller
{
    public static function inquiryForwarder(Request $request) {
        return InquiryForwarder::sendEmail($request);
    }

    public static function sendEmail($request) {

        $name       = $request['name'];
        $subject    = $request['subject'];
        $email      = $request['email'];
        $message    = $request['message'];

        $forwardTo  = "jason.foxcityph@gmail.com";

        try {
            $subject    = 'Web Inquiry';
            $content    = '<div style="font-family: sans-serif; width: 100%;height: 100%;background: #e8eff1;position: absolute;">
                            <div style="display: block;margin: 40px auto 0px auto; max-width: 500px;min-height: 300px;background-color: white;position: relative;border-bottom: 10px solid #243a2d;">
                                <img style="display: block;margin: 0 auto;width: 160px;" src="https://api-fileserver.jlipreso.com/exploria/assets/img/et-about-banner.png"/>
                                <div style="padding: 0px 24px 24px 24px;font-size: 13px;line-height: 1.7;">
                                    <h3 style="text-align: center;">Website Inquiry</h3>
                                    <p><strong>Dear Admin</strong></p>
                                    <p>New inquiry was received from website web form with the following details:</p>
                                    <p>
                                        <strong>Name: </strong>'. $name .'<br/>
                                        <strong>Subject: </strong>'. $subject .'<br/>
                                        <strong>Email: </strong>'. $email .'<br/>
                                        <strong>Message: </strong>'. $message .'
                                    </p>
                                    <br/>
                                    <p>Thank you for choosing Exploria Travel and DMC.<br/>We look forward to serving you!</p>
                                    <p>Warm regards,<br>Exploria Travel Team</p>
                                </div>
                            </div>
                        </div>';
            Mail::html($content, function ($message) use ($subject) {
                $message->to(["jasonlipreso@gmail.com", "operations@exploriatravel.com"])->subject($subject);
            });
            return [
                "success"   => true,
                "message"   => "Message sent"
            ];
        }
        catch(\Exception $e) {
            return [
                "success"   => false,
                "message"   => $e->getMessage()
            ]; 
        }
        
    }
}
