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
		
		// first, define the (model) objects we're going to create
		
		// the book the user says this sell offer is all about
		$userBookSelection = new BookSelectionForm(); 
		$userBookSelection->unsetAttributes(); // remove default values… 
		// the book the user may be trying to create
		$userCreateBook = new Book('new');
		$userCreateBook->unsetAttributes(); // remove default values… 
		// the book that only holds a single ISBN
		$userIsbnBook = new Book('isbn');
		$userIsbnBook->unsetAttributes();
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
			// render generic form, requiring only ISBN for new books
			$this->render('sell_identify',array('model'=>$userBookSelection, 'newBookModel'=>$userIsbnBook));
			return;
		}
		
		else if(isset($_POST['Book'])) { /*if user created a book…*/
			$userCreateBook->attributes=$_POST['Book'];
			$userIsbnBook->attributes = $_POST['Book']; // TWO PATHS OF VALIDATION
			
			$isTotalValidation = $userCreateBook->validate();
			$isIsbnValidation = $userIsbnBook->validate();
			
			// path 1: All details filled out, ready to make book
			if ($isTotalValidation && $isIsbnValidation) {
				// woot! THe user specified a new, valid book. Now create the book.
				if (!$this->_createNewBook($userCreateBook)) {
					// something horrible went wrong…
					$userCreateBook->addError('title','Something went horribly wrong. Please refresh the page and try again, or contact us to resolve the issue.');
				} else {
					// success! 
					// now that the data is saved we can clear the form
					$userCreateBook->unsetAttributes();
					$userIsbnBook->unsetAttributes();
					// Rerender the view with new book as an option ( perhaps first option? )
					$this->render('sell_identify',array('model'=>$userBookSelection, 'newBookModel'=>$userIsbnBook));
					return;
				}
			}
			// path 2: Only Isbn filled out
			if ($isIsbnValidation) {
				// User entered an ISBN!
				$userCreateBook = $this->_buildNewBookModelFromIsbn($userIsbnBook->ISBN);
				if ($userCreateBook) {
					// add a notification (temporary, it's not really an error)
					$userCreateBook->addError('title','We prefilled in everything for you!');
					// send them back to the same page, with details filled in
					$this->render('sell_identify',array('model'=>$userBookSelection, 'newBookModel'=>$userCreateBook));
					return;
				} else {
					// isbn invalid, couldn't be found
					$userIsbnBook->addError('ISBN',"ISBN doesn't match any book in our records");
				}
			}
			// Nothing validated
			//-> rerender with errors for ISBN required only
			$this->render('sell_identify',array('model'=>$userBookSelection, 'newBookModel'=>$userIsbnBook));
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
		// render generic form, requiring only ISBN for new books
		$this->render('sell_identify',array('model'=>$userBookSelection, 'newBookModel'=>$userIsbnBook));
		return;

	}

	public function actionTransactions()
	{
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
	
	// This might be useful for grabbing images? http://openlibrary.org/dev/docs/restful_api
	
	/**
	 * _buildNewBookModelFromIsbn takes an isbn number, looks it up from isbndb.com, and returns
	 * a Book model filled with the corresponding attributes.
	 * 
	 * @access private
	 * @return Book model described by ISBN (null if not found)
	 */
	private function _buildNewBookModelFromIsbn($isbnToLookup) {
		$newBookModel = new Book('new');
		$newBookModel->unsetAttributes(); // remove default values… 
		
		if ($this->grabBookInfo($isbnToLookup, $isbn10, $isbn13, $title, $longtitle, $author, $publisher)) {
			$authorNames = explode(" ", $author); //split into first and last names
			
			$newBookModel->ISBN = $isbn13;
			$newBookModel->title = $title;
			$newBookModel->author_firstname = $authorNames[0];
			if (count($authorNames)>1)
				$newBookModel->author_lastname = preg_replace("/(?![.=$'€%-])\p{P}/u", "", $authorNames[1]); //a comma follows
			$newBookModel->publisher = $publisher;
			if (count($authorNames)>2) { // if multiple authors, let's throw them into other data for now
				for($i=2; $i<count($authorNames); $i++) {
					$newBookModel->other_data .= $authorNames[$i] . " ";
				}
			}
		} else {
			$newBookModel = null;
		}
		
		return $newBookModel; // null if no match found
	}
	
	/**
	 * grabBookInfo function.
	 *
	 * Derek Leung 2012
	 * Uses external online database (isbndb.com) to grab book information given an isbn to lookup
	 * writes all information to parameters passed in
	 * 
	 * @access private
	 * @param mixed $fisbn
	 * @param mixed &$isbn10
	 * @param mixed &$isbn13
	 * @param mixed &$title
	 * @param mixed &$title_ext
	 * @param mixed &$author
	 * @param mixed &$publisher
	 * @return void
	 */
	private function grabBookInfo($fisbn, &$isbn10, &$isbn13, &$title, &$title_ext, &$author, &$publisher) {
	    $LOOKUP_URL = "http://isbndb.com/api/books.xml?";
		$LOOKUP_KEY = "58EJBTZO";
	    $full_url = $LOOKUP_URL . "access_key=" . $LOOKUP_KEY . "&index1=isbn&value1=" . $fisbn;
	    $contents = file_get_contents($full_url);
	    $parser = xml_parser_create();
	    xml_parse_into_struct($parser, $contents, $values, $index);
	    xml_parser_free($parser);
	    $num_results = $values[$index['BOOKLIST'][0]]['attributes']['TOTAL_RESULTS']; 
	    if(($num_results == 0)||($num_results == '0') ) { // bad ISBN
	        return false;
	    }
	    // now retrieve data from the very first result
	    $indx = $index['BOOKDATA'][0]; // get index of very first result's data
	    $isbn10 = $values[$indx]['attributes']['ISBN'];
	    $isbn13 = $values[$indx]['attributes']['ISBN13'];
	    $title = $values[$index['TITLE'][0]]['value'];
	    $title_ext = $values[$index['TITLELONG'][0]]['value'];
	    $author = $values[$index['AUTHORSTEXT'][0]]['value'];
	    $publisher = $values[$index['PUBLISHERTEXT'][0]]['value'];
	    
	    return true;
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

