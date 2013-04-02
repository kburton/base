<h1>Change Password</h1>

<p class="note">
	Use the form below to update your account password.<br />
	You will need to enter your current password first as a security measure.
</p>

<div class="form">

	<p class="hint"><?= CHtml::encode(Password::getPolicyMessage()); ?></p>
	
	<? $form = $this->beginWidget('CActiveForm', array(
		'id'=>'changePasswordForm',
		'focus'=>'#changePasswordForm input:text[value=]:first,'
				. '#changePasswordForm input[class=error]:first',
	)); ?>

	<div class="row">
		<?= $form->labelEx($changePasswordForm, 'oldPassword'); ?>
		<?= $form->error($changePasswordForm, 'oldPassword'); ?>
		<?= $form->passwordField($changePasswordForm, 'oldPassword'); ?>
	</div>

	<div class="row">
		<?= $form->labelEx($changePasswordForm, 'newPassword'); ?>
		<?= $form->error($changePasswordForm, 'newPassword'); ?>
		<?= $form->passwordField($changePasswordForm, 'newPassword'); ?>
	</div>

	<div class="row">
		<?= $form->labelEx($changePasswordForm, 'newPasswordRepeat'); ?>
		<?= $form->error($changePasswordForm, 'newPasswordRepeat'); ?>
		<?= $form->passwordField($changePasswordForm, 'newPasswordRepeat'); ?>
	</div>

	<div class="row buttons">
		<?= CHtml::submitButton('Change Password', array('class'=>'btn btn-primary')); ?>
	</div>

	<? $this->endWidget() ?>

</div>
