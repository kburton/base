<?php

class UserController extends Controller
{
	function __construct($id, $module = null)
	{
		parent::__construct($id, $module);
		
		if (!Yii::app()->user->isGuest)
			$this->layout = '//layouts/column2';
	}
	
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image
			'captcha'=>array(
				'class'=>'CCaptchaAction',
			),
		);
	}
	
	public function getMenu()
	{
		if (Yii::app()->user->isGuest)
			return array();
		
		$controllerId = Yii::app()->controller->id;
		$actionId = Yii::app()->controller->action->id;
		
		return array(
			array('label'=>'MY ACCOUNT'),
			array('label'=>'View My Details', 'url'=>'/user/view', 'icon'=>'user',
				'active'=>$controllerId === 'user' && $actionId === 'view'),
			array('label'=>'Change Password', 'url'=>'/user/change_password', 'icon'=>'edit',
				'active'=>$controllerId === 'user' && $actionId === 'change_password'),
		);
	}
	
	public function actionIndex()
	{
		$this->pageTitle = 'My Account';
		$this->breadcrumbs[] = 'My Account';
		
		$this->render('index');
	}

	public function actionLogin()
	{
		$this->pageTitle = 'Login';
		$this->breadcrumbs[] = 'Login';
		$this->layout = '//layouts/column1';
		
		$loginForm = new LoginForm;
		
		if (isset($_POST['LoginForm']))
		{
			$loginForm->attributes = $_POST['LoginForm'];
			
			if ($loginForm->validate())
			{
				$loginForm->processLogin();
				
				$this->redirect(Yii::app()->user->returnUrl);
			}
		}

		$this->render('login', array('loginForm'=>$loginForm));
	}

	public function actionLogout()
	{
		$this->layout = '//layouts/column1';

		Yii::app()->user->logout();

		FlashMessage::setSuccess('Thanks, you have been logged out.', 'Logged Out');
		
		$this->forward('login');
	}

	public function actionRequest_password_reset()
	{
		$this->pageTitle = 'Request Password Reset';
		$this->breadcrumbs[] = 'Request Password Reset';
		$this->layout = '//layouts/column1';
		
		$requestPasswordResetForm = new RequestPasswordResetForm;

		if (isset($_POST['RequestPasswordResetForm']))
		{
			$requestPasswordResetForm->attributes = $_POST['RequestPasswordResetForm'];

			if ($requestPasswordResetForm->validate())
			{
				try
				{
					$requestPasswordResetForm->processPasswordResetRequest();
					FlashMessage::setSuccess(
						'Thanks, a password reset email has been sent to your registered account.<br />'
						. 'Please follow the link in the email to change your password.',
						'Password Reset Email Sent',
						array('key'=>'user/request_password_reset:success'));
					$this->refresh();
				}
				catch (Exception $ex)
				{
					FlashMessage::setError($ex->getMessage());
				}
			}
		}

		$this->render('requestPasswordReset',
			array('requestPasswordResetForm'=>$requestPasswordResetForm));
	}

	public function actionReset_password($userid = null, $verifid = null, $verifcode = null)
	{
		$this->pageTitle = 'Reset Password';
		$this->breadcrumbs[] = 'Reset Password';
		$this->layout = '//layouts/column1';
		
		$resetPasswordForm = null;
		$requestIsValid = false;

		try
		{
			$resetPasswordForm = new ResetPasswordForm($userid, $verifid, $verifcode);
			$requestIsValid = true;
		}
		catch (Exception $ex)
		{
			FlashMessage::setError($ex->getMessage(), 'Error',
				array('key'=>'user/reset_password:error'));
		}

		if ($requestIsValid)
		{
			if (isset($_POST['ResetPasswordForm']))
			{
				$resetPasswordForm->attributes = $_POST['ResetPasswordForm'];

				if ($resetPasswordForm->validate())
				{
					try
					{
						$resetPasswordForm->processPasswordReset();
						VerificationCode::deactivateCodes('password_reset', $userid, $userid);
						FlashMessage::setSuccess(
							'Thanks, your password has been changed. You may now log in below.',
							'Password Changed Successfully');
						$this->redirect(array('/user/login'));
					}
					catch (Exception $ex)
					{
						FlashMessage::setError($ex->getMessage());
					}
				}
			}
		}

		$this->render('resetPassword', array('resetPasswordForm'=>$resetPasswordForm));
	}
	
	public function actionChange_password()
	{
		$this->pageTitle = 'Change Password';
		$this->breadcrumbs['My Account'] = '/user';
		$this->breadcrumbs[] = 'Change Password';
		
		$changePasswordForm = new ChangePasswordForm;
		$changePasswordForm->user = Yii::app()->user->user;
		
		if (isset($_POST['ChangePasswordForm']))
		{
			$changePasswordForm->attributes = $_POST['ChangePasswordForm'];
			
			if ($changePasswordForm->validate())
			{
				$changePasswordForm->processPasswordChange();
				FlashMessage::setSuccess('Thanks, your password has been changed.', 'Password Changed');
				$this->redirect(array('/user'));
			}
		}
		
		$this->render('changePassword', array('changePasswordForm'=>$changePasswordForm));
	}
	
	public function actionView()
	{
		$this->pageTitle = 'My Details';
		$this->breadcrumbs['My Account'] = '/user';
		$this->breadcrumbs[] = 'My Details';
		
		$user = Yii::app()->user->user;
		
		$this->render('view', array('user'=>$user));
	}

}
