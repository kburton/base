<?= TbHtml::pageHeader('Admin', ''); ?>

<div class="alert alert-info">
	<span class="glyphicon glyphicon-info-sign"></span>&nbsp;&nbsp;
	Welcome to the admin section. Please use the links below to manage the site.
</div>

<div class="row">
	<div class="col col-sm-4">
		<p><?= CHtml::link('<span class="glyphicon glyphicon-user"></span> Manage Users', array('/admin/user'), array(
				'class'=>'btn btn-default btn-lg btn-block',
				'title'=>'Create, update and delete user accounts.')); ?></p>
	</div>
</div>
