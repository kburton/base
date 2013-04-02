<h1><?= $user->isNewRecord ? 'Create' : 'Edit'; ?> User</h1>

<div class="form">
	
	<? $form = $this->beginWidget('CActiveForm', array(
		'id'=>'editUser',
		'focus'=>'#editUser input[value=]:first,'
			   . '#editUser input[class*=error]:first',
	)); ?>
	
	<div class="row">
		<?= $form->labelEx($user, 'Title'); ?>
		<?= $form->error($user, 'Title'); ?>
		<?= $form->dropDownList($user, 'Title', User::getTitleOptions(),
				array('prompt'=>'Please select')); ?>
	</div>
	
	<div class="row">
		<?= $form->labelEx($user, 'FirstName'); ?>
		<?= $form->error($user, 'FirstName'); ?>
		<?= $form->textField($user, 'FirstName'); ?>
	</div>
	
	<div class="row">
		<?= $form->labelEx($user, 'LastName'); ?>
		<?= $form->error($user, 'LastName'); ?>
		<?= $form->textField($user, 'LastName'); ?>
	</div>
	
	<div class="row">
		<?= $form->labelEx($user, 'Email'); ?>
		<?= $form->error($user, 'Email'); ?>
		<?= $form->textField($user, 'Email', array('class'=>'wide')); ?>
	</div>
	
	<div class="row">
		<?= $form->labelEx($user, 'Status'); ?>
		<?= $form->error($user, 'Status'); ?>
		<?= $form->dropDownList($user, 'Status', User::getStatusOptions()); ?>
	</div>
	
	<div class="row">
		<?= $form->labelEx($user, 'IsAdmin'); ?>
		<?= $form->error($user, 'IsAdmin'); ?>
		<?= $form->dropDownList($user, 'IsAdmin', User::getIsAdminOptions()); ?>
	</div>
	
	<div class="row buttons">
		<?= CHtml::submitButton($user->isNewRecord ? 'Create User' : 'Save Changes',
				array('class'=>'btn btn-primary')); ?>
	</div>
	
	<? $this->endWidget(); ?>
	
</div><!-- form -->
