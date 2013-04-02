<h1>My Account</h1>

<p>
	Please use the links below to manage your account.
</p>

<p>
	<?= CHtml::link('Change Password', array('/user/change_password'), array(
			'class'=>'btn btn-inverse btn-large',
			'title'=>'Change your account password')); ?>
</p>
