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
						$bddUserType = $login->user_type();
						$bddPwd = $login->pwd();
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
								$message = "Vous avez bien été inscript, veuillez vous redirigé vers la page de <a href='index.php?action=signin'>connexion</a>.";
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
				$message = "Les renseignements que vous avez prodigués sont erronés. Redirection vers la page d'inscription : <a href='index.php?action=signin'>connexion</a>";
				$this->generalController->displayError($title,$message);
			}
		}

		public function displayAccount () 
		{
			if (isset($_SESSION["email"])) {
				$account = $this->accountModel->displayAccount($_SESSION["email"]);
				require("template/member.php");
			} else {
				$title = "Connexion échoué";
				$message = "Impossible de vous connectez, veuillez vous rendre sur la page de <a href='index.php?action=signin'>connexion</a>.";
				$this->generalController->displayError($title,$message);
			}
		}

		public function modifyAccount ()
		{
			$error = false;

			///////////////////////////////////////// FILE
			if (isset($_FILES['profile_picture']) AND $_FILES['profile_picture']['size'] > 0) {
				if ($_FILES['profile_picture']['size'] <= 1000000) {
					$infosfichier = pathinfo($_FILES['profile_picture']['name']);
					$extension_upload = $infosfichier['extension'];
					$extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
					if (in_array($extension_upload, $extensions_autorisees)) {
						move_uploaded_file($_FILES['profile_picture']['tmp_name'], 'public/image/' . basename($_FILES['profile_picture']['name']));
						$profile_picture = 'public/image/'.$_FILES['profile_picture']['name'];
					} else {
						$error = true;
					}
				} else {
					$error = true;
				}
			} else {
				$error = true;
			}

			if ($error != true ) {
				$data = [
					"profile_picture" => $profile_picture,
					"email" => $_SESSION["email"]
				];
				$account = new Account($data);
				$modify = $this->accountModel->updateProfile($account);	
				header("Location: http://".$_SERVER['SERVER_NAME']."/p5_florent_mateos/index.php?action=account");
			} else {
				$title = "Inscription échoué";
				$message = "Les renseignements que vous avez prodigués sont erronés.";
				$this->generalController->displayError($title,$message);
			}
		}
	}