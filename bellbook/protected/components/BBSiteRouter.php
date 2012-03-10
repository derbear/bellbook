<?php

/**
 * BBSiteRouter class - directs the user to the right default controller if no controller/url is specified
 */
class BBSiteRouter
{
  /**
   * routeRequest function routes requests based on whether user is logged in or not. (event handler for APp)
   * 
   * If user is logged in, go to WelcomeController (which subclasses BBLoggedInUserInteractionController) 
   * but if the user is not logged in, go to FeaturesController (which subclasses BBUnkownUserInteractionController) 
   * to entice them to join the site. Both function as landing/welcome pages, just changed to match the user.
   * --------------url-notes---------------
   * Note that the url would be host/bellbook/ or host/bellbook/index.php in any case
   * but can still be accessed through host/belbook/index.php/welcome or host/bellbook/index.php/features (depending
   * on which one)
   * 
   * @access public
   * @static
   * @param mixed $event
   * @return void
   */
  public static function routeRequest($event)
  {
    $sender = &$event->sender;
    
    // see if user has priveleges to see the logged in part of the website. Right now it just checks if the user is a
    // guest or not, but we may change this later to make the role/authorization more clear (e.g. a role to "UseSite"
    if($sender->user->isGuest) {
    	// not logged in
		$sender->defaultController = 'questions';
		return;
    } else {
    	// is logged in
    	$sender->defaultController = 'browse';
        return;
    }
    // it shouldn't ever get here, but just in case...
    throw new CHttpException(404, 'Page Could Not Be Found.');
  }
}