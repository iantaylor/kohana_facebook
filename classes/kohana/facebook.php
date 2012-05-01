<?php defined('SYSPATH') or die('No direct script access.');


class Kohana_Facebook
{

	protected $_facebook; 

	public function __construct()
	{	
		//Include the required facebook vendor files
		include Kohana::find_file('vendor', 'facebook-sdk/src/facebook');

		$this->_facebook = new Facebook(array(
				'appId'		=> 	Kohana::$config->load('facebook.app_id'),
				'secret'		=>	Kohana::$config->load('facebook.secret')
		));

	}	


	public static function factory ()
	{
		return new kohana_facebook ();
	}

	/**
	 * Returns the Application ID being used by the SDK
	 * @return int App ID 
	 */
	public function getAppId ()
	{
		return $this->_facebook->getAppId ();
	}

	/**
	 * Gets the user ID of the current logged in user
	 * If there is no logged in user 0 will be returned
	 * @return int userId
	 */
	public function getUser ()
	{
		return $this->_facebook->getUser();
	}

	/**
	 * Gets all the available information about a user (location, name, work etc.)
	 * 
	 * @return array users data
	 */
	public function getUserInformation ()
	{
		return $this->_facebook->api('/me','GET');	
	}

	/**
	 * Post to the current logged in users timeline
	 * 
	 * @param  String $message Message to display
	 * @param  String $link    Link to display
	 */
	public function postToTimeline ($message, $link)
	{
		$this->_facebook->api('/me/feed', 'POST',array(
			'link' => $link,
			'message' => $message
		));
	}


	/**
	 * Optional way to log a user into facebook without using
	 * the Facebook Javascript SDK
	 * @param  String $redirect URL to redirect the user back to after logging into facebook
	 * @param  String $scope     Request permissions separated by a comma, ex: publish_strem
	 * 
	 */
	public function fbLogin ($redirect, $scope="")
	{
		$app_id = Kohana::$config->load('facebook.app_id');
			
		$params = array(
		  'scope' => $scope,
		  'redirect_uri' => $redirect
		);

		Request::factory()->redirect($this->_facebook->getLoginUrl($params));
	}


}