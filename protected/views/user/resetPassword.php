<? if ($flashMessage = Yii::app()->user->getFlash('user/reset_password:error')): ?>

	<? $flashMessage->render(); ?>

<? else: ?>

	<h1>Reset Password</h1>

	<p>Please enter your new password into both fields below.</p>

	<div class="form">

		<? $form = $this->beginWidget('CActiveForm', array(
			'id'=>'resetPasswordForm',
			'focus'=>'#resetPasswordForm input:text[value=]:first,'
				   . '#resetPasswordForm input[class=error]:first',
		)); ?>

		<div class="row">
			<?= $form->labelEx($resetPasswordForm, 'password'); ?>
			<div class="hint" style="width:35em;"><?= CHtml::encode(Password::getPolicyMessage()); ?></div>
			<?= $form->error($resetPasswordForm, 'password'); ?>
			<?= $form->passwordField($resetPasswordForm, 'password'); ?>
		</div>

		<div class="row">
			<?= $form->labelEx($resetPasswordForm, 'passwordRepeat'); ?>
			<?= $form->error($resetPasswordForm, 'passwordRepeat'); ?>
			<?= $form->passwordField($resetPasswordForm, 'passwordRepeat'); ?>
		</div>

		<div class="row buttons">
			<?= CHtml::submitButton('Reset Password', array('class'=>'btn btn-primary')); ?>
		</div>

		<? $this->endWidget() ?>

	</div><!-- form -->

<? endif; ?>
