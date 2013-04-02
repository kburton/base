<?php

/**
 * Provides the base class for all admin controllers
 */
class AdminBaseController extends Controller
{
	function __construct($id, $module = null)
	{
		parent::__construct($id, $module);
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
	
}
