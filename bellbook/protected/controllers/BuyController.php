<?php

/**
 * DEPRECATED
 * BuyController coordinates all buying/browsing.
 *
 * Accessible through url buy/, this would basically be the heart of the application
 * where you view the items you try to buy
 * and browse items that other people are selling.
 * 
 * @author Nano8Blazex(Vervious)(bchan)
 * @extends BBLoggedInFrontendController
 */
class BuyController extends BBLoggedInFrontendController
{
	/**
	 * actionBrowse - basically everything that involves the book and viewing books/a book.
	 * 
	 * @access public
	 * @return void
	 */
	public function actionBrowse()
	{
		$searchParams = new BrowseForm();
		$searchParams->unsetAttributes(); // remove default values… 
		
		if (isset($_GET['BrowseForm'])) {
			$searchParams->attributes=$_GET['BrowseForm'];
		} else if (isset($_GET['bookid'])) {
			// a book is wanting to be shown!
			$this->actionView();
			return;
		} 
		$this->render('browse',array(
			'searchResultList'=>$this->_generateBrowseBookList($searchParams),
			'searchParams'=>$searchParams, // so user can see what was searched
		));
	}
	
	public function actionView() {
		$book = null;
		
		if (isset($_GET['bookid'])) {
			$book_id = (int) $_GET['bookid'];
			$book = Book::model()->findByPk($book_id);
		}
		if($book===null)
			throw new CHttpException(404,'The requested book could not be found.');
				
		$sellOfferList = null;
		$sellOffer = null;
		$newBuyOffer = null;
		$nBOSuccess = false;
		$buyOfferList = null;
		
		switch (isset($_GET['sellid'])) {
			// if sellid is set, that means we're looking at an individual sell offer
			case true:
				$sell_offer_id = (int) $_GET['sellid'];
				
				// view a single sell offer
				// we have it configured in sellOffers::relations() so that
				// the keys of the array of related objects corespond to the related object's PK
				$sellOffer = $book->sellOffers[$sell_offer_id];
				
				if ($sellOffer===null) throw new CHttpException(404,'The requested sell offer could not be found.');
				
				// new buy offer form creation and submition…
				// create a buy offer for the "buy!" form
				$newBuyOffer = new BuyOffer('new');
				if (isset($_POST['BuyOffer'])) {
					$newBuyOffer->attributes = $_POST['BuyOffer'];
					// validate and register the buy offer
					if($newBuyOffer->validate() && $newBuyOffer->save(false)) {
						// success!!
						$nBOSuccess = true;
					}
				}
				
				// make the buyOfferList
				$buyOfferList = $this->_generateBuyOfferListForSellOffer($sellOffer);
				
				break;
			// if its not set, we're looking at all the sellOffers for a book
			case false:
				$sellOfferList = $this->_generateSellOfferListForBook($book);
				break;
			default: break;
		}
		
		
		$this->render('view', array(
			'book'=>$book, // must be set
			'sellOfferList'=>$sellOfferList, // set only if looking at all sell offers
			'sellOffer'=>$sellOffer, // set if looking at one sell offer
			'buyOfferForm'=>$newBuyOffer, // set if looking at one sell offer
			'buyOfferFormSuccess'=>$nBOSuccess, // set if looking at one sell offer
			'buyOfferList'=>$buyOfferList, // set if looking at one sell offer
		));
	}

	public function actionIndex()
	{
		$searchParams = new BrowseForm();
		$searchParams->unsetAttributes(); // remove default values… 
		$searchParams->searchInput = "Suggestions";
		
		// get my buy offers
		$myBuyOffers = $this->_generateMyBuyOffersList();
			
		$this->render('index',array(
			'searchResultList'=>$this->_generateBrowseBookList($searchParams),
			'searchParams'=>$searchParams, // so user can see what was searched
			'myBuyOffers'=>$myBuyOffers,
		));

	}

	public function actionMyoffers()
	{
		$this->render('myoffers');
	}


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
	
	/**
	 * _generateMyBuyOffersList gets all the buyOffers that belong to the logged in user.
	 * 
	 * @access private
	 * @return CActiveDataPRovider user's buyOffers
	 */
	private function _generateMyBuyOffersList() {
		$dataProvider = new CActiveDataProvider( 'BuyOffer' , array (
			'pagination' => array( 'pageSize' => 20, ),
			'criteria' => array( 
				'condition' => 'user_id = :userId', // where clause in sql statement
				'order' => 'num_notifications DESC',
				'params' => array(':userId'=>(int)Yii::app()->user->id),
			),
		));
		
		return $dataProvider;
	}
	
	/**
	 * _generateSellOfferListForBook generates a sell offer list for the given book.
	 * 
	 * conditions: SellOffers generated must be STATUS_OPEN and STATUS_NOT_CONFIRMMED
	 *
	 * @access private
	 * @param Book $book the book to generate sell offers for
	 * @return CArrayDataProvider containing the sell offer list
	 */
	private function _generateSellOfferListForBook($book) {
		$aSellOffers = $book->sellOffers(array('condition'=>'open='.SellOffer::STATUS_OPEN.' AND confirmed='.SellOffer::STATUS_NOT_CONFIRMED));
				
		return new CArrayDataProvider($aSellOffers, array(
			'pagination'=>array('pageSize'=>10),
			'keyField'=>'sell_offer_id',
			'sort'=>array(
				'attributes'=>array(
					'user_id', 'price', 'date',
				),
			),
		));
	}
	
	/**
	 * _generateBuyOfferListForSellOffer generates a buy offer list for the given sellOffer.
	 * 
	 *
	 * @access private
	 * @param SellOffer $sellOffer the selloffer to generate buy offers for
	 * @return CArrayDataProvider containing the buy offer list
	 */
	private function _generateBuyOfferListForSellOffer($sellOffer) {
		$aBuyOffers = $sellOffer->buyOffers;
		return new CArrayDataProvider($aBuyOffers, array(
			'pagination'=>array('pageSize'=>10),
			'keyField'=>'buy_offer_id',
			'sort'=>array(
				'attributes'=>array(
					'user_id', 'offered_price', //'date', todo
				),
			),
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
}