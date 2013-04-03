<? $this->beginContent('//layouts/main'); ?>
<div class="row">
    <div class="span3">
        <div id="sidebar">
			<div class="well" style="padding:5px;">
				<? $this->widget('bw.TbMenu', array(
					'type'=>'list',
					'items'=>$this->menu,
					'htmlOptions'=>array('class'=>'operations'),
				)); ?>
			</div>
        </div><!-- sidebar -->
    </div>
    <div class="span9">
        <div id="content">
            <?php echo $content; ?>
        </div><!-- content -->
    </div>
</div>
<?php $this->endContent(); ?>