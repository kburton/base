<? if ($flashMessage = Yii::app()->user->getFlash('user/request_password_reset:success')): ?>

	<? $flashMessage->render(); ?>

<? else: ?>

	<?= TbHtml::pageHeader('Request Password Reset', ''); ?>

	<div class="alert alert-info">
		<div class="glyphicon glyphicon-info-sign two-line"></div>
		<div class="alert-content">
			Please complete the form below if you wish to reset your password.<br />
			You will receive an email with a link to the password reset page.
		</div>
	</div>

	<? $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'requestPasswordResetForm',
		'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
		'labelWidthClass'=>'col-sm-3',
		'controlWidthClass'=>'col-sm-5',
		'focus'=>'#requestPasswordResetForm input:text:empty:first, #requestPasswordResetForm input.error:first',
	)); ?>

	<?= $form->textFieldControlGroup($requestPasswordResetForm, 'email'); ?>

	<div class="<?= $requestPasswordResetForm->hasErrors('captcha') ? 'has-error' : '' ?>">
		<?= $form->createCustomGroup($form->labelEx($requestPasswordResetForm, 'captcha'),
				'<div>' . $this->widget('CCaptcha', array(), true) . '<br />'
						. $form->textField($requestPasswordResetForm, 'captcha')
						. $form->error($requestPasswordResetForm, 'captcha') . '</div>',
				array(
					'help'=>'<span class="label label-info">Hint</span> ' . Yii::t('captcha', 'hint'),
				)); ?>
	</div>

	<?= $form->createFormActions(array(
		TbHtml::submitButton('Request Password Reset', array(
			'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
			'size'=>TbHtml::BUTTON_SIZE_LG,
		)),
	)); ?>

	<? $this->endWidget() ?>

<? endif; ?>
