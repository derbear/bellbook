<?php

class ProfileController extends BBLoggedInFrontendController
{
	/**
	 * actionIndex shows the current user's profile.
	 * 
	 * @access public
	 * @return void
	 */
	public function actionIndex()
	{
		// $user is type User, and holds the profile information
		$user_id = Yii::app()->user->id;
		$user = User::model()->findByPk($user_id);
		
		if ($user===null) throw new CHttpException(404,'Page could not be found. Try logging in again.');
		
		$this->render('index', array('model'=>$user));
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
	
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}