<?php

/**
 * This is the model class for table "{{buy_offer}}".
 *
 * The followings are the available columns in table '{{buy_offer}}':
 * @property integer $buy_offer_id
 * @property integer $user_id
 * @property integer $sell_offer_id
 * @property double $offered_price
 * @property string $notes
 * @property integer $accepted
 * @property integer $num_notifications
 *
 * The followings are the available model relations:
 * @property User $user
 * @property SellOffer $sellOffer
 * @property Comment[] $comments
 *
 *
 * TODO: We forgot to timestamp BUY OFFERS!!!! oh no oh no oh no
 *
 * The following are scenarios (used in data validation)
 * ■ new: only data needed to create a listing is required
 */
class BuyOffer extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return BuyOffer the static model class
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
		return '{{buy_offer}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sell_offer_id, offered_price, notes, num_notifications, user_id, accepted', 'required'),
			array('user_id, sell_offer_id, accepted, num_notifications', 'numerical', 'integerOnly'=>true),
			array('offered_price', 'numerical'),
			array('notes', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('buy_offer_id, user_id, sell_offer_id, offered_price, notes, accepted, num_notifications', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'sellOffer' => array(self::BELONGS_TO, 'SellOffer', 'sell_offer_id'),
			'comments' => array(self::HAS_MANY, 'Comment', 'buy_offer_id', 'index'=>'comment_id'), // so now, to get our comment of PK 15, we would say $this->comments[15], makes everything easy!
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'buy_offer_id' => 'Buy Offer ID',
			'user_id' => 'User ID',
			'sell_offer_id' => 'Sell Offer ID',
			'offered_price' => 'Offered Price',
			'notes' => 'Notes',
			'accepted' => 'Accepted',
			'num_notifications' => 'Num Notifications',
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

		$criteria->compare('buy_offer_id',$this->buy_offer_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('sell_offer_id',$this->sell_offer_id);
		$criteria->compare('offered_price',$this->offered_price);
		$criteria->compare('notes',$this->notes,true);
		$criteria->compare('accepted',$this->accepted);
		$criteria->compare('num_notifications',$this->num_notifications);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}