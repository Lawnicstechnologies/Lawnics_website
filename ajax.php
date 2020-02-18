<?php
	require 'mailgun-php-master/vendor/autoload.php';
	use Mailgun\Mailgun;
	error_reporting(E_ALL);
	
	extract($_POST);
	if(!isset($action) || (isset($action) && $action == '')){
		die;
	}

	$final_result = array();
	if($action == 'subscribe_now'){
		$final_result['msg'] = 'err';
		$semail = isset($semail) ? $semail : '';
		if($semail != 'subscribe_now'){
			$mg = Mailgun::create('key-ee6e982867d250fb12561662eb27b327');
			# Now, compose and send your message.
			# $mg->messages()->send($domain, $params);
			$mg->messages()->send('mail.lawnics.com', [
			  'from'    => 'hello@lawnics.com',
			  'to'      => $semail,//$semail
			  'subject' => 'Subscribed Successfully - Lawnics',
			  'text'    => 'Hello Greetings, Thank you for subscribing your email address with us.'
			]);

			$final_result['msg'] = 'suc';
			$final_result['message'] = 'You have subscribed successfully.';
		}
		else{
			$final_result['msg'] = 'err';
			$final_result['message'] = 'Please enter email address.';
		}
	}
	echo json_encode($final_result);
	exit;

?>