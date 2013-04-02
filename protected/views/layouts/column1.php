<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div id="content">
	
	<div id="flash-messages">
		<? foreach (Yii::app()->user->getFlashes() as $flashKey => $flashValue): ?>
			<? if ($flashValue instanceof FlashMessage): ?>
				<? $flashValue->render(); // Render unhandled messages ?>
			<? endif; ?>
		<? endforeach; ?>
	</div>
	
	<?php echo $content; ?>
</div><!-- content -->
<?php $this->endContent(); ?>