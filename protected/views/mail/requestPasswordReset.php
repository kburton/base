<?
$resetUrl = $this->createAbsoluteUrl('/user/reset_password',
		array('userid'=>$user->Id, 'verifid'=>$verificationCode->Id, 'verifcode'=>$verificationCode->VerificationCode));
?>

<p>
	We have received a request to reset your <?= Yii::app()->params['companyName']; ?> account password.
</p>
<p>
	If you have not requested a password reset, you may safely ignore this message.
	Otherwise, please click the link below or paste it into your browser's address bar to access the password reset page:
</p>

<p>
	<?= CHtml::link($resetUrl, $resetUrl); ?>
</p>

