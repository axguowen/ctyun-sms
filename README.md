# Ctyun SMS PHP SDK

PHP SDK包要求运行环境至少为PHP 7.2.5 版本(暂不支持PHP 8及以上版本)。


## 安装
~~~
composer require axguowen/ctyun-sms
~~~

## 简单使用
~~~php
use axguowen\ctyun\common\Auth;
use axguowen\ctyun\services\sms\SmsClient;
// 实例化授权类
$ctyunAuth = new Auth('AccessKey', 'SecurityKey');
$smsClient = new SmsClient($ctyunAuth);
// 发送短信
$smsClient->sendSms($phoneNumber, $signName, $templateCode, $templateParam);
~~~