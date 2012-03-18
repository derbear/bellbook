<?php

/**
 * QuestionsController class.
 * 
 * @extends BBFrontendController
 */
class QuestionsController extends BBFrontendController
{

	public $defaultAction = 'welcome';
	
	public function init() {
		parent::init();
		
		$linka =  CHtml::link(CHtml::encode("Welcome"), array('questions/welcome'),
			array('class'=>'selected'));
		$linkb =  CHtml::link(CHtml::encode("About"), array('questions/about'),
			array('class'=>''));
		$linkc =  CHtml::link(CHtml::encode("Support"), array('questions/support'),
			array('class'=>''));
			
		$this->htmlOptions = <<<VEV
	<div class="page-options">
		Navigate: <ul>
		<li>$linka</li>
		<li>$linkb</li>
		<li>$linkc</li>
		</ul>
	</div>
VEV;
	}
	
	public function actionAbout()
	{
		// we're also hiring!
		$this->render('about');
	}

	public function actionSupport()
	{
		$this->render('support');
	}

	public function actionWelcome()
	{
		$this->render('welcome');
	}
	
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
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