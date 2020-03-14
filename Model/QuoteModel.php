<?php
	namespace Distribution\Model;

	use Distribution\Model\Manager;
	use Distribution\Entity\Quote;

	/**
	 * 
	 */
	class QuoteModel extends Manager
	{
		public function showQuoteMember (int $id_user, int $limitStart, int $limitNumber)
		{
			$req = $this->dbConnect()->prepare('SELECT id, creation_date, validated, com_admin, com_member, city_name, number_tract, price FROM quote WHERE id_user = :id_user ORDER BY creation_date DESC LIMIT :limitStart, :limitNumber');
			$req->bindValue(':limitStart', $limitStart, \PDO::PARAM_INT);
			$req->bindValue(':limitNumber', $limitNumber, \PDO::PARAM_INT);
			$req->bindValue("id_user" , $id_user, \PDO::PARAM_INT);
			$req->execute();
			if ($req->rowCount() > 0) {
				while ($data = $req->fetch())
	    		{
	      			$quote[] = new Quote($data);
	      		}
				return $quote ?? "error";
			} else {
				return 'error';
			}
		}

		public function numberQuote (int $id_user)
		{
			$req = $this->dbConnect()->prepare('SELECT id FROM quote WHERE id_user = :id_user');
			$req->execute(array(
				"id_user"=>$id_user,
			));
			return $req->rowCount();
		}

		public function showQuoteAdmin (int $limitStart, int $limitNumber)
		{
			$req = $this->dbConnect()->prepare('SELECT id, creation_date, validated, com_admin, com_member, city_name, number_tract, price FROM quote ORDER BY creation_date DESC LIMIT :limitStart, :limitNumber');
			$req->bindValue(':limitStart', (int) $limitStart, \PDO::PARAM_INT);
			$req->bindValue(':limitNumber', (int) $limitNumber, \PDO::PARAM_INT);
			$req->execute();
			if ($req->rowCount() > 0) {
				while ($data = $req->fetch())
	    		{
	      			$quote[] = new Quote($data);
	      		}
				return $quote ?? "error";
			} else {
				return 'error';
			}
		}

		public function totalQuote ()
		{
			$req = $this->dbConnect()->prepare('SELECT id FROM quote');
			$req->execute();
			return $req->rowCount();
		}

		public function sendQuote (Quote $quote)
		{
			$req = $this->dbConnect()->prepare('INSERT INTO quote(id_user, creation_date, com_member, city_name, number_tract, price) VALUES (:id_user, NOW(), :com_member, :city_name, :number_tract, :price)');
			$req->execute(array(
				'id_user' => $quote->id_user(),
				"com_member" => $quote->com_member(),
				"city_name" => $quote->city_name(),
				"number_tract" => $quote->number_tract(),
				"price" => $quote->price() 
			));
		}
	}