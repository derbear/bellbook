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

		$this->render('search');
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