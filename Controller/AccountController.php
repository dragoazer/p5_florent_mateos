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
			require("template/registration.php");
		}

		public function disconnect ()
		{
			session_destroy();
			header("Location: http://".$_SERVER['SERVER_NAME']."/p5_florent_mateos/index.php");
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
						$bddEmail = $login->email();
						$bddUserType= $login->user_type();
						$bddPwd= $login->pwd();
						if (password_verify($pwd, $bddPwd)) {
							$_SESSION["connected"] = $login->user_type();
							$_SESSION["name"] = $login->last_name()." ".$login->first_name();
							$_SESSION["email"] = $login->email();
							header("Location: http://".$_SERVER['SERVER_NAME']."/p5_florent_mateos/index.php?action=account");
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
			if (isset($_POST['email']) AND isset($_POST['first_name']) AND isset($_POST['last_name']) AND isset($_POST['password'])) {
				if (!empty($_POST['email']) AND !empty($_POST['first_name']) AND !empty($_POST['last_name']) AND !empty($_POST['password'])) {
					if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
						if (preg_match("/([a-zA-Z0-9._-]){8}/", $_POST['password'])) {
							$data = [
								"first_name" => $_POST['first_name'],
								"last_name" => $_POST['last_name'],
								"email" => $_POST['email'],
								"pwd" => password_hash($_POST['password'], PASSWORD_DEFAULT),
							];
							$account = new Account($data);
							$connected = $this->accountModel->setRegistration($account);
							if ($connected != "error") {
								$title = "Inscription réussie";
								$message = "Vous avez bien été inscript, veuillez vous redirigé vers la page de connexion.";
								$this->generalController->displayError($title,$message);
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

			if ($error === true) {
				$title = "Inscription échoué";
				$message = "Les renseignements que vous avez prodigués sont erronés.";
				$this->generalController->displayError($title,$message);
			}
		}

		public function displayAccount () 
		{
			if (isset($_SESSION["email"])) {
				$account = $this->accountModel->displayAccount($_SESSION["email"]);
				if ($_SESSION["connected"] === "member") {
					$javascript = "<script src='public/js/memberAccount.js'></script>";
					require("template/member.php");
				} else if ($_SESSION["connected"] === "admin") {
					$javascript = "<script src='public/js/connection.js'></script>";
					require("template/admin.php");
				}
			} else {
				$title = "Connexion échoué";
				$message = "Impossible de vous connectez, veuillez vous rendre sur la page de <a href='index.php?action=signin'>connexion</a>.";
				$this->generalController->displayError($title,$message);
			}
		}

		public function modifyAccount ()
		{
			$error = false;


			if (!isset($_FILES['profile_picture']) AND empty($_FILES['profile_picture'])) {
				$profile_picture = "public/image/basicProfile.png";
			} else {
				$extensions = array('.png', '.gif', '.jpg', '.jpeg');
				$fileExt = strrchr($_FILES['profile_picture']['name'], '.');

				$fileSize = 100000;
				$size = filesize($_FILES['profile_picture']['tmp_name']);

				$folder = 'public/image/';
	     		$fileName = basename($_FILES['profile_picture']['name']);
	     		$profile_picture = $folder.$fileName;

	     		move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profile_picture);

				if(!in_array($fileExt, $extensions)) {
	     			$error = true;
				}

				if($size>$fileSize) {
	     			$error = true;
				}
			}
			
			if (isset($_POST['password'])) {
				if (!preg_match("/([a-zA-Z0-9._-]){8}/", $_POST['password'])) {
					$error = true;
 				} 
 			} else {
 				$noPwd = true;
 			}

			if ($error === true) {
				$title = "Inscription échoué";
				$message = "Les renseignements que vous avez prodigués sont erronés.";
				$this->generalController->displayError($title,$message);
			} else {
				$data = [
					"profile_picture" => $profile_picture,
					"pwd" => isset($noPwd) === false? password_hash($_POST['password'], PASSWORD_DEFAULT) : "",
					"email" => $_SESSION["email"]
				];
				$account = new Account($data);
				if ($noPwd) {
					$modify = $this->accountModel->updateProfile($account);
				} else {
					$modify = $this->accountModel->updateAccount($account);
				}
				if ($modify != "error") {
					header("Location: http://".$_SERVER['SERVER_NAME']."/p5_florent_mateos/index.php?action=account");
				} else {
					$title = "Modification échoué";
					$message = "La modification de votre compte à échoué, veuillez réessayer.";
					$this->generalController->displayError($title,$message);
				}
			}
		}
	}