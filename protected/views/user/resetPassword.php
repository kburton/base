<? if ($flashMessage = Yii::app()->user->getFlash('user/reset_password:error')): ?>

	<? $flashMessage->render(); ?>

<? else: ?>

	<?= TbHtml::pageHeader('Reset Password', ''); ?>

	<div class="alert alert-info">
		<div class="glyphicon glyphicon-info-sign two-line"></div>
		<div class="alert-content">
			Please enter your new password into both fields below.<br />
			<?= CHtml::encode(Password::getPolicyMessage()); ?>
		</div>
	</div>

	<? $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'resetPasswordForm',
		'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
		'labelWidthClass'=>'col-sm-4',
		'controlWidthClass'=>'col-sm-5',
		'focus'=>'#resetPasswordForm input:password:empty:first, #resetPasswordForm input.error:first',
	)); ?>

	<?= $form->passwordFieldControlGroup($resetPasswordForm, 'password'); ?>

	<?= $form->passwordFieldControlGroup($resetPasswordForm, 'passwordRepeat'); ?>

	<?= $form->createFormActions(array(
		TbHtml::submitButton('Reset Password', array(
			'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
			'size'=>TbHtml::BUTTON_SIZE_LG,
		)),
	)); ?>

	<? $this->endWidget() ?>

<? endif; ?>
