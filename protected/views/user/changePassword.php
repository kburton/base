<div class="page-header"><h1>Change Password</h1></div>

<? $form = $this->beginWidget('bw.TbActiveForm', array(
	'id'=>'changePasswordForm',
	'type'=>'vertical',
	'focus'=>'#changePasswordForm input:text[value=]:first,'
		   . '#changePasswordForm input[class*=error]:first',
)); ?>

<div class="help-block">
	Use the form below to update your account password.<br />
	You will need to enter your current password first as a security measure.
</div>
<div class="help-block">
	<? $this->widget('bw.TbBadge', array('type'=>'info', 'label'=>'Info')); ?>
	<?= CHtml::encode(Password::getPolicyMessage()); ?>
</div>

<?= $form->passwordFieldRow($changePasswordForm, 'oldPassword'); ?>
<?= $form->passwordFieldRow($changePasswordForm, 'newPassword'); ?>
<?= $form->passwordFieldRow($changePasswordForm, 'newPasswordRepeat'); ?>

<div class="form-actions">
	<? $this->widget('bw.TbButton',	array('label'=>'Change Password', 'buttonType'=>'submit', 'type'=>'primary')); ?>
</div>

<? $this->endWidget(); ?>
