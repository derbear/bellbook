<?php

class BrowseController extends BBFrontendController
{

	public $defaultAction = 'recommended';
	
	/**
	 * bookDesignator designates (in the search bar) that the user is viewing a particular book
	 *
	 * @note currently assumed to be on both sides, e.g. &quot;content&quot;
	 * 
	 * @var string
	 * @access public
	 */
	public $bookDesignator = '&quot;';
	
	
	public function actionBook()
	{
		$selectedBookForm = new BookSelectionForm(); 
		$selectedBookForm->unsetAttributes(); // remove default values…
		
		if(isset($_GET['BookSelectionForm'])) { /*if user identified a book…*/
			$selectedBookForm->attributes=$_GET['BookSelectionForm'];
			if ($selectedBookForm->validate()) { 
				// the selected input seems ok. Now let's try to grab the corresponding book and see if that's ok…
				$selectedBook = $selectedBookForm->selectedBook();
				if ( $selectedBook!=null && $selectedBook->validate() ) {
					$this->pageTitle = $this->bookDesignator . $selectedBook->title . $this->bookDesignator;
					// the book exists in the database, the selection is good to go!
					$this->render('book',array('model'=>$selectedBook));
					return;
				}
			}
		}
		// book could not be found
		$this->render('book_lost');
	}

	public function actionCourse()
	{
		$this->render('course');
	}

	public function actionRecommended()
	{
		// get ongoing buy transactions
		// get sold by friends
		// get classes stuff
		// then all books
		// $this->render('recommended');
		$searchParams = new BrowseForm();
		$searchParams->searchInput = "";
		$_GET['Book_sort'] = 'title'; /* to get defualt sorting to show up on the UI */
		
		$this->render('search', array(
			'searchResults'=>$this->_generateBrowseBookList($searchParams), /*CActiveDataProvide*/
			'searchInput'=>$this->pageTitle, // so user can see what was searched
		));
	}

	public function actionSearch()
	{
		/* TODO: Always show ones with offers on top? */
		$searchParams = new BrowseForm();
		$searchParams->unsetAttributes(); // remove default values… 
		
		if (isset($_GET['BrowseForm'])) {
			$searchParams->attributes=$_GET['BrowseForm'];
		}
		
		$searchParams->searchInput = htmlentities($searchParams->searchInput, ENT_QUOTES); // get html form of quotes, etc.
		if ($searchParams->validate()) {
			$searchResults = null;
			
			// check if the input is a keyword
			$searchInput = $searchParams->searchInput;
			$keywordDesignator = Yii::app()->keywords->designator;
			// check if $searchInput has been designated a keyword (that is at least 1 character long)
			if (strlen($searchInput) > strlen($keywordDesignator) && substr($searchInput, 0, strlen($keywordDesignator))==$keywordDesignator) {
				$keyword = substr($searchInput, strlen($keywordDesignator));
				$route = Yii::app()->keywords->routeForKeyword($keyword);
				if ($route) { //if the keyword+route was found
					// redirect to the correct page as specified by keyword
					$this->redirect(array($route));
				} else {
					// 404 page not found
					throw new CHttpException(404,'The specified page cannot be found.');
				} 
			}
			
			$bookDesignator = $this->bookDesignator;
			// check if the input is a specific book - if so, go straight to the book if it's the only search result
			if (strlen($searchInput) > strlen($bookDesignator) * 2 && substr($searchInput, 0, strlen($bookDesignator))==$bookDesignator && substr($searchInput, -1 * strlen($bookDesignator))==$bookDesignator) { // assume both sides have the designator
				$bookTitle = substr($searchInput, strlen($bookDesignator), strlen($searchInput) - 2 * strlen($bookDesignator));
				$searchParams->searchInput = $bookTitle;
				$searchInput = $bookTitle;
								
				// generate search results
				$searchResults = $this->_generateBrowseBookList($searchParams);
				
				if ($searchResults->itemCount==1) {
					 $books = $searchResults->getData(); 
					 $book = $books[0]; // get the one result (Book model)
					 $this->redirect(array('browse/book', 'BookSelectionForm[book_id]'=>$book->book_id)); //redirect to book
				}
			}
			
			if (!$searchResults) {
				$searchResults = $this->_generateBrowseBookList($searchParams);
			}
			
			// conduct normal search
			$this->pageTitle = $searchParams->searchInput;
			$this->render('search', array(
				'searchResults'=>$searchResults, /*CActiveDataProvide*/
				'searchInput'=>$searchParams, // so user can see what was searched
			));
			
			return;
		}
		
		$this->redirect(array('browse/recommended'));
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
	
	
	/* Private functions for listing */
	
	/**
	 * _generateBrowseBookList generates a list of books from which user selects a book to buy..
	 * 
	 * @access private
	 * @param BrowseForm $searchParams the params for which 
	 * 		we should generate a searchmodel and from that a provider
	 * @return CActiveDataProvider with search results
	 */
	private function _generateBrowseBookList($searchParams) {
		// translate the BrowseForm ($searchParams) into a tangible Book Model
		$searchModel = $searchParams->createCorrespondingBookModelForSearch();
		
		// get the list from the searchModel
		return $searchModel->search();
	}
	
}