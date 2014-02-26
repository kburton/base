<script type="text/javascript">
	$(document).ready(function(){
		$('#adminUsersGridViewReload').on('click', function(){
			$.fn.yiiGridView.update('adminUsersGridView');
			return false;
		});
	});
</script>

<div class="page-header">
	<div class="row">
		<div class="col-sm-6">
			<h1>Manage Users</h1>
		</div>
		<div class="col-sm-6 text-right">
			<div class="header-controls">
				<?= CHtml::link('<span class="glyphicon glyphicon-refresh"></span>', '#', array(
					'id'=>'adminUsersGridViewReload',
					'class'=>'btn btn-info',
					'title'=>'Refresh table using current filters',
				)); ?>
				<?= CHtml::link('<span class="glyphicon glyphicon-user"></span> Create New User <span class="glyphicon glyphicon-chevron-right"></span>',
						array('/admin/user/create'),
						array('target'=>'_blank', 'class'=>'btn btn-success')); ?>
			</div>
		</div>
	</div>
</div>

<?
	$dataProvider = $userFilter->search();
	$dataProvider->pagination->pageSize = 50;
	
	$this->widget('TbGridView', array(
		'id'=>'adminUsersGridView',
		'type'=>TbHtml::GRID_TYPE_HOVER,
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
				'class'=>'TbButtonColumn',
				'template'=>'{update}',
				'updateButtonLabel'=>'Edit',
				'updateButtonOptions'=>array('target'=>'_blank'),
				'updateButtonUrl'=>function($data){
					return Yii::app()->createUrl('/admin/user/edit', array('id'=>$data->Id));
				},
			),
		),
	));
?>
