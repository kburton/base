<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<link rel="shortcut icon" href="<?= Yii::app()->baseUrl; ?>/images/favicon.ico" />
	
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<?php Yii::app()->bootstrap->register(); ?>
</head>

<body>

<?php $this->widget('bootstrap.widgets.TbNavbar',array(
	'items'=>array(
		array(
			'class'=>'bootstrap.widgets.TbMenu',
			'htmlOptions'=>array('class'=>'pull-right'),
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'Login', 'url'=>array('/user/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'My Account', 'url'=>array('/user'), 'visible'=>!Yii::app()->user->isGuest,
					'active'=>Yii::app()->controller->id === 'user'),
				array('label'=>'Admin', 'url'=>array('/admin/index'), 'visible'=>Yii::app()->user->isAdmin,
					'active'=>substr(Yii::app()->controller->id, 0, 6) === 'admin/'),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/user/logout'), 'visible'=>!Yii::app()->user->isGuest),
			),
		),
	),
)); ?>

<div class="container" id="page">

	<? if(isset($this->breadcrumbs)): ?>
		<? $this->widget('bw.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<? endif; ?>

	<? $this->widget('bw.TbAlert', array(
		'block'=>true, // display a larger alert block?
		'fade'=>true, // use transitions?
		'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
		'alerts'=>array( // configurations per alert type
			'success'=>array(), // success, info, warning, error or danger
			'info'=>array(), // success, info, warning, error or danger
			'warning'=>array(), // success, info, warning, error or danger
			'error'=>array(), // success, info, warning, error or danger
		),
	)); ?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<hr />
	
	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> <?= CHtml::encode(Yii::app()->params['companyName']); ?>.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
