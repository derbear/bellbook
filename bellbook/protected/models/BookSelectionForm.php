<?php

/**
 * BookSelectionForm class.
 * BookSelectionForm is a data structure that collects parameters to identify a Book.
 *
 * BookSelectionForm is almost like a proxy for a Book object.]
 *
 * @property searchInput the input in the search
 */
class BookSelectionForm extends CFormModel
{
	public $book_id;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('book_id', 'numerical', 'integerOnly'=>true, 'allowEmpty'=>false),
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
			'book_id'=>'Book Identifier',
		);
	}
	
	/**
	 * createCorrespondingBookModelForIdentification() generates a corresponding Book Model for identification.
	 *
	 * This isn't hard because all we do is make a bookmodel with the same book_id as the selection form
	 * 
	 * @access public
	 * @return Book book model
	 */
	public function createCorrespondingBookModelForIdentification() {
		$idModel = new Book('reference');
		$idModel->unsetAttributes();
		
		$idModel->book_id = $book_id;
		return $idModel;
	}
	
	/**
	 * selectedBook function finds and returns the actual book this selectionForm identifies.
	 * 
	 * @access public
	 * @return Book corresponding book
	 */
	public function selectedBook() {
		$selectedBook = Book::model()->findByPk($this->book_id);
		return $selectedBook; //this is null if none found
	}
}