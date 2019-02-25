<?php
/**
 * Created by PhpStorm.
 * User: 大太阳
 * Date: 2019/2/20
 * Time: 11:17
 */

namespace App\Mailer;


class UserMailer extends Mailer
{
    public function welcome($user){
        $subject = '社区邮箱确认';
        $view = 'welcome';
        $data = [ '%name%' => [$user->name], '%confirm_code%' => [$user->confirm_code]];
        $this->sendTo($user, $subject, $view, $data);
    }

}