<div class="page-header"><h1>Log In</h1></div>

<? $form = $this->beginWidget('bw.TbActiveForm', array(
	'id'=>'loginForm',
	'action'=>array('/user/login'),
	'type'=>'vertical',
	'focus'=>'#loginForm input:text[value=]:first,'
		   . '#loginForm input[class*=error]:first',
)); ?>

<?= $form->textFieldRow($loginForm, 'email'); ?>

<?= $form->passwordFieldRow($loginForm, 'password', array(
	'hint'=>CHtml::link('Forgotten password?', array('/user/request_password_reset')),
	'hintOptions'=>array('class'=>'help-inline'),
)); ?>

<div class="help-block">
	<? $this->widget('bw.TbBadge', array('type'=>'info', 'label'=>'Info')); ?>
	<?= CHtml::encode(Password::getPolicyMessage()) ?>
</div>

<?= $form->checkBoxRow($loginForm, 'rememberMe'); ?>

<div class="form-actions">
	<? $this->widget('bw.TbButton',	array('label'=>'Log In', 'buttonType'=>'submit', 'type'=>'primary')); ?>
</div>

<? $this->endWidget(); ?>
	

