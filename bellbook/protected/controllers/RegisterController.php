<?php
//  * DEPRECATED

class RegisterController extends BBUnknownFrontendController
{
	/**
	 * actionIndex function - displays register form. Registers the user if form submitted.
	 * 
	 * @access public
	 * @return void
	 */
	public function actionIndex()
	{
		$model = new User('register'); /* register a user! scenario requires all user info */
		$model->loginInfo = new LoginInfo(); // also initialize the corresponding password model
		// IMPORTANT: the above links the two models in PHP (as a simple property), but not on the database level (foreign keys are still undefined). 
		
		if(isset($_POST['User'], $_POST['LoginInfo'])) {
			// add info to the user
    		$model->attributes=$_POST['User'];
    		$model->loginInfo->attributes = $_POST['LoginInfo'];
    		
    		// validate user input
    		$valid = $model->validate();
    		$valid = $model->loginInfo->validate() && $valid;
    		if ($valid) {
    			// now, the user has been validated - now try to register it (which links the foreign keys)
    			if ($this->_registerUser($model)) {
    				// if user creation (in database) successful, now tell the 
    				// actual user to login. Note that this will reauthenticate (just in case)
    				if ($this->_loginUser($model)) {
    					// login successful!
    					// redirect to logged in area
    					$this->redirect(array('welcome/'));
    				}
    			}
    		}
    	}
		
		$this->render('index',array('model'=>$model));

	}
	
	/**
	 * _registerUser registers the provided User by saving the user to the database
	 * 
	 * 
	 * Does not perform validation. MAKE SURE TO VALIDATE BEFOREHAND lest bad data
	 * gets into the database.
	 *
	 * @access private
	 * @param mixed $user type User('register') must be initialized with data already
	 * @return BOOL
	 */
	private function _registerUser($user) {
	
		// hash the submitted password to save it
		$submittedPassword = $user->loginInfo->password;
		$user->loginInfo->password = $user->hashPassword($user->loginInfo->password);
	
		// Save the user to the database
		// which Generates a unique user_id (PK) which we will then
		// associate with loginInfo to create 1:1 relation
		$success = $user->save(false); 
		
		//now, link the user and the password through the foreign key
		$user->loginInfo->user_id = $user->user_id; 
				
		// save the login info
		$success = $success && $user->loginInfo->save(false);
		
		// since we're gonna auto-login using the login script, we still need the original, submitted password to authenticate against the stored hash version
		// remember that $user is simply a… temporary copy of submitted register/login data
		// a better method would be nice, but this works
		$user->loginInfo->password = $submittedPassword;
		
		return $success; 
	}
	
	/**
	 * _loginUser function logs in with the given user data.
	 * 
	 * @access private
	 * @param mixed $user temporary User model object with student_id and loginInfo set
	 * @return void
	 */
	private function _loginUser($user) {
		return $user->authenticateSelfAndLogin();
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
}