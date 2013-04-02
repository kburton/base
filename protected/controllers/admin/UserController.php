<?php

class UserController extends AdminBaseController
{
	function __construct($id, $module = null)
	{
		parent::__construct($id, $module);
		$this->pageTitle = 'Admin | Users';
		$this->breadcrumbs['Users'] = array('/admin/user');
	}
	
	public function actionIndex()
	{
		$userFilter = new User('search');
		$userFilter->Status = '';
		$userFilter->LastSuccessfulLogin = '';
		$userFilter->IsAdmin = '';
		
		if (isset($_GET['User']))
			$userFilter->attributes = $_GET['User'];
		
		$this->render('list', array('userFilter'=>$userFilter));
	}
	
	public function actionCreate()
	{
		$this->pageTitle = 'Admin | Create User';
		$this->breadcrumbs[] = 'Create User';
		$user = new User;
		
		if (isset($_POST['User']))
		{
			$user->attributes = $_POST['User'];
			
			if ($user->save())
			{
				FlashMessage::setSuccess('Thanks, the user has been created. You can update their details below.',
						'User Created');
				$this->redirect(array('/admin/user/edit', 'id'=>$user->Id));
			}
		}
		
		$this->render('edit', array('user'=>$user));
	}
	
	public function actionEdit($id)
	{
		$this->pageTitle = 'Admin | Edit User';
		$this->breadcrumbs[] = 'Edit User';

		$user = User::model()->findByPk($id);
		
		if (!$user)
			throw new CHttpException(404, 'User not found.');
		
		if (isset($_POST['User']))
		{
			$user->attributes = $_POST['User'];
			
			if ($user->save())
			{
				FlashMessage::setSuccess('Thanks, the user details were updated successfully.', 'User Updated');
				$this->refresh();
			}
		}
		
		$this->render('edit', array('user'=>$user));
	}

}
