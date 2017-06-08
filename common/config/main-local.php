<?php
use kartik\mpdf\Pdf;
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=meilinyuan',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'tablePrefix' => 'mly_',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            //这句一定有，false发送邮件，true只是生成邮件在runtime文件夹下，不发邮件
            'transport' => [
               'class' => 'Swift_SmtpTransport',
               'host' => 'smtp.163.com',
               //每种邮箱的host配置不一样
               'username' => 'tmov@163.com',
               'password' => '*******',
               'port' => '25',
               'encryption' => 'tls',
           ],
          'messageConfig'=>[
               'charset'=>'UTF-8',
               'from'=>['15618380091@163.com'=>'admin']
           ],
        ],
    ],
];