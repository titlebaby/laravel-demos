<?php

namespace App\Http\Controllers\EmailDemo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class TestEmailController extends Controller
{
    public function send()
    {
//        Mail::raw('这是一封测试邮件', function ($message) {
//            $to = '2337647782@qq.com';
//            $message ->to($to)->subject('测试邮件');
//        });
        $name = '王宝花';
        // Mail::send()的返回值为空，所以可以其他方法进行判断
        Mail::send('emails.sendmail',['param'=>$name],function($message){
            $to = '2337647782@qq.com';
            $message ->to($to)->subject('邮件测试');
        });
        // 返回的一个错误数组，利用此可以判断是否发送成功
        dd(Mail::failures());
    }

    public function smail_markdown(){
        dd('123');

    }

}
