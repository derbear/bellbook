<?php

/**
 * YouController class.
 *
 * Benjamin Chan (Vervious) March 2012
 * 
 * @extends BBFrontendController
 */
class YouController extends BBFrontendController
{

	/**
	 * filters function - force access control filter (accessRules) to be applied to every action.
	 * 
	 * @access public
	 * @return void
	 */
	public function filters() {
		return array(
			'accessControl',
		);
	}

	/**
	 * accessRules function denies access to any action unless the user is authenticated (@).
	 * 
	 * @access public
	 * @return void
	 */
	public function accessRules() {
		return array(
			// allow authenticated users to some actions
			array('allow', 'actions'=>array('index', 'logout', 'sell', 'transactions'), 'users'=>array('@')),			
			array('allow', 'actions'=>array('login', 'register'), 'users'=>array('?')), //don't give logged in users access to login/register pages (it's redundant)
			array('deny',   // deny the rest
				'users'=>array('*'),
			),
		);
	}
	
	
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionLogin()
	{
		$this->pageTitle = 'Login';
		$model=new User('login');
		$model->loginInfo = new LoginInfo();
		
		// collect user input data
		if(isset($_POST['User'], $_POST['LoginInfo'])) {

			$model->attributes=$_POST['User'];
			$model->loginInfo->attributes = $_POST['LoginInfo'];
			
			// validate user input and redirect
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
		// display the login form if invalid or nothing to validate
		$this->render('login',array('model'=>$model));
	}

	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	/**
	 * actionRegister registers a new user.
	 * 
	 * creates the view, validates, and registers
	 *
	 * @access public
	 * @return void
	 */
	public function actionRegister()
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
    					$this->redirect(Yii::app()->user->returnUrl);
    				}
    			}
    		}
    	}
		
		$this->render('register',array('model'=>$model));
	}

	public function actionSell()
	{
		$this->pageTitle = 'Sell A Book';
		
		// first, define the (model) objects we're going to create
		
		// the book the user says this sell offer is all about
		$userBookSelection = new BookSelectionForm(); 
		$userBookSelection->unsetAttributes(); // remove default values… 
		// the book the user may be trying to create
		$userCreateBook = new Book('new');
		$userCreateBook->unsetAttributes(); // remove default values… 
		// the sell offer the user is trying to create
		$userSellOffer = new SellOffer('new');
		$userSellOffer->unsetAttributes(); // remove default values… 
		
		// each step has a corresponding view
		// step 1: IDENTIFY the book you want to sell (_identify.php)
		// step 2: DESCRIBE the sell offer (_describe.php)
		// step 3: DONE! where to go from here (redirect with message)
		
		
		/* Step 1: IDENTIFY! */
		if(isset($_POST['BookSelectionForm'])) { /*if user identified a book…*/
			$userBookSelection->attributes=$_POST['BookSelectionForm'];
			if ($userBookSelection->validate()) { 
				// the selected input seems ok. Now let's try to grab the corresponding book and see if that's ok…
				$userSelectedBook = $userBookSelection->selectedBook();
				if ( $userSelectedBook!=null && $userSelectedBook->validate() ) {
					// the book exists in the database, the selection is good to go!
					$userSellOffer->book_id = $userSelectedBook->book_id; 
					$this->render('sell_describe',array('model'=>$userSellOffer));
					return;
				}
			}
			// TODO: Selection List
			$this->render('sell_identify',array('model'=>$userBookSelection, 'newBookModel'=>$userCreateBook));
			return;
		}
		
		else if(isset($_POST['Book'])) { /*if user created a book…*/
			$userCreateBook->attributes=$_POST['Book'];
			if ($userCreateBook->validate()) {
				// woot! THe user specified a new, valid book. Now create the book.
				if (!$this->_createNewBook($userCreateBook)) {
					// something horrible went wrong…
					$userCreateBook->addError('title','Something went horribly wrong. Please refresh the page and try again, or contact us to resolve the issue.');
				} else {
					// success! 
					// now that the data is saved we can clear the form
					$userCreateBook->unsetAttributes();
					// Rerender the view with new book as an option ( perhaps first option? )
					$this->render('sell_identify',array('model'=>$userBookSelection, 'newBookModel'=>$userCreateBook));
					return;
				}
			} 
			// didn't validate -> rerender with errors
			$this->render('sell_identify',array('model'=>$userBookSelection, 'newBookModel'=>$userCreateBook));
			return;
		}
		
		/* Step 2: DESCRIBE! */
		else if(isset($_POST['SellOffer'])) { /* if user tried to create a new Sell Offer in Step 2*/
			$userSellOffer->attributes=$_POST['SellOffer'];
			// insert other necessary data for validation/creation that we already know
			$userSellOffer->user_id = Yii::app()->user->id;
			$userSellOffer->open = SellOffer::STATUS_OPEN;
			$userSellOffer->confirmed = SellOffer::STATUS_NOT_CONFIRMED;
			
			if ($userSellOffer->validate()) {  //if it doesn't have any errors in it
				// create the sell offer
				if ($this->_createSellOffer($userSellOffer)) {
					// DONE!!!!
					// TODO: redirect to the new listing!
					$this->redirect(Yii::app()->homeUrl);
					return;
				} else {
					$userSellOffer->addError('Oh No!','We couldn"t create the Sell Offer due to database trouble');
				}
			} 
			
			$this->render('sell_describe',array('model'=>$userSellOffer));
			return;
		}
		
		$this->render('sell_identify',array('model'=>$userBookSelection, 'newBookModel'=>$userCreateBook));
		return;

	}

	public function actionTransactions()
	{
		$this->pageTitle = 'Your Transactions';
		$this->render('transactions', array('mySellOffers'=>$this->_generateMySellOffersList()));
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
	
	/* ***************** */
	/* HELPER FUNCTIONS */
	/* ****************** */
	
	/**
	 * _generateMySellOffersList gets all the sellOffers that belong to the logged in user.
	 * 
	 * @access private
	 * @return user's Sell Offers
	 */
	private function _generateMySellOffersList() {
		$dataProvider = new CActiveDataProvider( 'SellOffer' , array (
			'pagination' => array( 'pageSize' => 20, ),
			'criteria' => array( 
				'condition' => 'user_id = :userId', // where clause in sql statement
				'order' => 'date DESC',
				'params' => array(':userId'=>(int)Yii::app()->user->id),
			),
		));
		
		return $dataProvider;
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
	
	/**
	 * _createNewBook creates a new book and saves it to the database
	 *
	 * Does not handle validation. All validation should be done beforehand.
	 * For instance, if a book is passed in that already exists, this function will
	 * just create another copy of it.
	 *
	 * @access private
	 * @param mixed $book
	 * @return bool if successful or not
	 */
	private function _createNewBook($book) {
		$success = $book->save(false);
		return $success;
	}
	
	/**
	 * _createSellOffer creates a new sell offer and saves it to the database.
	 * 
	 * Does not perform validation.
	 *
	 *
	 * @access private
	 * @param SellOffer $sellOffer
	 * @param Book $book the book that the sellOffer sells
	 * @return bool if successful
	 */
	private function _createSellOffer($sellOffer) {
		$success = $sellOffer->save(false);
		return $success;
	}
}