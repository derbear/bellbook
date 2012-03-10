<?php
/**
 * BBUnknownFrontendController is a customized base controller class for the frontend for the non logged in user.
 * All controller classes for the frontend for non logged in users should extend from this base class.
 *
 * It implements the general layout of the new user or log in interface
 * Allows access to all users, guests, and organisms on the planet Earth.
 *
 * @author Nano8Blazex(Vervious)Bchan
 */
class BBUnknownFrontendController extends BBFrontendController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/main';
	
	/**
	 * @var bool whether this controller is "logged in" or not at layout render time
	 */
	protected $loggedIn=false;
	
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	public $htmlMenu;
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
			<a id="profile-link" href="{$this->createUrl('login/index')}">Login</a>
			<ul id="profile-nav">
				<li><a href="{$this->createUrl('register/index')}">Register</a></li>
			</ul>
		</li>
		<li><a id="title-logo" href="{$this->createUrl('questions/')}">BellBook</a></li>
	</ul>
	
VEV;
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