<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property integer $grad_yr
 * @property integer $trustworthiness_rating
 * @property string $last_online
 * @property string $student_id
 * @property string $image_url
 *
 * The followings are the available model relations:
 * @property BuyOffer[] $buyOffers
 * @property Comment[] $comments
 * @property Book[] $followedBooks
 * @property Course[] $followedCourses
 * @property FollowedUserMap[] $followedUsers
 * @property LoginInfo $loginInfo
 * @property SellOffer[] $sellOffers
 * @property Setting $setting
 * @property UserRating[] $othersRatingsOfMe
 * @property UserRating[] $myRatingsOfOthers
 *
 * The following are scenarios (used in data validation)
 * ■ login: only information needed is login information
 * ■ register: all information about the user is required (like grad_yr and email)
 * ■ profile: unused
 *
 */
class User extends CActiveRecord
{	
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
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
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('student_id', 'unique', 'on'=>'register', 'message'=>'You\'ve already registered with this student ID!'), //each user should and can only register once
			array('first_name, last_name, email, student_id, grad_yr', 'required', 'on'=>'register'),
			array('email', 'email'),
			array('student_id', 'required', 'on'=>'login'),
			array('grad_yr, trustworthiness_rating', 'numerical', 'integerOnly'=>true),
			array('first_name, last_name, student_id', 'length', 'max'=>60),
			array('email', 'length', 'max'=>255),
			array('last_online, image_url', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('first_name, last_name, email, grad_yr, trustworthiness_rating, student_id', 'safe', 'on'=>'search'),
		);
	}
	
	// Yii already has one of these, called "unique", so let's discard my version
	/**
	 * adds an error if there is a duplicate of the specified attribute
	 *
	 * @param string the name of the attribute to be validated
	 * @param array options specified in the validation rule
	 */
	/*
	public function noDuplicate($attribute, $params) {
		// check for duplicate users
		$username = strtolower($this->$attribute); // the "new" username
        if( User::model()->find("LOWER($attribute)=?", array($username)) !== null) {
        	$this->addError($attribute, $this->getAttributeLabel($attribute) . ' already in use.');
        }
	}
	*/

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'buyOffers' => array(self::HAS_MANY, 'BuyOffer', 'user_id'),
			'comments' => array(self::HAS_MANY, 'Comment', 'user_id'),
			'followedBooks' => array(self::MANY_MANY, 'Book', '{{followed_book_map}}(user_id, followed_id)'),
			'followedCourses' => array(self::MANY_MANY, 'Course', '{{followed_course_map}}(user_id, followed_id)'),
			'followedUsers' => array(self::MANY_MANY, 'User', '{{followed_user_map}}(user_id, followed_id)'),
			'loginInfo' => array(self::HAS_ONE, 'LoginInfo', 'user_id'),
			'sellOffers' => array(self::HAS_MANY, 'SellOffer', 'user_id'),
			'setting' => array(self::HAS_ONE, 'Setting', 'user_id'),
			'othersRatingsOfMe' => array(self::HAS_MANY, 'UserRating', 'rated_user_id'),
			'myRatingsOfOthers' => array(self::HAS_MANY, 'UserRating', 'rating_user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User ID',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'email' => 'Email',
			'grad_yr' => 'Grad Yr',
			'trustworthiness_rating' => 'Trustworthiness Rating',
			'last_online' => 'Last Online',
			'student_id' => 'Student ID',
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

		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('grad_yr',$this->grad_yr);
		$criteria->compare('trustworthiness_rating',$this->trustworthiness_rating);
		$criteria->compare('student_id',$this->student_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * getPassword function retrieves the password (which is stored in a separate table).
	 * 
	 * the sepratae table is "LoginInfo"
	 * @access public
	 * @return string
	 */
	public function getPassword() {
		$loginInfo = $this->loginInfo; //get corresponding loginInfo object
		if (!$loginInfo) return NULL;
		return $loginInfo->password;
	}
	
	/**
	 * validatePassword function returns whether the password given validates for this user
	 * 
	 * @access public
	 * @param mixed $password
	 * @return BOOl
	 */
	public function validatePassword($password)
	{
		return $this->hashPassword($password)===$this->getPassword();
	}
	
	/**
	 * hashPassword returns hashed password for storage… Sooner or later a more secure
	 * solution should be implemented
	 * 
	 * @access public
	 * @param mixed $password
	 * @return void
	 */
	public function hashPassword($password) {
		return crypt($password, 'dontkillthefrogs');
	}
	
	/**
	 * authenticateSelfAndLogin function logs in the supplied User Model (whether saved or not).
	 *
	 * Note that user is default logged in for 30 days, we should cange this later.
	 * 
	 * @access public
	 * @static
	 * @param mixed $user
	 * @return bool if successful
	 */
	public function authenticateSelfAndLogin() {
	
		// authenticate the user
		$identity = new UserIdentity($this->student_id, $this->getPassword());
		$identity->authenticate();
		
		// tell application user should now be logged in
		if($identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=3600*24*30; // 30 days duration
			Yii::app()->user->login($identity,$duration);
			return true;
		}
		else {
			$this->loginInfo->addError('password','Incorrect student ID or password.');
			return false;
		}
	}
	
	
	
}