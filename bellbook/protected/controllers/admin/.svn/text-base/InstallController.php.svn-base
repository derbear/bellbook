<?php
/**
 * Admin/Install Controller (see BBAdminController) 
 *
 * This controller coordinates admin activities See the corresponding mySQL Workbench file/diagram in the branch/diagram section
 * for a more comprehensive understanding of the database.
 *
 * 
 * Tables
 * --user--					represents the user of the website, profile info
 * --course--				represents a course, which organizes books, mainly for organizational purposese
 * --book--					represents a book, with isbn and everything
 * --sell_offer--			represents an offer to sell a book, "my books", tied to user and much more, see diagrams
 * --buy_offer--				represents a response to a sell_offer - an offer to buy a book, known as "offers"
 * --setting--				represents a user's settings, 1:1 relationship to user
 * --login_info--			represents user's login information, 1:1 to user, for security is separate
 * --instructor--			represents an instructor. Doesn't do much right now, other than being tied to course n:m
 * --nm_course_instructor_map--	forms the n:m relationship between instructor and course
 * --followed_user_map-- 	represents/maps the "friends" of a user, for book suggestions
 * --followed_course_map--	represents/maps the courses a user is interested in, for suggestions
 * --followed_book_map--		represents/maps the books a user is interested in, for book suggestions
 * --user_rating--			represents a rating/comment a user makes on another user's profile. Integral part of the
 *	 						user rating system.
 * 
 * TODO: make the dropping of tables more efficient. Error catching is also… malfunctionaing.
 * 
 * @package BLLBBackend
 * @author Nano8Blazex(bchan)
 * @version 1.0
 * @abstract
 * @copyright BellBook 2011
 */
 

class InstallController extends BBAdminController
{
	/**
	 * main action that's usually the one that's executed.
	 *
	 * The function (re)installs the database, and renders the view that gets shown to screen.
	 * 
	 * @access public
	 */
	public function actionIndex()
	{
		parent::actionIndex();
		$errorMessages = $this->blbInstall();
		$this->render('index', array('resultMessages'=>$errorMessages));
	}
	
	/**
	 * blbInstall installs the database.
	 * 
	 * @access private
	 * @return array array of error message strings resulting from the function
	 */
	private function blbInstall()
	{
		$dbConnection = Yii::app()->db;
		$errorMessages = array();
		
		$errorMessages[] = $this->blbPrepareStatements($dbConnection);
		// TODO: Get rid of this temporary work around. Because of constraints the tables can't be dropped all at once, so we just call the function three times. Errors should come up every time but they don't so that's also a TODO.
		$errorMessages[] = $this->blbDeleteTables($dbConnection);
		$errorMessages[] = $this->blbDeleteTables($dbConnection);
		$errorMessages[] = $this->blbDeleteTables($dbConnection);
		$errorMessages[] = $this->blbCreateTables($dbConnection);
		$errorMessages[] = $this->blbFinalStatements($dbConnection);
			
		return $errorMessages;
	}
	
	/**
	 * prepares database for install by disabling constraints .
	 * 
	 * @access private
	 * @param mixed $dbConnection
	 * @return string error message/result
	 */
	private function blbPrepareStatements($dbConnection) {
		/* disable all constraints before trying to create/delete tables */
		
		$errorMessage = "";
		$sqlStatement = <<<N8B
		
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

N8B;
	
		try {
			$dbInstallCommand = $dbConnection->createCommand($sqlStatement);
			$dbInstallCommand->execute(); //exception is raised if query fails
			
			$errorMessage = "Database Configuration Successful.";
		} 
		catch (Exception $e) {
			$errorMessage = "Database could not be properly prepared.";
		}
		
		return $errorMessage;
	}
	
	/**
	 * removes all constraints to finish using databse.
	 * 
	 * @access private
	 * @param mixed $dbConnection
	 * @return string error message/result
	 */
	private function blbFinalStatements($dbConnection) {
		/* reenable all constraints after trying to create/delete tables */
		
		$errorMessage = "";
		$sqlStatement = <<<N8B
		
SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

N8B;
	
		try {
			$dbInstallCommand = $dbConnection->createCommand($sqlStatement);
			$dbInstallCommand->execute(); //exception is raised if query fails
			
			$errorMessage = "Database Cleanup Successful.";
		} 
		catch (Exception $e) {
			$errorMessage = "Database could not be properly configured.";
		}
		
		return $errorMessage;
	}

	
	/**
	 * creates database tables
	 * 
	 * @access private
	 * @param mixed $dbConnection
	 * @return string error message/result
	 */
	private function blbCreateTables($dbConnection) {
		
		$errorMessage = "";
		$aStatements = array(		
<<<N8B

CREATE  TABLE IF NOT EXISTS {{user}} (
  `user_id` INT NOT NULL AUTO_INCREMENT ,
  `first_name` VARCHAR(60) NOT NULL ,
  `last_name` VARCHAR(60) NOT NULL ,
  `email` VARCHAR(255) NOT NULL ,
  `grad_yr` SMALLINT NULL ,
  `trustworthiness_rating` TINYINT NULL ,
  `last_online` DATE NULL ,
  `student_id` VARCHAR(60) NOT NULL ,
  `image_url` TEXT NULL ,
  PRIMARY KEY (`user_id`) ,
  INDEX `grad_yr` (`grad_yr` ASC) ,
  INDEX `last_name` (`last_name` ASC) ,
  INDEX `trustworthiness` (`trustworthiness_rating` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

N8B
,

<<<N8B

CREATE  TABLE IF NOT EXISTS {{course}} (
  `course_id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(60) NOT NULL ,
  `code` VARCHAR(45) NULL ,
  `year` SMALLINT NULL ,
  PRIMARY KEY (`course_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

N8B
,

<<<N8B

CREATE  TABLE IF NOT EXISTS {{book}} (
  `book_id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(255) NULL ,
  `course_id` INT NULL ,
  `ISBN` VARCHAR(45) NULL ,
  `author_firstname` VARCHAR(60) NULL ,
  `author_lastname` VARCHAR(60) NULL ,
  `publisher` VARCHAR(128) NULL ,
  `year_published` SMALLINT NULL ,
  `place_published` VARCHAR(45) NULL ,
  `other_data` VARCHAR(45) NULL ,
  `image_url` TEXT NULL ,
  PRIMARY KEY (`book_id`) ,
  INDEX `fk_book_course` (`course_id` ASC) ,
  INDEX `isbn` (`ISBN` ASC) ,
  CONSTRAINT `fk_book_course`
    FOREIGN KEY (`course_id` )
    REFERENCES {{course}} (`course_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

N8B
,

<<<N8B

CREATE  TABLE IF NOT EXISTS {{sell_offer}} (
  `sell_offer_id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` INT NOT NULL ,
  `book_id` INT NOT NULL ,
  `description` TEXT NULL ,
  `bargainable` TINYINT(1)  NOT NULL ,
  `open` TINYINT(1)  NOT NULL ,
  `price` FLOAT(99,2) NOT NULL ,
  `date` DATETIME NOT NULL ,
  `pickup` VARCHAR(45) NOT NULL ,
  `confirmed` TINYINT(1)  NOT NULL ,
  `num_notifications` SMALLINT NULL ,
  `image_url` TEXT NULL ,
  PRIMARY KEY (`sell_offer_id`) ,
  INDEX `fk_sell_offer_user` (`user_id` ASC) ,
  INDEX `fk_sell_offer_book` (`book_id` ASC) ,
  INDEX `open` (`open` ASC) ,
  CONSTRAINT `fk_sell_offer_user`
    FOREIGN KEY (`user_id` )
    REFERENCES {{user}} (`user_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sell_offer_book`
    FOREIGN KEY (`book_id` )
    REFERENCES {{book}} (`book_id` )
    ON DELETE RESTRICT
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

N8B
,

<<<N8B

CREATE  TABLE IF NOT EXISTS {{buy_offer}} (
  `buy_offer_id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` INT NOT NULL ,
  `sell_offer_id` INT NULL ,
  `offered_price` FLOAT(99,2) NULL ,
  `notes` TEXT NULL ,
  `accepted` TINYINT(1)  NOT NULL ,
  `num_notifications` SMALLINT NULL ,
  PRIMARY KEY (`buy_offer_id`) ,
  INDEX `fk_buy_offer_user` (`user_id` ASC) ,
  INDEX `fk_buy_offer_sell_offer` (`sell_offer_id` ASC) ,
  CONSTRAINT `fk_buy_offer_user`
    FOREIGN KEY (`user_id` )
    REFERENCES {{user}} (`user_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_buy_offer_sell_offer`
    FOREIGN KEY (`sell_offer_id` )
    REFERENCES {{sell_offer}} (`sell_offer_id` )
    ON DELETE SET NULL
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

N8B
,

<<<N8B

CREATE  TABLE IF NOT EXISTS {{setting}} (
  `should_email_notifs` TINYINT(1)  NULL ,
  `user_id` INT NOT NULL ,
  PRIMARY KEY (`user_id`) ,
  INDEX `fk_setting_user` (`user_id` ASC) ,
  CONSTRAINT `fk_setting_user1`
    FOREIGN KEY (`user_id` )
    REFERENCES {{user}} (`user_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

N8B
,

<<<N8B

CREATE  TABLE IF NOT EXISTS {{login_info}} (
  `password` VARCHAR(255) NOT NULL ,
  `user_id` INT NOT NULL ,
  PRIMARY KEY (`user_id`) ,
  INDEX `fk_login_info_user` (`user_id` ASC) ,
  CONSTRAINT `fk_login_info_user`
    FOREIGN KEY (`user_id` )
    REFERENCES {{user}} (`user_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

N8B
,

<<<N8B

CREATE  TABLE IF NOT EXISTS {{instructor}} (
  `instructor_id` INT NOT NULL AUTO_INCREMENT ,
  `first_name` VARCHAR(60) NOT NULL ,
  `last_name` VARCHAR(60) NOT NULL ,
  PRIMARY KEY (`instructor_id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

N8B
,

<<<N8B

CREATE  TABLE IF NOT EXISTS {{nm_course_instructor_map}} (
  `course_id` INT NOT NULL ,
  `instructor_id` INT NOT NULL ,
  PRIMARY KEY (`course_id`, `instructor_id`) ,
  INDEX `fk_course` (`course_id` ASC) ,
  INDEX `fk_instructor` (`instructor_id` ASC) ,
  CONSTRAINT `fk_course`
    FOREIGN KEY (`course_id` )
    REFERENCES {{course}} (`course_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_instructor`
    FOREIGN KEY (`instructor_id` )
    REFERENCES {{instructor}} (`instructor_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

N8B
,

<<<N8B

CREATE  TABLE IF NOT EXISTS {{followed_user_map}} (
  `user_id` INT NOT NULL ,
  `followed_id` INT NOT NULL ,
  INDEX `fk_user_follower` (`user_id` ASC) ,
  PRIMARY KEY (`followed_id`, `user_id`) ,
  INDEX `fk_followed_user` (`followed_id` ASC) ,
  CONSTRAINT `fk_user_follower`
    FOREIGN KEY (`user_id` )
    REFERENCES {{user}} (`user_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_followed_user`
    FOREIGN KEY (`followed_id` )
    REFERENCES {{user}} (`user_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

N8B
,

<<<N8B

CREATE  TABLE IF NOT EXISTS {{comment}} (
  `comment_id` INT NOT NULL AUTO_INCREMENT ,
  `buy_offer_id` INT NOT NULL ,
  `text` TEXT NOT NULL ,
  `user_id` INT NULL ,
  `date` DATETIME NULL ,
  PRIMARY KEY (`comment_id`, `buy_offer_id`) ,
  INDEX `fk_comment_buy_offer` (`buy_offer_id` ASC) ,
  INDEX `fk_comment_user` (`user_id` ASC) ,
  CONSTRAINT `fk_comment_buy_offer`
    FOREIGN KEY (`buy_offer_id` )
    REFERENCES {{buy_offer}} (`buy_offer_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comment_user`
    FOREIGN KEY (`user_id` )
    REFERENCES {{user}} (`user_id` )
    ON DELETE SET NULL
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


N8B
,

<<<N8B

CREATE  TABLE IF NOT EXISTS {{followed_course_map}} (
  `user_id` INT NOT NULL ,
  `followed_id` INT NOT NULL ,
  INDEX `fk_course_follower` (`user_id` ASC) ,
  PRIMARY KEY (`followed_id`, `user_id`) ,
  INDEX `fk_followed_course` (`followed_id` ASC) ,
  CONSTRAINT `fk_course_follower`
    FOREIGN KEY (`user_id` )
    REFERENCES {{user}} (`user_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_followed_course`
    FOREIGN KEY (`followed_id` )
    REFERENCES {{course}} (`course_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

N8B
,

<<<N8B

CREATE  TABLE IF NOT EXISTS {{followed_book_map}} (
  `user_id` INT NOT NULL ,
  `followed_id` INT NOT NULL ,
  INDEX `fk_book_follower` (`user_id` ASC) ,
  PRIMARY KEY (`followed_id`, `user_id`) ,
  INDEX `fk_followed_book` (`followed_id` ASC) ,
  CONSTRAINT `fk_book_follower`
    FOREIGN KEY (`user_id` )
    REFERENCES {{user}} (`user_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_followed_book`
    FOREIGN KEY (`followed_id` )
    REFERENCES {{book}} (`book_id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

N8B
,

<<<N8B

CREATE  TABLE IF NOT EXISTS {{user_rating}} (
  `rated_user_id` INT NOT NULL ,
  `rating_user_id` INT NOT NULL ,
  `rating_id` INT NOT NULL AUTO_INCREMENT ,
  `title` TEXT NULL ,
  `text` TEXT NULL ,
  `rating` TINYINT NULL ,
  INDEX `fk_rated_user` (`rated_user_id` ASC) ,
  INDEX `fk_rating_user` (`rating_user_id` ASC) ,
  PRIMARY KEY (`rating_id`) ,
  CONSTRAINT `fk_rated_user`
    FOREIGN KEY (`rated_user_id` )
    REFERENCES {{user}} (`user_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_rating_user`
    FOREIGN KEY (`rating_user_id` )
    REFERENCES {{user}} (`user_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

N8B

		);
	
		try {
			// create new tables
			foreach ($aStatements as $sqlStatement) {				
				$dbInstallCommand = $dbConnection->createCommand($sqlStatement);
				$dbInstallCommand->execute(); //exception is raised if query fails, auto exits
			}			
			$errorMessage = "Database Creation Successful.";			
		} 
		catch (Exception $e) {
			$errorMessage = "Database could not be properly created.";
		}
		
		return $errorMessage;
	}
	
	/**
	 * drops all relevant database tables
	 * 
	 * @access private
	 * @param mixed $dbConnection
	 * @return string error message/result
	 */
	private function blbDeleteTables($dbConnection) {
		
		$errorMessage = "";
		$aStatements = array(
							"DROP TABLE IF EXISTS {{user_rating}}", 
							"DROP TABLE IF EXISTS {{followed_course_map}}",
							"DROP TABLE IF EXISTS {{comment}}",
							"DROP TABLE IF EXISTS {{followed_user_map}}",
							"DROP TABLE IF EXISTS {{nm_course_instructor_map}}",
							"DROP TABLE IF EXISTS {{instructor}}",
							"DROP TABLE IF EXISTS {{setting}}",
							"DROP TABLE IF EXISTS {{buy_offer}}",
							"DROP TABLE IF EXISTS {{sell_offer}}",
							"DROP TABLE IF EXISTS {{book}}",
							"DROP TABLE IF EXISTS {{course}}",
							"DROP TABLE IF EXISTS {{user}}"
							);
	
		try {
			// delete conflicting tables - could also use CDbCommand's delete() and create(), but whatever
			foreach ($aStatements as $sqlStatement) {
				$dbInstallCommand = $dbConnection->createCommand($sqlStatement);
				$dbInstallCommand->execute(); //exception is raised if query fails
			}			
			$errorMessage = "Database Destruction Successful.";
		} 
		catch (Exception $e) {
			$errorMessage = "Database could not be properly destroyed.";
		}
		
		return $errorMessage;

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