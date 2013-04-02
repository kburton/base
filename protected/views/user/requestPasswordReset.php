<? if ($flashMessage = Yii::app()->user->getFlash('user/request_password_reset:success')): ?>

	<? $flashMessage->render(); ?>

<? else: ?>

	<h1>Request Password Reset</h1>

	<p>
		Please complete the form below if you wish to reset your password.<br />
		You will receive an email with a link to the password reset page.
	</p>

	<div class="form">

		<? $form = $this->beginWidget('CActiveForm', array(
			'id'=>'requestPasswordResetForm',
			'focus'=>'#requestPasswordResetForm input:text[value=]:first,'
				   . '#requestPasswordResetForm input[class=error]:first',
		)); ?>

		<div class="row">
			<?= $form->labelEx($requestPasswordResetForm, 'email'); ?>
			<?= $form->error($requestPasswordResetForm, 'email'); ?>
			<?= $form->textField($requestPasswordResetForm, 'email'); ?>
		</div>

		<div class="row captcha">
			<?= $form->labelEx($requestPasswordResetForm, 'captcha'); ?>
			<div>
				<? $this->widget('CCaptcha'); ?><br />
				<?= $form->error($requestPasswordResetForm, 'captcha'); ?>
				<?= $form->textField($requestPasswordResetForm, 'captcha'); ?>
			</div>
			<div class="hint"><?= Yii::t('captcha', 'hint'); ?></div>
		</div>

		<div class="row buttons">
			<?= CHtml::submitButton('Request Password Reset', array('class'=>'btn btn-primary')); ?>
		</div>

		<? $this->endWidget() ?>

	</div><!-- form -->

<? endif; ?>
