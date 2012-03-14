<?php

/**
 * BrowseForm class.
 * BrowseForm is a data structure that collects search parameters for the browse actions.
 *
 * BrowseForm also happens to define how search works by translating itself into a corresponding Book model with which to actually search.
 * In this class are search:
 * 		-keywords and terms (TODO)
 *		-ability to search for title/isbn/etc. all in just one search box
 *		-maybe some easter eggs :D
 *
 * @property searchInput the input in the search
 */
class BrowseForm extends CFormModel
{
	public $searchInput = "";

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('searchInput', 'required'),
			array('searchInput', 'safe'),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'searchInput'=>'Search Text',
		);
	}
	
	/**
	 * createCorrespondingBookModelForSearch() generates a corresponding Book Model for search.
	 *
	 * Because the search input is only one string, we have to somehow translate that into what attributes to search for, etc.
	 * This requires creating a new Book object to hold these different attributes to search for, and
	 * this method does that and translates between the two.
	 * 
	 * @access public
	 * @return Book book model
	 */
	public function createCorrespondingBookModelForSearch() {
		$searchModel = new Book('search');
		$searchModel->unsetAttributes();
		
		$searchInput = $this->searchInput;
		
		if ($searchInput=="Suggestions") {
			$searchModel->title = null;
		} else {
			$searchModel->title = $searchInput;
		}
		return $searchModel;
	}
}