<?php
	namespace Distribution\Controller;

	use Distribution\Controller\GeneralController;
	use Distribution\Model\QuoteModel;
	use Distribution\Entity\Quote;
	use Distribution\Model\AccountModel;
	use Distribution\Entity\Account;
	/**
	 * 
	 */
	class QuoteController
	{
		private $quoteModel;
		private $generalController;
		private $accountModel;

		public function __construct ()
		{
			$this->generalController = new GeneralController();
			$this->quoteModel = new QuoteModel();
			$this->accountModel = new AccountModel();
		}

		public function displayQuote ()
		{
			if (isset($_SESSION["connected"])) {
				require("template/memberQuote.php");
			} else {
				$title = "Non connecté";
				$message = " Vous n'êtes pas connecté,veuillez vous rendre sur la page de <a href='index.php?action=signin'>connexion</a>.";
				$this->generalController->displayError($title,$message);
			}		
		}

		public function showQuote ()
		{	
			if (isset($_SESSION['connected']) AND isset($_GET["quotePage"])) {
					$limitStart = 0;
					$limitNumber = 5;
					if ($_GET["quotePage"] != 0) {
							$limitStart = $limitStart + 5 * $_GET["quotePage"];
					}
				if ($_SESSION["connected"] === 'member') {
					$account = $this->accountModel->displayAccount($_SESSION["email"]);
					$id_user = $account->id();
					$quoteArray = $this->quoteModel->showQuoteMember($id_user, $limitStart, $limitNumber);
					$numberQuote = $this->quoteModel->numberQuote($id_user);
					$numberPage = ceil($numberQuote/5);
					$status = "member";
					$data = array(
						"quote" => $quoteArray,
						"number" => $numberQuote,
						"page" => $numberPage,
						"status" => $status
					);
					$json = json_encode($data);
					echo $json;
				} else if ($_SESSION["connected"] === 'admin') {
					$quoteArray = $this->quoteModel->showQuoteAdmin($limitStart, $limitNumber);
					$numberQuote = $this->quoteModel->totalQuote();
					$numberPage = ceil($numberQuote/5);
					$status = "admin";
					$data = array(
						"quote" => $quoteArray,
						"number" => $numberQuote,
						"page" => $numberPage,
						"status" => $status
					);
					$json = json_encode($data);
					echo $json;
				}
			} else {
				$title = "Non connecté";
				$message = " Vous n'êtes pas connecté,veuillez vous rendre sur la page de <a href='index.php?action=signin'>connexion</a>.";
				$this->generalController->displayError($title,$message);
			}
		}

		public function sendQuote ()
		{
			if (isset($_SESSION['connected']) AND isset($_POST["city_name"]) AND isset($_POST["number_tract"]) AND isset($_POST["com_member"])) {

				$tracts = $_POST["number_tract"];
				$priceU = 0.045;

				if ($tracts >= 2000 ||  $tracts <= 5000) {
					$priceU = 0.040;
				}

				if($tracts > 5000) {
					$priceU = 0.035;
				}

				$price = round($tracts * $priceU, 2);

				$account = $this->accountModel->displayAccount($_SESSION["email"]);
				$id_user = $account->id();

				$data = [
					'id_user' => $id_user,
					"com_member" => $_POST["com_member"],
					"city_name" => $_POST["city_name"],
					"number_tract" => $_POST["number_tract"],
					"price" => $price 
				];
				$quote = new Quote($data);
				$this->quoteModel->sendQuote($quote);
			}
		}

		public function redirectCom ()
		{
			if (isset($_SESSION["connected"]) AND isset($_GET["id"])) {
				require('template/redirectCom.php');
			} else {
				$title = "Non connecté";
				$message = " Vous n'êtes pas connecté,veuillez vous rendre sur la page de <a href='index.php?action=signin'>connexion</a>.";
				$this->generalController->displayError($title,$message);
			}
		}

		public function modifyCom ()
		{
			if (isset($_SESSION["connected"]) AND isset($_GET["id"]) AND isset($_POST["newCom"]) AND !empty($_POST["newCom"])) {
				if ( $_SESSION["connected"] === 'member') {
					$account = $this->accountModel->displayAccount($_SESSION["email"]);
					$id_user = $account->id();
					$data = [
						'id' => $_GET["id"],
						'id_user' => $id_user,
					];
					$quote = new Quote($data);
					$aut = $this->quoteModel->verifyAut($quote);
					if ($aut > 0) {
						$data = [
							'com_member' => $_POST["newCom"],
							'id' => $_GET["id"],
						];
						$quote = new Quote($data);
						$modifyCom = $this->quoteModel->modifyComm($quote);	
						header("Location: http://".$_SERVER['SERVER_NAME']."/p5_florent_mateos/index.php?action=displayQuote");		
					}
				} else {
					$data = [
						'id' => $_GET["id"],
						'com_admin' => $_POST["newCom"],
					];
					$quote = new Quote($data);				
					$modifyCom = $this->quoteModel->modifyComAdmin($quote);
					header("Location: http://".$_SERVER['SERVER_NAME']."/p5_florent_mateos/index.php?action=displayQuote");
					
				}
			} else {
				$title = "Non connecté";
				$message = " Vous n'êtes pas connecté,veuillez vous rendre sur la page de <a href='index.php?action=signin'>connexion</a>.";
				$this->generalController->displayError($title,$message);
			}
		}

	}