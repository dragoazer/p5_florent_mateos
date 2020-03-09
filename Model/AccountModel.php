<?php
	namespace Distribution\Model;

	use Distribution\Model\Manager;
	use Distribution\Entity\Account;

	/**
	 * 
	 */
	class AccountModel extends Manager
	{
		public function login (Account $account)
		{
			$req = $this->dbConnect()->prepare("SELECT email, last_name, first_name, user_type, pwd FROM account WHERE email=?");
			$req->execute(array(
				$account->email(),
			));

			if ($req->rowCount() > 0) {
				$data = new Account($req->fetch());
				return $data ?? "error";
			} else {
				return "error";
			}
		}

		public function setRegistration (Account $account)
		{
			$req = $this->dbConnect()->prepare("SELECT first_name, last_name, pseudo, email FROM account WHERE email=?");
			$req->execute(array(
				$account->email(),
			));
			if ($req->fetch()) {
				return "error";
			} else {
				$req = $this->dbConnect()->prepare("INSERT INTO account(first_name, last_name, user_type, pseudo, profile_picture, email, pwd) VALUES (:first_name, :last_name, :user_type, :pseudo, :profile_picture, :email, :pwd)");
				$req->execute([
		        	"first_name"=> $account->first_name(),
		        	"last_name"=> $account->last_name(),
		        	"user_type"=>"member",
		        	"profile_picture"=>"public/images/basicProfile.png",
		        	"email"=> $account->email(),
		        	"pwd"=> $account->pwd(),
		    	]);
			}
		}

		public function displayAccount (string $email) 
		{
			
			$req = $this->dbConnect()->prepare("SELECT email, last_name, first_name, FROM account WHERE email=?");
			$req->execute(array(
				$email,
			));
			if ($req->rowCount() > 0) {
				$data = new Account($req->fetch());
				return $data ?? "error";
			} else {
				return "error";
			}
		}	
	}