<?= TbHtml::pageHeader(($user->isNewRecord ? 'Create' : 'Edit') . ' User', CHtml::encode($user->fullName)); ?>

<? $form = $this->beginWidget('TbActiveForm', array(
	'id'=>'editUser',
	'layout'=>TbHtml::FORM_LAYOUT_HORIZONTAL,
	'labelWidthClass'=>'col-sm-2',
	'controlWidthClass'=>'col-sm-5',
	'focus'=>'#editUser input:text:empty:first, #editUser input.error:first',
)); ?>

<?= $form->dropDownListControlGroup($user, 'Title', User::getTitleOptions(),
		array('prompt'=>'Please select...')); ?>

<?= $form->textFieldControlGroup($user, 'FirstName'); ?>

<?= $form->textFieldControlGroup($user, 'LastName'); ?>

<?= $form->emailFieldControlGroup($user, 'Email'); ?>

<?= $form->dropDownListControlGroup($user, 'Status', User::getStatusOptions()); ?>

<?= $form->dropDownListControlGroup($user, 'IsAdmin', User::getIsAdminOptions()); ?>

<?= $form->createFormActions(array(
	TbHtml::submitButton($user->isNewRecord ? 'Create User' : 'Save Changes', array(
		'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
		'size'=>TbHtml::BUTTON_SIZE_LG,
	)),
)); ?>

<? $this->endWidget(); ?>
