<?php

class SiteController extends Controller
{
	public function actionIndex()
	{
		$this->pageTitle = 'Home';
		
		$this->render('index');
	}

	public function actionError()
	{
		$this->pageTitle = 'Error';
		
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

}