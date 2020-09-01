<?php
require_once __DIR__ . '/vendor/autoload.php';

use mfunc\Sms;

try {
	$config = [
		'host'	=>	'https://api.mix2.zthysms.com/v2/sendSms',
		'user'	=>	'xxxx',
		'pass'	=>	'xxxx',
	];
	$sms = new Sms($config);
	$res = $sms->send('xxxxxx', '123456哈哈哈哈');
	var_dump($res);
} catch (\Exception $e) {
	echo $e->getMessage();
}