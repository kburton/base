<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	private $_pageTitle = '';
	
	public function accessRules()
	{
		return array(
			array('allow', 'users'=>array('@')),
			array('allow',
				'controllers'=>array('user'),
				'actions'=>array('login', 'logout', 'request_password_reset', 'reset_password', 'captcha'),
			),
			array('allow',
				'controllers'=>array('site'),
				'actions'=>array('error'),
			),
			array('deny'),
		);
	}
	
	public function filters()
	{
		return array('accessControl');
	}
	
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	/**
	 * Sets an explicit page title to prepend to the application name.
	 * @param string $pageTitle
	 */
	public function setPageTitle($pageTitle)
	{
		$this->_pageTitle = $pageTitle;
	}
	
	/**
	 * Overrides parent implementation.
	 * Uses the explicit page title if one has been specified or generates one
	 * from the controller and action name otherwise.
	 * @return string the new title
	 */
	public function getPageTitle()
	{
		$result = Yii::app()->name;
		
		if ($this->_pageTitle)
			return $this->_pageTitle . ' | ' . $result;
		
		$controllerName = preg_replace('/[A-Z]/', ' $0', $this->id);
		$controllerName = preg_replace('/\//', ' | ', $controllerName);
		$actionName = preg_replace('/[A-Z]/', ' $0', $this->action->id);
		$result .= ' | ' . ucwords($controllerName);
		$result .= ' | ' . ucwords($actionName);
		
		return $result;
	}

}