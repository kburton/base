<?= TbHtml::pageHeader('Change Password', ''); ?>

<div class="alert alert-info">
	<div class="glyphicon glyphicon-info-sign two-line"></div>
	<div class="alert-content">
		Use the form below to update your account password.<br />
		You will need to enter your current password first as a security measure.<br />
	</div>
</div>

<? $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'changePasswordForm',
	'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
	'labelWidthClass'=>'col-sm-4',
	'controlWidthClass'=>'col-sm-5',
	'focus'=>'#changePasswordForm input:password:empty:first, #changePasswordForm input.error:first',
)); ?>

<?= $form->passwordFieldControlGroup($changePasswordForm, 'oldPassword', array(
	'help'=>'<span class="label label-info">Hint</span> ' . CHtml::encode(Password::getPolicyMessage()),
)); ?>

<?= $form->passwordFieldControlGroup($changePasswordForm, 'newPassword'); ?>

<?= $form->passwordFieldControlGroup($changePasswordForm, 'newPasswordRepeat'); ?>

<?= $form->createFormActions(array(
	TbHtml::submitButton('Change Password', array(
		'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		'size'=>TbHtml::BUTTON_SIZE_LG,
	)),
)); ?>

<? $this->endWidget() ?>
