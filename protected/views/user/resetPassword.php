<? if (!Yii::app()->user->hasFlash('error')): ?>

	<div class="page-header"><h1>Reset Password</h1></div>
		
	<? $form = $this->beginWidget('bw.TbActiveForm', array(
		'id'=>'resetPasswordForm',
		'type'=>'vertical',
		'focus'=>'#resetPasswordForm input:text[value=]:first,'
			   . '#resetPasswordForm input[class*=error]:first',
	)); ?>

	<div class="help-block">
		Please enter your new password into both fields below.
	</div>
	<div class="help-block">
		<? $this->widget('bw.TbBadge', array('type'=>'info', 'label'=>'Info')); ?>
		<?= CHtml::encode(Password::getPolicyMessage()) ?>
	</div>

	<?= $form->passwordFieldRow($resetPasswordForm, 'password'); ?>
	<?= $form->passwordFieldRow($resetPasswordForm, 'passwordRepeat'); ?>

	<div class="form-actions">
		<? $this->widget('bw.TbButton',	array('label'=>'Reset Password', 'buttonType'=>'submit', 'type'=>'primary')); ?>
	</div>

	<? $this->endWidget(); ?>

<? endif; ?>
