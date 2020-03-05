<?php
	namespace Distribution\Controller;
	/**
	 * 
	 */
	class GeneralController
	{
		public function displayHome ()
		{
			require("template/home.php");
		}

		public function displayError (string $error, string $message) 
		{
			$title = $error;
			$errorContent = $message;
			require("template/errorTemplate.php");
		}

		public function redirectContact ()
		{
			require('template/contact.php');
		}

		public function sendContact {

		}
	}