<?php

/**
 * Provides the base class for all admin controllers
 */
class AdminBaseController extends Controller
{
	function __construct($id, $module = null)
	{
		parent::__construct($id, $module);
		$this->layout = '//layouts/column2';
		$this->pageTitle = 'Admin';
		$this->breadcrumbs['Admin'] = array('/admin/index');
	}
	
	public function accessRules()
	{
		return array(
			array('allow', 'expression'=>'Yii::app()->user->isAdmin'),
			array('deny'),
		);
	}
	public function filters()
	{
		return array('accessControl');
	}
	
	public function getMenu()
	{
		$controllerId = Yii::app()->controller->id;
		$actionId = Yii::app()->controller->action->id;
		
		return array(
			array('label'=>'USER MANAGEMENT'),
			array('label'=>'List Users', 'url'=>'/admin/user', 'icon'=>'list',
				'active'=>$controllerId === 'admin/user' && $actionId === 'index'),
			array('label'=>'Create User', 'url'=>'/admin/user/create', 'icon'=>'user',
				'active'=>$controllerId === 'admin/user' && $actionId === 'create'),
		);
	}
}
