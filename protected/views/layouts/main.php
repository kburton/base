<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	
	<link rel="shortcut icon" href="<?= Yii::app()->baseUrl; ?>/images/favicon.ico" />
	
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?= Yii::app()->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?= Yii::app()->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?= Yii::app()->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?= Yii::app()->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?= Yii::app()->baseUrl; ?>/css/form.css" />

	<title><?= CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?= CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<? $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'Login', 'url'=>array('/user/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'My Account', 'url'=>array('/user'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Admin', 'url'=>array('/admin/index'), 'visible'=>Yii::app()->user->isAdmin),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/user/logout'), 'visible'=>!Yii::app()->user->isGuest),
			),
		)); ?>
	</div><!-- mainmenu -->
	
	<? if(isset($this->breadcrumbs)): ?>
		<? $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?>
	<? endif; ?>

	<?= $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?= date('Y'); ?> <?= Yii::app()->params['companyName']; ?>.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
