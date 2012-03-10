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
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	public $htmlMenu; /*plain text non-widget menu outputted in main layout */
	public $htmlOptions = ""; /*plain text non-widget menu of options (e.g. sorting) to be displayed in menu bar (in main layout)*/
	
	/**
	 * @var bool whether this controller is "logged in" or not. Defaults to false.
	 * NOTE: These and other properties are used in layouts.
	 */
	protected $loggedIn=false;
	
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// do stuff that's not the main content?
	}
}