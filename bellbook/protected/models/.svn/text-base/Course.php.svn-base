<?php

/**
 * This is the model class for table "{{course}}".
 *
 * The followings are the available columns in table '{{course}}':
 * @property integer $course_id
 * @property string $name
 * @property string $code
 * @property integer $year
 *
 * The followings are the available model relations:
 * @property Book[] $books
 * @property User[] $followingUsers
 * @property Instructor[] $myInstructors
 */
class Course extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Course the static model class
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
		return '{{course}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('year', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>60),
			array('code', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('course_id, name, code, year', 'safe', 'on'=>'search'),
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
			'books' => array(self::HAS_MANY, 'Book', 'course_id'),
			'followingUsers' => array(self::MANY_MANY, 'User', '{{followed_course_map}}(followed_id, user_id)'),
			'myInstructors' => array(self::MANY_MANY, 'Instructor', '{{nm_course_instructor_map}}(course_id, instructor_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'course_id' => 'Course',
			'name' => 'Name',
			'code' => 'Code',
			'year' => 'Year',
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

		$criteria->compare('course_id',$this->course_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('year',$this->year);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}