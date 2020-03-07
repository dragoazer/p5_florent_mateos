<?php
	namespace Distribution\Controller;

	use Distribution\Controller\GeneralController;
	use WriterBlog\Model\AccountModel;
	use WriterBlog\Entity\Account;
	/**
	 * 
	 */
	class AccountController
	{
		private $generalController;

		public function __construct ()
		{
			$this->generalController = new GeneralController();
		}

		public function displaySignin ()
		{
			require("template/registration.php");
		}

		public function disconnect ()
		{
			session_destroy();
			header("Location: http://".$_SERVER['SERVER_NAME']."/p5_florent_mateos/");
		}
		public function setLogin ()
		{
			if (isset($_POST['emailConect']) AND isset($_POST['pwdConect'])) {
				$error = false;
				if (!empty($_POST['emailConect']) AND !empty($_POST['pwdConect'])) {
					$email = htmlspecialchars(trim($_POST['emailConect']));
					$pwd = $_POST['pwdConect'];
					$data = [
						"email" => $email,
						"pwd" => $pwd,
					]
					$account = new Account($data);
					$login = $this->accountModel->login($account);
					if ($login != "error") {
						$bddPseudo = $login->pseudo();
						$bddEmail = $login->email();
						$bddUserType= $login->user_type();
						$bddPwd= $login->pwd();
						if (password_verify($pwd, $bddPwd)) {
							 $_SESSION["pseudo"] = $bddPseudo;
							 $_SESSION["connected"] = $bddUserType;
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
				$message = "Les renseignement que vous avez prodiguer sont erroné.";
				$this->generalController->displayError($title,$message);
			}
		}
	}