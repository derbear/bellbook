<?php
/**
 * BBAdminController is a customized base controller class for the admin (backend).
 * All controller classes for the backend should extend from this base class. 
 * It implements the general layout of the admin interface
 */
class BBAdminController extends Controller
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/admin';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	public $htmlMenu; /*plain text non-widget menu outputted in main layout */
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	
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
	/*public function accessRules() {
		return array(
			array('allow', 'actions'=>array(), 'roles'=>array('admin')),
			array('deny', 'actions'=>array()),
		);
	}*/
	
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// do stuff that's not the main content?
	}
}