<?php


/**
 * BBKeywordDatabase Application Component.
 *
 * Stores all the keywords Bellbook uses (for search, page titles, etc.)
 * Should be preloaded as specified in config/main.php
 * if preloaded correctly, the grand instance of this class is accessible using
 *		Yii::app()->keywords
 *
 *
 * @note: we could have stored keywords as Keyword object/models in a mySQL database, but the concept of the 
 *			keyword is simple enough that storing them as $key=>$values at runtime is sufficient
 *			and may be even faster. In essence, treat a $keyword=>$route as a "Keyword"
 *
 * @note: keywords and pagetitles are consolidated in a controller's beforeAction()
 *
 * @author Ben Chan 2012
 */
class BBKeywordDatabase extends CApplicationComponent
{

	/**
	 * designator: the string that identifies a keyword as a keyword (e.g. #Recommended Books)
	 * 
	 * @var string
	 * @access public
	 */
	public $designator;
	
	/**
	 * keywords
	 * 
	 * Stores all keywords
	 * in form $key (keyword, e.g. Recommended Books) => $value (route, e.g. browse/recommended)
	 *
	 * @var mixed
	 * @access public
	 */
	public $keywords = array();
	
	public function init()
	{
		//echo "HELLO WORDL!" . $this->designator;
	}
	
	/**
	 * registerMainKeywords registers the keywords for the frontend of the website.
	 * 
	 * urls/routes must be lowercase
	 *
	 * @access public
	 * @return void
	 */
	public function registerMainKeywords() {
		$keywordsToRegister = array(
			'Recommended Books' => 'browse/recommended',
			'Questions: Welcome!' => 'questions/welcome',
			'Questions: About!' => 'questions/about',
			'Questions: Help!' => 'questions/support',
			Yii::app()->user->name => 'you/index',
			'Your Transactions' => 'you/transactions',
			'Sell A Book' => 'you/sell',
			'Login' => 'you/login',
			'Register' => 'you/register',
		);
		$this->registerNewKeywords($keywordsToRegister);
	}
  
	/**
	* registerNewKeyword function.
	* 
	* @access public
	* @param string $keyword
	* @param string $route
	* @return void
	*/
	public function registerNewKeyword( $keyword, $route ) {
		$this->{keywords}[$keyword] = $route;
	}
	
	/**
	 * registerNewKeywords registers multiple keywords.
	 * 
	 * @access public
	 * @param array $aKeywords keywords and routes to register
	 *		- in form $key (keyword) => $value (route)
	 * @return void
	 */
	public function registerNewKeywords( $aKeywords ) {
		foreach ($aKeywords as $keyword => $route) {
			$this->registerNewKeyword($keyword, $route);
		}
	}
	
	/**
	 * routeForKeyword finds the route associated with the given keyword.
	 * TODO: non case sensitive?
	 * 
	 * @access public
	 * @param mixed $keyword
	 * @return string route associated with keyword, or null if not found.
	 */
	public function routeForKeyword( $keyword ) {
		$keywords = $this->keywords;
		if(isset($keywords[$keyword])) return $keywords[$keyword];
		else return null;
	}
	
	/**
	 * keywordsForRoute finds the keyword(s) associated with the given route.
	 * 
	 * @access public
	 * @param string $route
	 * @return array with keywords
	 */
	public function keywordsForRoute( $route ) {
		$route = strtolower($route);
		$keywords = $this->keywords;
		if (!$keywords) return array();
		$matchingKeywords = array_keys( $keywords, $route );
		return $matchingKeywords;
	}
	
	/**
	 * keywordsMatchingInput finds matching keywords for given input (e.g. a search).
	 * 
	 * @access public
	 * @param mixed $input
	 * @return array keywords (without routes) that are possible matches for input, empty array if none found
	 */
	public function keywordsMatchingInput( $input ) {
		$keywords = $this->keywords;
		$matchingKeywords = array();
		// select keywords from $keywords where $keywork like $input
		$keys = array_keys($keywords);
		foreach ($keys as $keyword) {
			if (substr_count($keyword, $input) > 0 ) { /* TODO: Make this better - get rid of case sensitivity, and order by recommendation */
				$matchingKeywords[] = $keyword;
			}
		}
		return $matchingKeywords;
	}
}