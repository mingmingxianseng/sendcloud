<?php
/**
 * Created by PhpStorm.
 * User: chenmingming
 * Date: 2017/4/7
 * Time: 18:03
 */

namespace tests;

use PHPUnit\Framework\TestCase;
use sendcloud\Mail;
use sendcloud\Sendcloud;

class testMail extends TestCase
{
    public function testMail()
    {
        $mail = new Mail();
        $mail
            ->setFrom('zbl@139.com')
            ->addTo('13916963863@139.com')
            ->addCc('wangjian@axhome.com.cn')
            ->addBcc('chenmingming@axhome.com.cn')
            ->setHtml('<p>您的验证码是:123456</p>')
            ->setSubject('test');

        $sendCloud = new Sendcloud(['api_user' => 'chenmingming', 'api_key' => 'EyhpbrVbBCyxNtlk']);
        $sendCloud->send($mail);
    }
}