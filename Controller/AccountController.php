<?php
	namespace Distribution\Controller;

	use Distribution\Controller\GeneralController;
	use Distribution\Model\AccountModel;
	use Distribution\Entity\Account;
	/**
	 * 
	 */
	class AccountController
	{
		private $generalController;
		private $accountModel;

		public function __construct ()
		{
			$this->generalController = new GeneralController();
			$this->accountModel = new AccountModel();
		}

		public function displaySignin ()
		{
			$javascript = "<script src='public/js/connection.js'></script>";
			require("template/registration.php");
		}

		public function disconnect ()
		{
			session_destroy();
			header("Location: http://".$_SERVER['SERVER_NAME']."/p5_florent_mateos/");
		}
		public function setLogin ()
		{
			$error = false;
			if (isset($_POST['emailConect']) AND isset($_POST['pwdConect'])) {
				if (!empty($_POST['emailConect']) AND !empty($_POST['pwdConect']) AND filter_var($_POST['emailConect'], FILTER_VALIDATE_EMAIL)) {
					$email = $_POST['emailConect'];
					$pwd = $_POST['pwdConect'];
					$data = [
						"email" => $email,
						"pwd" => $pwd,
					];
					$account = new Account($data);
					$login = $this->accountModel->login($account);
					if ($login != "error") {
						$bddPseudo = $login->pseudo();
						$bddEmail = $login->email();
						$bddUserType= $login->user_type();
						$bddPwd= $login->pwd();
						if (password_verify($pwd, $bddPwd)) {
							$_SESSION["connected"] = $connected->user_type();
							$_SESSION["name"] = $connected->last_name()." ".$connected->first_name();
							$_SESSION["email"] = $connected->email();
							 header("Location: http://web-projetmateos.fr/projet4/index.php?action=account");
						} else {
							$error = true;
						}
					} else {
						$error = true;
					}
				} else {
					$error = true;
				}
			}
			if ($error) {
				$title = "Connection échoué";
				$message = "Les renseignements que vous avez prodigué sont erronés.";
				$this->generalController->displayError($title,$message);
			}
		}

		public function setRegistration ()
		{
			$error = false;
			if (isset($_POST['email']) AND isset($_POST['first_name']) AND isset($_POST['last_name']) AND isset($_POST['pwd'])) {
				if (!empty($_POST['email']) AND !empty($_POST['first_name']) AND !empty($_POST['last_name']) AND !empty($_POST['pwd'])) {
					if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
						if (preg_match("/([a-zA-Z0-9._-]){8}/", $_POST['pwd'])) {
							$connected = $this->accountModel->setRegistration();
							if ($connected != "error") {
								$title = "Inscription réussie";
								$message = "Vous avez bien été inscript, vous allez être redirigé vers la page de connexion.";
								$this->generalController->displayError($title,$message);
								header('Refresh: 7; URL=http://'.$_SERVER['SERVER_NAME'].'/p5_florent_mateos/action=signin');
							} else {
								$error = true;
							}
						}
					} else {
						$error = true;
					}			
				} else {
					$error = true;
				}
			} else {
				$error = true;
			}

			if ($error) {
				$title = "Inscription échoué";
				$message = "Les renseignements que vous avez prodigués sont erronés.";
				$this->generalController->displayError($title,$message);
			}
		}

		public function displayAccount () 
		{
			$account = $this->accountModel->displayAccount($_SESSION["email"]);
			if ($_SESSION["connected"] === "member") {
				require("template/member.php");
			} else {
				require("template/admin.php");
			}
		}
	}