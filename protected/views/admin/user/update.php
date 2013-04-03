<div class="page-header">
	<h1><?= $user->isNewRecord ? 'Create' : 'Update'; ?> User</h1>
</div>

<? $form = $this->beginWidget('bw.TbActiveForm', array(
	'id'=>'updateUser',
	'type'=>'horizontal',
	'focus'=>'#updateUser input:text[value=]:first,'
		   . '#updateUser input[class*=error]:first',
)); ?>

<?= $form->dropDownListRow($user, 'Title', User::getTitleOptions(), array('prompt'=>'Please select')); ?>
<?= $form->textFieldRow($user, 'FirstName'); ?>
<?= $form->textFieldRow($user, 'LastName'); ?>
<?= $form->textFieldRow($user, 'Email'); ?>
<?= $form->dropDownListRow($user, 'Status', User::getStatusOptions()); ?>
<?= $form->dropDownListRow($user, 'IsAdmin', User::getIsAdminOptions()); ?>

<div class="form-actions">
	<? $this->widget('bw.TbButton',	array(
		'label'=>$user->isNewRecord ? 'Create User' : 'Save Changes',
		'buttonType'=>'submit', 'type'=>'primary')); ?>
</div>

<? $this->endWidget(); ?>
