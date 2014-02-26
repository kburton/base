<?= TbHtml::pageHeader('My Account', ''); ?>

<div class="alert alert-info">
	<span class="glyphicon glyphicon-info-sign"></span>&nbsp;&nbsp;
	Please use the buttons below to manage your account.
</div>

<div class="row">
	<div class="col col-sm-4">
		<p><?= CHtml::link('Change Password', array('/user/change_password'), array(
				'class'=>'btn btn-default btn-lg btn-block',
				'title'=>'Change your account password')); ?></p>
	</div>
</div>
