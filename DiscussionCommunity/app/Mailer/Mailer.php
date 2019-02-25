<?php
/**
 * Created by PhpStorm.
 * User: 大太阳
 * Date: 2019/2/20
 * Time: 11:14
 */

namespace App\Mailer;


use Illuminate\Support\Facades\Mail;

class Mailer
{
    protected $url = 'http://api.sendcloud.net/apiv2/mail/sendtemplate';

    public function sendTo($user, $subject, $view, $data = [])
    {
        $vars = json_encode(['to' => [$user->email], 'sub' => $data]);
        $param = array(
            'apiUser' => env('SENDCLOUD_API_USER'),
            'apiKey' => env('SENDCLOUD_API_KEY'),
            'from' => config('mail')['from']['address'],
            'fromName' => config('mail')['from']['name'],
            'xsmtpapi' => $vars,
            'subject' => $subject,
            'templateInvokeName' => $view,
            'respEmailId' => 'true'
        );
        $sendData = http_build_query($param);
        $options = array(
            'http' => array(
            'method' => 'POST',
            'header' => 'Content-Type: application/x-www-form-urlencoded',
            'content' => $sendData
            ));
        $context = stream_context_create($options);
        return file_get_contents($this->url,FILE_TEXT, $context);
    }
}