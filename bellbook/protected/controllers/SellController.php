<?php

/**
 * SellController coordinates all selling books and resulting transactions 
 * (from the point of view of te seller).
 * 
 * It comes in three parts - index (summary page -> basically, sell book 
 * button + current transactions), new (sell a new book), and view (see details on
 * each book/transaction)
 * 
 * Todo: perhaps do an auto-book-creation-fill in where it grabs info from some isbn database?
 *
 * @extends BBLoggedInFrontendController
 * @author Nano8Blazex(Vervious)(bchan)
 */
class SellController extends BBLoggedInFrontendController
{
	public function actionIndex()
	{
		$this->render('index', array('mySellOffers'=>$this->_generateMySellOffersList()));
	}

	public function actionView()
	{
		$this->render('view');
	}
	
	/**
	 * actionNew creates a new sell offer.
	 *
	 * Also creates a new book if necessary.
	 * 
	 * @access public
	 * @return void
	 */
	public function actionNew()
	{
		// first, define the (model) objects we're going to create
		
		// the book the user says this sell offer is all about
		$userSelectBook = new Book('reference'); 
		// the book the user is trying to create
		$userCreateBook = new Book('new');
		// the sell offer the user is trying to create
		$userSellOffer = new SellOffer('new');
		
		// each step has a corresponding view
		// step 1: choose/create the book you want to sell (new1.php)
		// step 2: create the sell offer (new2.php)
		// step 3: done! where to go from here (new3.php)
		
		if(isset($_POST['SellOffer'])) { // if the sell offer form has been submitted (step 2 done)
			$userSellOffer->attributes=$_POST['SellOffer'];
			// insert other necessary data for validation/creation that we already know
			$userSellOffer->user_id = Yii::app()->user->id;
			$userSellOffer->open = SellOffer::STATUS_OPEN;
			$userSellOffer->confirmed = SellOffer::STATUS_NOT_CONFIRMED;
			
			if ($userSellOffer->validate()) { 
				// create the sell offer
				if (!$this->_createSellOffer($userSellOffer)) {
				}
				// render "finished! now you just wait for offers" page
				$this->render('new3',array('sellOffer'=>$userSellOffer));
			} else {
				// rerender step 2 with errors
				$this->render('new2',array('sellOffer'=>$userSellOffer));
			}
			return;
		}
		else if(isset($_POST['Book'])) { // if the book form has been submitted (step 1 done?)
			// this occurs if either a) user has selected a book
			// of b) user has just created a book
			// if a), then the attribute "book_id" is the only thing set
			// if b), book_id is not set (and everything else is probably set)
			if(isset($_POST['Book']['book_id'])) {
				// so a), so populate "select" model
				$userSelectBook->attributes = $_POST['Book'];
				if ($userSelectBook->validate()) {
					// woot! The user selected a book. Now render the view for step 2.
					// prefilling the book section in with the model from step1
					$userSellOffer->book_id = (int) $userSelectBook->book_id;
					$this->render('new2',array('sellOffer'=>$userSellOffer));
				} else {
					// rerender step1 showing validation errors
					// this, btw, shouldn't happen since generateBookList should supply valid book_ids
					$this->render('new1',array('selectModel'=>$userSelectBook, 'createModel'=>$userCreateBook, 'selectOptions'=>$this->_generateSelectBookList()));
				}
				return;
			} else {
				// so b) (at least something got submitted, namely the new book form)
				// so populate "create" model
				$userCreateBook->attributes = $_POST['Book'];
				if ($userCreateBook->validate()) {
					// woot! THe user created a new, valid book. Create the book.
					if (!$this->_createNewBook($userCreateBook)) {
						// something horrible went wrong…
						$userCreateBook->addError('title','Something went horribly wrong. Please refresh the page and try again, or contact us to resolve the issue.');
					} else {
						// success! 
						// now that the data is saved we can clear the form
						unset($userCreateBook);
						$userCreateBook = new Book('new');
					}
					// Now, rerender the view for selection
					// render step1 with new book
				} else {
					// rerender step1 shwoing errors
				}
				$this->render('new1',array('selectModel'=>$userSelectBook, 'createModel'=>$userCreateBook, 'selectOptions'=>$this->_generateSelectBookList()));
				return;
			}
			
			// if a), then load step 2 form, and prepopulate the Book section
			// if b), then create the book and reload book selection page
		}
		else { // if no steps done
			// load the book selection page
			// which also includes the form to create a book
			// render step1
			$this->render('new1',array('selectModel'=>$userSelectBook, 'createModel'=>$userCreateBook, 'selectOptions'=>$this->_generateSelectBookList()));
			return;
		}
		
	}
	
	/* Private functions for saving/registering/databasing/listing */
	
	/**
	 * _generateSelectBookList generates a list of books and ids from which user selects a book to sell.
	 * 
	 * @access private
	 * @return CActiveDataProvider dataprovider with the stuff
	 */
	private function _generateSelectBookList() {
		$dataProvider = new CActiveDataProvider( 'Book' , array (
			'pagination' => array( 'pageSize' => 20, ),
			'criteria' => array( 
				//'condition' => 'status=1', // where clause in sql statement
				'order' => 'title DESC',
			),
		));
		
		return $dataProvider;
	}
	
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