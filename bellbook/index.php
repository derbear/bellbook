<?php


/**
 * Coding/Security guidelines
 * 
 * validate ALL user input whether from POST or GET (using Model filters… and stuff)
 * Escape all printed stuff
 *    - plain text
 *			striptags($plaintext) | not secure on its own so use encode() as well
 *			CHtml::encode($plaintext) | basically a wrapper for htmlspecialchars()
 *	  - rich text
 *	  		HTML purifier is incorporated into Yii | 
 *	  		http://www.yiiframework.com/doc/guide/1.1/en/topics.security#cross-site-scripting-prevention
 * SQL Injections
 *	  - use Yii's provided functions instead of raw SQL
 *			for instance, Model:model()->findByPk((int)$_GET['id'])->delete();
 *	  - use Yii's prepared statement
 *
 * PLEASE READ http://www.yiiframework.com/wiki/275/how-to-write-secure-yii-applications/
 */
 
 
/**
 * Design guidelines
 * 
 * DO NOT DUPLICATE CODE. Don't Repeat Yourself.
 * "Every piece of knowledge must have a single, unambiguous, authoritative representation
 * within a system."
 *     -meaning, if you change something, you don't have to change it anywhere else.
 */
 
 
 
// change the following paths if necessary
$yii=dirname(__FILE__).'/../YiiRoot/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
Yii::createWebApplication($config)->run();
