<?php

class BrowseController extends BBLoggedInFrontendController
{

	public $defaultAction = 'recommended';
	
	
	public function actionBook()
	{
		$this->render('book');
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
		$this->render('recommended');
	}

	public function actionSearch()
	{
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