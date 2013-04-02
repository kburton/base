<?php

// Disable error reports caused when no connection
error_reporting(0);

class KSMail extends CComponent
{
	public static function sendPasswordResetEmail($user, $verificationCode)
	{
		$message = new YiiMailMessage;
		$message->view = 'requestPasswordReset';
		$message->setBody(array('user'=>$user, 'verificationCode'=>$verificationCode), 'text/html');
		$message->subject = Yii::app()->params['companyName'] . ' Password Reset';
		$message->addTo($user->Email);
		$message->setFrom(Yii::app()->params['mail']['accounts']['system']['address'],
						  Yii::app()->params['mail']['accounts']['system']['name']);
		return Yii::app()->mail->send($message);
	}
	
}
