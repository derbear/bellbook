<?php

class BrowseController extends BBFrontendController
{

	public $defaultAction = 'recommended';
	
	
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
		$this->pageTitle = "Recommended Books";
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
		
		$this->pageTitle = $searchParams['searchInput'];

		$this->render('search', array(
			'searchResults'=>$this->_generateBrowseBookList($searchParams), /*CActiveDataProvide*/
			'searchInput'=>$searchParams, // so user can see what was searched
		));
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