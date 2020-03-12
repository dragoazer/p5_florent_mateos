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
			if (isset($_SESSION['connected']) AND $_POST["quotePage"]) {
				if ($_SESSION["connected"] === 'member') {
					$account = $accountmodel->displayAccount($_SESSION["email"]);
					$id_user = $account->id();
					$limitStart = 0;
					$limitNumber = 5;
					if ($_POST["quotePage"] != 0) {
						for ($i = 0; i < $_POST["quotePage"]; $i++) {
							$limitStart = $limitStart + 5;
						}
					}
					$quoteArray = $this->quoteModel->showQuoteMember($id_user, $limitStart, $limitNumber);
					$numberQuote = count($this->quoteModel->numberQuote($id_user));
					$numberPage = $numberQuote/5;
				} else {
					$quoteArray = $this->quoteModel->showQuoteAdmin($limitStart, $limitNumber);
					$numberQuote = count($this->quoteModel->totalQuote());
					$numberPage = $numberQuote/5;
					$status = "admin";
				}
			} else {
				$title = "Non connecté";
				$message = " Vous n'êtes pas connecté,veuillez vous rendre sur la page de <a href='index.php?action=signin'>connexion</a>.";
				$this->generalController->displayError($title,$message);
			}
			
		}
	}