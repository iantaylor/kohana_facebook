<?php defined('SYSPATH') or die('No direct script access.');


class Kohana_Facebook
{

	protected $_facebook; 

	public function __construct()
	{	
		//Include the required facebook vendor files
		include Kohana::find_file('vendor', 'facebook-sdk/src/facebook');


		$this->_facebook = new Facebook(array(
				'appId'		=> Kohana::$config->load('facebook.app_id'),
				'secret'	=>	Kohana::$config->load('facebook.secret')
		));

	}	


	public static function factory()
	{
		return new kohana_facebook ();
	}

}