<?php

/**
 * This is the model class for table "{{sell_offer}}".
 *
 * The followings are the available columns in table '{{sell_offer}}':
 * @property integer $sell_offer_id
 * @property integer $user_id
 * @property integer $book_id
 * @property string $description
 * @property integer $bargainable
 * @property integer $open
 * @property double $price
 * @property date $date //last modified date - local time. timezones not yet supported
 * @property string $pickup
 * @property integer $confirmed // if transaction is confirmed(completed)
 * @property integer $num_notifications
 * @property string $image_url
 *
 * The followings are the available model relations:
 * @property BuyOffer[] $buyOffers
 * @property User $user
 * @property Book $book
 * 
 * The following are scenarios (used in data validation)
 * ■ new: only data needed to create a listing is required
 */
class SellOffer extends CActiveRecord
{
	// for use with @property $open
	const STATUS_OPEN = 1;
	const STATUS_CLOSED = 0;
	
	// for use with @property $confirmed
	const STATUS_NOT_CONFIRMED = 0;
	const STATUS_CONFIRMED = 1;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return SellOffer the static model class
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
		return '{{sell_offer}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, book_id, date, bargainable, open, price, pickup, confirmed', 'required'),
			array('description, image_url', 'required', 'on'=>'new'),
			array('user_id, book_id, open, confirmed, num_notifications', 'numerical', 'integerOnly'=>true),
			array('bargainable', 'boolean'),
			array('price', 'numerical'),
			array('pickup', 'length', 'max'=>45),
			array('description, image_url', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('sell_offer_id, user_id, book_id, description, bargainable, open, price, date, pickup, confirmed, num_notifications, image_url', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'buyOffers' => array(self::HAS_MANY, 'BuyOffer', 'sell_offer_id', 'index'=>'buy_offer_id'), //in buyOffers[], the keys will be the pks of the corresponding buyOffer, making everything nice and easy
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'book' => array(self::BELONGS_TO, 'Book', 'book_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'sell_offer_id' => 'Sell Offer ID',
			'user_id' => 'User ID',
			'book_id' => 'Book ID',
			'description' => 'Description',
			'bargainable' => 'Bargainable',
			'open' => 'Open',
			'price' => 'Price',
			'date' => 'Date',
			'pickup' => 'How To Pickup',
			'confirmed' => 'Confirmed',
			'num_notifications' => 'Number Of Notifications',
			'image_url' => 'Image URL',
		);
	}
	
	
	/**
	 * beforeValidate autoset the timestamp to NOW().
	 * 
	 * @access public
	 * @return bool validates
	 */
	public function beforeValidate() {
		$this->date = new CDbExpression('NOW()');
		return parent::beforeValidate();
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

		$criteria->compare('sell_offer_id',$this->sell_offer_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('book_id',$this->book_id);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('bargainable',$this->bargainable);
		$criteria->compare('open',$this->open);
		$criteria->compare('price',$this->price);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('pickup',$this->pickup,true);
		$criteria->compare('confirmed',$this->confirmed);
		$criteria->compare('num_notifications',$this->num_notifications);
		$criteria->compare('image_url',$this->image_url,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}