<?php
/**
 * BBFrontendController is a customized base controller class for the frontend.
 * All controller classes for the frontend should extend from this base class (usually indirectly, through
 * BBLoggedInFrontEndController or BBUnknownFrontEndController.
 *
 * It implements the general layout of the browsing/logged in interface.
 *
 * @author Nano8Blazex(Vervious)(bchan)
 */
class BBFrontendController extends Controller
{
	/**
	 * @var string the default layout for the controller view.
	 */
	public $layout='//layouts/main';
	
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	public $htmlMenu; /*plain text non-widget menu outputted in main layout */
	public $htmlOptions = ""; /*plain text non-widget menu of options (e.g. sorting) to be displayed in menu bar (in main layout)*/ /*usually set in view/layouts */
	
	/**
	 * @var bool whether this controller is "logged in" or not. Defaults to false.
	 * NOTE: These and other properties are used in layouts.
	 */
	protected $loggedIn;
	
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
		if (Yii::app()->user->isGuest) {
			$this->setLoggedIn(false);
		} else {
			$this->setLoggedIn(true);
		}	
	}
	
	protected function setLoggedIn($bool) {
		$this->loggedIn = $bool;
		if ($this->loggedIn) {
			/* establish the menu we will use */
			$username = Yii::app()->user->name;
			$this->htmlMenu = <<<VEV
	
	<ul id="menu">
		<li><a href="{$this->createUrl('questions/')}">questions</a></li>
		<li id="profile">
			<a id="profile-link" href="{$this->createUrl('you/index')}">{$username}</a>
			<ul id="profile-nav">
				<li><a href="{$this->createUrl('you/index')}">My Profile</a></li>
				<li><a href="{$this->createUrl('you/transactions')}">Transactions</a></li>
				<li><a href="{$this->createUrl('you/sell')}">Sell A Book</a></li>
				<li><a href="{$this->createUrl('you/logout')}">Log Out</a></li>
			</ul>
		</li>
		<li><a id="title-logo" href="{$this->createUrl('browse/')}">BellBook</a></li>
	</ul>
	
VEV;
		} else {
			/* establish the menu we will use */
			$this->htmlMenu = <<<VEV
	
	<ul id="menu">
		<li><a href="{$this->createUrl('questions/')}">questions</a></li>
		<li id="profile">
			<a id="profile-link" href="{$this->createUrl('you/login')}">Login</a>
			<ul id="profile-nav">
				<li><a href="{$this->createUrl('you/login')}">Login</a></li>
				<li><a href="{$this->createUrl('you/register')}">Register</a></li>
			</ul>
		</li>
		<li><a id="title-logo" href="{$this->createUrl('questions/')}">BellBook</a></li>
	</ul>
	
VEV;
		}
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
			array('allow',   // deny all users
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