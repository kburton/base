<div class="page-header"><h1>My Details</h1></div>

<? $this->widget('bw.TbDetailView', array(
	'data'=>$user,
	'attributes'=>array(
		'fullName',
		'Email',
		array(
			'name'=>'RegistrationDate',
			'label'=>'Registered',
			'value'=>date('jS F Y', strtotime($user->RegistrationDate)),
		),
		array(
			'name'=>'LastSuccessfulLogin',
			'label'=>'Last Login',
			'value'=>date('jS F Y \a\t H:i', strtotime($user->LastSuccessfulLogin)),
		),
	),
)); ?>