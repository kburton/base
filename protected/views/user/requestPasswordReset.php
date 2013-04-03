<? if (!Yii::app()->user->hasFlash('success')): ?>

	<div class="page-header"><h1>Request Password Reset</h1></div>

	<? $form = $this->beginWidget('bw.TbActiveForm', array(
		'id'=>'requestPasswordResetForm',
		'type'=>'vertical',
		'focus'=>'#requestPasswordResetForm input:text[value=]:first,'
			   . '#requestPasswordResetForm input[class*=error]:first',
	)); ?>

	<div class="help-block">
		Please complete the form below if you wish to reset your password.<br />
		You will receive an email with a link to the password reset page.
	</div>

	<?= $form->textFieldRow($requestPasswordResetForm, 'email'); ?>
	<?= $form->captchaRow($requestPasswordResetForm, 'captcha', array(
		'hint'=>Yii::t('captcha', 'hint'),
	)); ?>

	<div class="form-actions">
		<? $this->widget('bw.TbButton',	array('label'=>'Request Password Reset', 'buttonType'=>'submit', 'type'=>'primary')); ?>
	</div>

	<? $this->endWidget(); ?>

<? endif; ?>
