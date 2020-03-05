<?php
	namespace Distribution\Controller;
	/**
	 * 
	 */
	class AccountController
	{
		public function displaySignin ()
		{
			require("template/registration.php");
		}

		public function disconnect ()
		{
			session_destroy();
			header("Location: http://".$_SERVER['SERVER_NAME']."/p5_florent_mateos/");
		}

		

	}