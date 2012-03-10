<?php

/**
 * This is the model class for table "{{user_rating}}".
 *
 * The followings are the available columns in table '{{user_rating}}':
 * @property integer $rated_user_id
 * @property integer $rating_user_id
 * @property integer $rating_id
 * @property string $title
 * @property string $text
 * @property integer $rating
 *
 * The followings are the available model relations:
 * @property User $ratedUser
 * @property User $ratingUser
 */
class UserRating extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return UserRating the static model class
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
		return '{{user_rating}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rated_user_id, rating_user_id', 'required'),
			array('rated_user_id, rating_user_id, rating', 'numerical', 'integerOnly'=>true),
			array('title, text', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('rated_user_id, rating_user_id, rating_id, title, text, rating', 'safe', 'on'=>'search'),
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
			'ratedUser' => array(self::BELONGS_TO, 'User', 'rated_user_id'),
			'ratingUser' => array(self::BELONGS_TO, 'User', 'rating_user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'rated_user_id' => 'Rated User',
			'rating_user_id' => 'Rating User',
			'rating_id' => 'Rating',
			'title' => 'Title',
			'text' => 'Text',
			'rating' => 'Rating',
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

		$criteria->compare('rated_user_id',$this->rated_user_id);
		$criteria->compare('rating_user_id',$this->rating_user_id);
		$criteria->compare('rating_id',$this->rating_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('rating',$this->rating);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}