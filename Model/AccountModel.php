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
			$req = $this->dbConnect()->prepare("SELECT first_name, last_name, email FROM account WHERE email=?");
			$req->execute(array(
				$account->email(),
			));
			if ($req->fetch()) {
				return "error";
			} else {
				$req = $this->dbConnect()->prepare("INSERT INTO account(first_name, last_name, user_type, profile_picture, email, pwd) VALUES (:first_name, :last_name, :user_type, :profile_picture, :email, :pwd)");
				$req->execute([
		        	"first_name"=> $account->first_name(),
		        	"last_name"=> $account->last_name(),
		        	"user_type"=>"member",
		        	"profile_picture"=>"public/image/basicProfile.png",
		        	"email"=> $account->email(),
		        	"pwd"=> $account->pwd(),
		    	]);
			}
		}

		public function displayAccount (string $email) 
		{
			
			$req = $this->dbConnect()->prepare("SELECT id, email, first_name, last_name, profile_picture FROM account WHERE email=?");
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

		public function updateAccount (Account $account)
		{
			$req = $this->dbConnect()->prepare("UPDATE account SET pwd = :pwd, profile_picture = :profile_picture WHERE email= :email");
			$req->execute(array(
				"pwd" => $account->pwd(),
				"profile_picture" => $account->profile_picture(),
				"email" => $account->email(),
			));
		}

		public function updateProfile (Account $account)
		{
			$req = $this->dbConnect()->prepare("UPDATE account SET  profile_picture = :profile_picture WHERE email = :email");
			$req->execute(array(
				"profile_picture" => $account->profile_picture(),
				"email" => $account->email(),
			));
		}	
	}