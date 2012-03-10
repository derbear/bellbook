<?php

/**
 * This is the model class for table "{{book}}".
 *
 * The followings are the available columns in table '{{book}}':
 * @property integer $book_id
 * @property string $title
 * @property integer $course_id
 * @property string $ISBN (13 - 10 is being phased out)
 * @property string $author_firstname
 * @property string $author_lastname
 * @property string $publisher
 * @property integer $year_published
 * @property string $place_published
 * @property string $other_data
 * @property string $image_url
 *
 * The followings are the available model relations:
 * @property Course $course
 * @property User[] $followingUsers
 * @property SellOffer[] $sellOffers
 *
 *
 * The following are scenarios (used in data validation)
 * ■ reference: only information necessary is the info needed to identify this book from other books
 * ■ new: all information required to create the book is necessary
 */
class Book extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Book the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{book}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs. Default is to deny modification unless deemed safe.
		return array(
			array('ISBN', 'isbn', 'on'=>'new'),
			array('ISBN', 'unique', 'message'=>'This book has already been registered in our database. It should be listed in the list above!', 'on'=>'new'), //new books must be unique since… we don't want duplicate books in the database, that would be terribly annoying. ISBN is the perfect book identifier.
			array('book_id', 'numerical', 'integerOnly'=>true, 'allowEmpty'=>false, 'on'=>'reference'),
			array('book_id', 'exist', 'on'=>'reference'),
			array('ISBN, title, author_firstname, author_lastname, publisher, year_published', 'required', 'on'=>'new'),
			array('course_id, year_published', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('ISBN, place_published, other_data', 'length', 'max'=>45),
			array('author_firstname, author_lastname', 'length', 'max'=>60),
			array('publisher', 'length', 'max'=>128),
			array('image_url', 'url'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('title, course_id, ISBN, author_firstname, author_lastname, publisher, year_published, place_published', 'safe', 'on'=>'search'),
		);
	}
	
	/**
	 * isbn makes sure the given number is an ISBN number.
	 *
	 * If the given attribute is a valid isbn 10 number, then it converts it into 13 digits.
	 * Also formats the isbn correctly for storage.
	 * 
	 * @access public
	 * @param mixed $attribute
	 * @param mixed $params
	 * @return void
	 */
	public function isbn($attribute, $params) {
		$success = true;
		$additionalErrors = "";
		
		// format the isbn first - remove everything except digits and X and x
		$this->$attribute = preg_replace("/[^0-9Xx]/", "", $this->$attribute);
		
		// convert it to isbn13 if needed
		$isbnLength = strlen($this->$attribute);
		switch ($isbnLength) {
			case 13:
				break;
			case 10:
				$this->$attribute = Book::convertIsbn($this->$attribute);
				break;
			default:
				$additionalErrors = "Invalid Length - must be 10 or 13 digits.";
				$success = false;
				break;
		}
		
		$isbn13 = $this->$attribute;
		if ($success) { // we now have a isbn 13 to validate!
			$check = 0;
			for ($i = 0; $i < 13; $i+=2) $check += substr($isbn13, $i, 1);
			for ($i = 1; $i < 12; $i+=2) $check += 3 * substr($isbn13, $i, 1);
			$success = ( $check % 10 == 0 );
			if (!$success) $additionalErrors = " Please double check your input.";
		}

        if (!$success) {
       		$this->addError($attribute, 'Not a valid '.$this->getAttributeLabel($attribute).'.'.$additionalErrors);
        }
	}
	
	/**
	 * convertIsbn converts the given ISBN to the other type.
	 * 
	 * ISBN must be properly formatted for this function to work properly. It must be 
	 * entirely digits (no spaces or symbols) and a string. Unexpected results will occur
	 * otherwise.
	 * If ISBN 10 is passwed in, return ISBN 13. If ISBN 13 is argument, return ISBN 10.
	 * Does not validate. If invalid isbn (length) passed in, throws exception. This function
	 * WILL MALFUNCTION for ISBN 13s with 979s in front.
	 *
	 * @access public
	 * @static
	 * @param string $givenIsbn either a isbn 10 or 13, properly formatted, see above
	 * @return string result
	 */
	public static function convertIsbn($givenIsbn) {
		$isbn = "";
		switch(strlen($givenIsbn))  {
			case 10:
				$isbn = substr( $givenIsbn, 0, -1 );
				$weightedSum = 3 * ($isbn{0}+$isbn{2}+$isbn{4}+$isbn{6}+$isbn{8}) + $isbn{1} + $isbn{3} + $isbn{5} + $isbn{7} + 38; // 38 is the checksum for the 978 prefix
				$checkSum = ( 10 - ( $weightedSum % 10 ) ) % 10; // calculate checksum
				// all isbn 10s have 978 isbn13 equivalent
				$isbn = '978' . $isbn . $checkSum;
				break;
			case 13:
				// note that isbn 13s with 979+ have no isbn 10 equivalent, so will fail
				$isbn = substr($givenIsbn, 3, 9);
				$checksum = 0;
				$weight = 10;
				$aIsbnCharacters = str_split($isbn);
				foreach ( $aIsbnCharacters as $char ) {
					$checksum += $char * $weight;
					$weight--;
				}
				$checksum = 11 - ($checksum % 11);
				if ( $checksum == 10 ) $checksum = "X";
				else if ( $checksum == 11 ) $checksum = "0";
				$isbn .= $checksum;
				
				break;
			default: throw new CException('Inconvertible ISBN, wrong length.');
				break;
		}
		return $isbn;
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'course' => array(self::BELONGS_TO, 'Course', 'course_id'),
			'followingUsers' => array(self::MANY_MANY, 'User', '{{followed_book_map}}(followed_id, user_id)'),
			'sellOffers' => array(self::HAS_MANY, 'SellOffer', 'book_id', 'index'=>'sell_offer_id'), //so sellOffers[0] becomes the sell offer w/ pk 0 that we have
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'book_id' => 'Book ID',
			'title' => 'Title',
			'course_id' => 'Course',
			'ISBN' => 'ISBN',
			'author_firstname' => 'Author Firstname',
			'author_lastname' => 'Author Lastname',
			'publisher' => 'Publisher',
			'year_published' => 'Year Published',
			'place_published' => 'Place Published',
			'other_data' => 'Other Data',
			'image_url' => 'Image Url',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		
		// load relations
		$criteria->with = array(
			'sellOffers',
			'course',
		);
		
		// generate WHERE clauses
		//$criteria->compare('book_id',$this->book_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('course_id',$this->course_id);
		$criteria->compare('ISBN',$this->ISBN,true);
		$criteria->compare('author_firstname',$this->author_firstname,true);
		$criteria->compare('author_lastname',$this->author_lastname,true);
		$criteria->compare('publisher',$this->publisher,true);
		$criteria->compare('year_published',$this->year_published);
		$criteria->compare('place_published',$this->place_published,true);
		//$criteria->compare('other_data',$this->other_data,true);
		//$criteria->compare('image_url',$this->image_url,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize' => 20,),
		));
	}
	
	/* getters and setters */
	
	/**
	 * getIsbn13 gets this book's isbn 10 if there is an equivalent.
	 * 
	 * Probably won't be used much, as isbn 13s are much faster to search and stuff 
	 * because we store it (instead of calculating it every time like ths isbn10). If there is
	 * no equivalent (e.g. the ISBN 13 has 979 in front) this function will malfunction.
	 *
	 * @access public
	 * @return string isbn10
	 */
	public function getIsbn10() {
		return Book::convertIsbn($this->isbn);
	}
}