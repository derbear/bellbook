<?php

/**
 * LoginController class.
 *
 * manages login of users and displays corresponding forms. All login goes through here
 * (or at least should go through here) e.g. Register controller auto logs someone in after 
 * registering, so it calls LoginController's actionLogin()
 * 
 * @extends BBUnknownFrontendController
 */
class LoginController extends BBUnknownFrontendController
{
	public function actionIndex()
	{
		$this->actionLogin();
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
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new User('login');
		$model->loginInfo = new LoginInfo();

		// collect user input data
		if(isset($_POST['User'], $_POST['LoginInfo'])) {

			$model->attributes=$_POST['User'];
			$model->loginInfo->attributes = $_POST['LoginInfo'];
			
			// validate user input and redirect to the welcome page if valid
			// note the separation of input validation and authentication -> authentication
			// is completely handled in LoginUser (unlike the LoginForm of the demo app)
			$valid = $model->validate();
    		$valid = $model->loginInfo->validate() && $valid;
    		if ($valid && $model->authenticateSelfAndLogin()) {		
    			// redirect to original page
    			$redirectUrl = Yii::app()->user->returnUrl;
    			$this->redirect($redirectUrl);
    		}
   		}
		// display the login form if invalid
		$this->render('login',array('model'=>$model));
	}
	
	

	
}