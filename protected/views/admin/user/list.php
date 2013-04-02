<script type="text/javascript">
	$(document).ready(function(){
		$('#AdminUsersGridViewReload').on('click', function(){
			$.fn.yiiGridView.update('AdminUsersGridView');
			return false;
		});
	});
</script>

<div style="float:right;">
	<?= CHtml::link('Create New User <i class="icon-chevron-right icon-white"></i>',
			array('/admin/user/create'),
			array('target'=>'_blank', 'class'=>'btn btn-success')); ?>
</div>

<h1>
	Manage Users
	<?= CHtml::link(
			CHtml::image(Yii::app()->baseUrl . '/images/refresh.png', 'Reload table'),
			'#', array('id'=>'AdminUsersGridViewReload', 'title'=>'Reload table')
		); ?>
</h1>

<?
	$dataProvider = $userFilter->search();
	$dataProvider->pagination->pageSize = 50;
	
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'AdminUsersGridView',
		'dataProvider'=>$dataProvider,
		'filter'=>$userFilter,
		'selectableRows'=>0,
		'columns'=>array(
			array(
				'name'=>'Title',
				'filter'=>User::getTitleOptions(),
			),
			'FirstName',
			'LastName',
			'Email',
			array(
				'name'=>'RegistrationDate',
				'header'=>'Registered',
				'value'=>function($data){
					return date('d/m/Y', strtotime($data->RegistrationDate));
				},
			),
			array(
				'name'=>'Status',
				'filter'=>User::getStatusOptions(),
				'value'=>'$data->getStatusForDisplay()',
			),
			array(
				'name'=>'IsAdmin',
				'header'=>'Admin',
				'filter'=>User::getIsAdminOptions(),
				'value'=>'$data->getIsAdminForDisplay()',
			),
			array(
				'class'=>'CButtonColumn',
				'template'=>'{update}',
				'header'=>'<i class="icon-pencil icon-white"></i>',
				'htmlOptions'=>array('style'=>'width:auto;'),
				'headerHtmlOptions'=>array('style'=>'width:auto;'),
				'updateButtonLabel'=>'Edit',
				'updateButtonOptions'=>array('target'=>'_blank', 'class'=>'update-button'),
				'updateButtonUrl'=>function($data){
					return Yii::app()->createUrl('/admin/user/edit', array('id'=>$data->Id));
				},
			),
		),
	));
?>
