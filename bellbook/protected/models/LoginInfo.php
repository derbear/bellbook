<?php

/**
 * This is the model class for table "{{login_info}}".
 *
 * The followings are the available columns in table '{{login_info}}':
 * @property string $password
 * @property integer $user_id
 *
 * The followings are the available model relations:
 * @property User $user
 */
class LoginInfo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return LoginInfo the static model class
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
		return '{{login_info}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('password', 'required'),
			array('password', 'length', 'max'=>255),
			//array('user_id', 'exist', 'allowEmpty'=>false, 'className'=>'User'), (foreign keys do not have to be defined on validation…)
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('password', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'password' => 'Password',
			'user_id' => 'User ID',
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

		$criteria->compare('password',$this->password,true);
		$criteria->compare('user_id',$this->user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * beforeSave - make sure the fk exists in User before save.
	 * 
	 * @access protected
	 * @return void
	 */
	protected function beforeSave() {
		$validates = true;
		$existValidator = CValidator::createValidator('exist', $this, 'user_id', array(
			'allowEmpty'=>false,
			'className'=>'User',
			'message'=>'Internal Error: Password could not be saved.',
		));
		$existValidator->validate($this);
		if ($this->hasErrors()) {
			$validates = false;
		}
		return parent::beforeSave() && $validates;
	}
}