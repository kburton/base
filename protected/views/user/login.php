<h1>Log In</h1>

<div class="form">

	<? $form = $this->beginWidget('CActiveForm', array(
		'id'=>'loginForm',
		'action'=>array('/user/login'),
		'focus'=>'#loginForm input:text[value=]:first,'
			   . '#loginForm input[class=error]:first',
	)); ?>

	<div class="row">
		<?= $form->labelEx($loginForm, 'email'); ?>
		<?= $form->error($loginForm, 'email'); ?>
		<?= $form->textField($loginForm, 'email'); ?>
	</div>

	<div class="row">
		<?= $form->labelEx($loginForm, 'password'); ?>
		<div class="hint" style="width:35em;"><?= CHtml::encode(Password::getPolicyMessage()); ?></div>
		<?= $form->error($loginForm, 'password'); ?>
		<?= $form->passwordField($loginForm, 'password'); ?>
		<?= CHtml::link('Forgotten password?', array('/user/request_password_reset')); ?>
	</div>

	<div class="row rememberMe">
		<?= $form->checkBox($loginForm, 'rememberMe'); ?>
		<?= $form->labelEx($loginForm, 'rememberMe'); ?>
		<?= $form->error($loginForm, 'rememberMe'); ?>
	</div>

	<div class="row buttons">
		<?= CHtml::submitButton('Log In', array('class'=>'btn btn-primary')); ?>
	</div>

	<? $this->endWidget() ?>
	
</div><!-- form -->

