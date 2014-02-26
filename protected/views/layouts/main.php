<?php /* @var $this Controller */ ?>

<? Yii::app()->clientScript
		->registerPackage('bootstrap')
		->registerScript('tooltip',
				"$('[data-toggle=\"tooltip\"]').tooltip();$('[data-toggle=\"popover\"]').tooltip()",
				CClientScript::POS_READY)
		->registerScript('wp8fix', "
				if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
					var msViewportStyle = document.createElement('style')
					msViewportStyle.appendChild(
						document.createTextNode(
							'@-ms-viewport{width:auto!important}'
						)
					)
					document.querySelector('head').appendChild(msViewportStyle)
				}", CClientScript::POS_READY); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="language" content="en" />
	<link rel="shortcut icon" href="<?= Yii::app()->baseUrl; ?>/images/favicon.ico" />
	<title><?= CHtml::encode($this->pageTitle); ?></title>
	<link rel="stylesheet" type="text/css" href="<?= Yii::app()->baseUrl; ?>/css/main.css" />
</head>

<body>
	<nav class="navbar navbar-default navbar-static-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#collapsible-nav">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <a class="navbar-brand" href="/"><?= CHtml::encode(Yii::app()->name); ?></a>
			</div>
			<div class="collapse navbar-collapse" id="collapsible-nav">
				<? $this->widget('bootstrap.widgets.TbNav', array(
					'items'=>array(
						array('label'=>'Home', 'url'=>array('/site/index')),
						array('label'=>'Login', 'url'=>array('/user/login'), 'visible'=>Yii::app()->user->isGuest),
						array('label'=>'My Account', 'url'=>array('/user'), 'visible'=>!Yii::app()->user->isGuest),
						array('label'=>'Admin', 'url'=>array('/admin/index'), 'visible'=>Yii::app()->user->isAdmin),
						array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/user/logout'), 'visible'=>!Yii::app()->user->isGuest),
					),
				)); ?>
			</div>
		</div>
	</nav>

	<div class="container">
		<? if(isset($this->breadcrumbs)): ?>
			<? $this->widget('bootstrap.widgets.TbBreadcrumb', array(
				'links'=>$this->breadcrumbs
			)); ?>
		<? endif; ?>
		
		<?= $content; ?>

		<div class="clear"></div>

		<div id="footer">
			<hr />
			Copyright &copy; <?= date('Y'); ?> <?= Yii::app()->params['companyName']; ?>.<br/>
			All Rights Reserved.<br/>
			<?php echo Yii::powered(); ?>
		</div><!-- footer -->
	</div>
</body>
</html>
