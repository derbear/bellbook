<?php

/**
 * UserIdentity represents the data needed to identity a user.
 *
 * It contains the authentication method that checks if the provided
 * data can identity the user. To authenticate, you do something like
 * $identity = new UserIdentity($username,$password);
 * if($identity->authenticate()) 
 * 		Yii::app()->user->login($identity);
 * basically, the user is already precreated by Yii, accessible by
 * Yii:app()->user, you just have to use code to log the user in/out
 */
class UserIdentity extends CUserIdentity
{
	
	/**
	 * _id | user_id of User | - our private id for the current site user identity - 
	 * 
	 * meant to override returning the username/studentid as the unique id
	 * @var mixed
	 * @access private
	 */
	private $_id, $_displayName;
	
	/**
	 * Authenticates a user against User model
	 * @return boolean whether authentication succeeds.
	 */
    public function authenticate()
    {
    	// here, we treat the studentID as the username built into CUserIdentity
        $username = strtolower($this->username);
        $user=User::model()->find('LOWER(student_id)=?', array($username));
        
        if($user===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if(!$user->validatePassword($this->password)) //visit the User model class to see validation method
        	// once again using the built in password function of CUserIdentity
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else
        {
        	// successfully validated
            $this->_id=$user->user_id; //set our id to the user's primary key (instead of default username). Why? No real reason.
            $this->_displayName = $user->first_name; //display name should be our first name, and not our username
            $this->errorCode=self::ERROR_NONE;
        }
        return $this->errorCode==self::ERROR_NONE;
    }
 
    public function getId()
    {
        return $this->_id;
    }
    
    public function getName()
    {
    	if ($this->_displayName) return $this->_displayName;
    	else return $this->username;
    }
}