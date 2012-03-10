<?php
/**
 * BBLoggedInFrontendController is a customized base controller class for the frontend for the logged in user.
 * All controller classes for the frontend for logged in users should extend from this base class.
 *
 * It implements the general layout of the browsing/logged in interface.
 * It allows only logged inusers access - see the accessRules()
 *
 * @author Nano8Blazex(Vervious)(Bchan)
 */
class BBLoggedInFrontendController extends BBFrontendController
{
	/**
	 * @var string the default layout for the controller view.
	 */
	public $layout='//layouts/main';
	
	/**
	 * @var bool whether this controller is "logged in" or not at layout render time
	 */
	protected $loggedIn=true;
	
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array(
		"a"=> array(
			"label"=>"questions",
			"url"=>array('about'),
		),
	);
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	
	/**
	 * init the controller.
	 * 
	 * @access public
	 * @return void
	 */
	public function init() {
		parent::init();	
	
		/* establish the menu we will use */
		$this->htmlMenu = <<<VEV
	
	<ul id="menu">
		<li><a href="{$this->createUrl('questions/index')}">questions</a></li>
		<li id="profile">
			<a id="profile-link" href="{$this->createUrl('you/index')}">Vervious</a>
			<ul id="profile-nav">
				<li><a href="{$this->createUrl('you/index')}">My Profile</a></li>
				<li><a href="{$this->createUrl('you/settings')}">Transaction Settings</a></li>
				<li><a href="{$this->createUrl('sell/index')}">Sell A Book</a></li>
				<li><a href="{$this->createUrl('site/logout')}">Log Out</a></li>
			</ul>
		</li>
		<li><a id="title-logo" href="">BellBook</a></li>
	</ul>
	
VEV;
	}
	
	/**
	 * filters function - force access control filter (accessRules) to be applied to every action.
	 * 
	 * @access public
	 * @return void
	 */
	public function filters() {
		return array(
			'accessControl',
		);
	}
	
	/**
	 * accessRules function denies access to any action unless the user is authenticated (@).
	 * 
	 * @access public
	 * @return void
	 */
	public function accessRules() {
		return array(
			array('allow', 'actions'=>array(), 'users'=>array('@')),
			array('deny',   // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// do stuff that's not the main content?
	}
}