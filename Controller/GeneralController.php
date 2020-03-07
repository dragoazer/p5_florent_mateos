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
			$javascript = "<script src='public/js/contact.js'></script>";
			require('template/contact.php');
		}

		public function sendContact () {
			$error = false;
			if (isset($_POST["name"]) AND isset($_POST["lastName"]) AND isset($_POST["mail"]) AND isset($_POST["tel"]) AND isset($_POST["message"])) {
			 	if (!empty($_POST["name"]) AND !empty($_POST["lastName"]) AND !empty($_POST["mail"]) AND !empty($_POST["tel"]) AND !empty($_POST["message"])) {
				 	if (!filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL)) {
				 		$error = true;
				 	}
				 	if (!is_numeric($_POST["tel"])) {
				 		$error = true;
				 	} else {
				 		if ($_POST["tel"] === 1111) {
				 			$_POST["tel"] = "pas de numéros de téléphone communiqué.";
				 		}
				 	}
			 	} else {
			 		$error = true;
			 	}
			} else {
				$error = true;
			}

			if ($error != true) {
		 		$to  = 'flomat50@gmail.com, linogelavaud@gmail.com'; // notez la virgule

			     // Sujet
			     $subject = 'Demande de contacte sur le site de distribution';

			     // message
			     $message = '
			     <html>
			      <head>
			       <title>Demande de contacte sur le site de distribution</title>
			      </head>
			      <body>
			       <p>Voici les détailles :</p>
			       <table>
			        <tr>
			         <p>Nom : $_POST["name"]</p>
			        </tr>
			        <tr>
			         <p>Prénom : $_POST["lastName"]</p>
			        </tr>
				    <tr>
				       <p>Mail : $_POST["mail"]</p>
				    </tr>
				    <tr>
				       <p>Téléphone : $_POST["tel"]</p>
				    </tr>
				    <tr>
				       <p>Message : $_POST["message"]</p>
				    </tr>
				    </table>
				    </body>
				    </html>
				     ';

				$headers[] = 'MIME-Version: 1.0';
				$headers[] = 'Content-type: text/html; charset=iso-8859-1';
				$headers[] = 'To: <flomat50@gmail.com>, <linogelavaud@gmail.com>';
				$headers[] = 'From: distribution-Lavaud@distrib.com';
				//$headers[] = 'Cc: distribution-Lavaud@distrib.com';
				//$headers[] = 'Bcc: distribution-Lavaud@distrib.com';

			     mail($to, $subject, $message, implode("\r\n", $headers));
			    
		 	} else {
		 		$title = "Demande de contacte non envoyé";
		 		$content = "Impossible d'envoyer la demande de contacte veuillez réessayer";
		 		$this->displayError ($title,$content); 
			}
		}
	}