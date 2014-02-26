<?= TbHtml::pageHeader('Log In', ''); ?>

<? $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'loginForm',
	'action'=>array('/user/login'),
	'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
	'labelWidthClass'=>'col-sm-2',
	'controlWidthClass'=>'col-sm-5',
	'focus'=>'#loginForm input:text:empty:first, #loginForm input.error:first',
)); ?>

<?= $form->textFieldControlGroup($loginForm, 'email'); ?>

<?= $form->passwordFieldControlGroup($loginForm, 'password', array(
	'help'=>'<span class="label label-info">Hint</span> ' . CHtml::encode(Password::getPolicyMessage()),
)); ?>

<?= $form->createFormActions(array(
	TbHtml::submitButton('Log In', array(
		'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		'size'=>TbHtml::BUTTON_SIZE_LG,
	)),
	'&nbsp;&nbsp;<div class="checkbox checkbox-inline">'
		. $form->checkBox($loginForm, 'rememberMe') . ' '
		. $form->label($loginForm, 'rememberMe')
		. '</div>',
)); ?>

<?= $form->createStaticGroup(false,
		CHtml::link('Forgotten password?', array('/user/request_password_reset'))); ?>

<? $this->endWidget() ?>
