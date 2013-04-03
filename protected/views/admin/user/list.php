<script type="text/javascript">
	$(document).ready(function(){
		$('#adminUsersGridViewReload').on('click', function(){
			$.fn.yiiGridView.update('adminUsersGridView');
			return false;
		});
	});
</script>

<div style="float:right;">
	<? $this->widget('bw.TbButton', array(
		'label'=>'Refresh Table', 'icon'=>'refresh',
		'htmlOptions'=>array('id'=>'adminUsersGridViewReload'),
	)); ?>
</div>

<div class="page-header"><h1>Manage Users</h1></div>

<?
	$dataProvider = $userFilter->search();
	$dataProvider->pagination->pageSize = 50;
	
	$this->widget('bw.TbGridView', array(
		'id'=>'adminUsersGridView',
		'dataProvider'=>$dataProvider,
		'type'=>'striped condensed',
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
				'class'=>'bw.TbButtonColumn',
				'template'=>'{update}',
				'updateButtonOptions'=>array('target'=>'_blank'),
			),
		),
	));
?>
