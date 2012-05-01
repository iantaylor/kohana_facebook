<?php defined('SYSPATH') or die('No direct script access.');


class Kohana_Facebook
{

	protected function __construct()
	{	
		//Include the required facevook vendor files
		include Kohana::find_file('vendor', 'facebook/src/facebook');

	}	

}