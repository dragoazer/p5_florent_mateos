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
			$req = $this->dbConnect()->prepare('SELECT creation_date, validated, com_admin, com_member, city_name, number_tract FROM quote WHERE id_user ORDER BY creation_date DESC LIMIT :limitStart, :limitNumber');
			$req->bindValue(':limitStart', (int) $limitStart, PDO::PARAM_INT);
			$req->bindValue(':limitNumber', (int) $limitNumber, PDO::PARAM_INT);
			$req->execute(array(
				"id_user"=>$id_user,
			));
			if ($req->rowCount() > 0) {
				while ($data = $req->fetch())
	    		{
	      			$quote[] = new Post($data);
	      		}
				return $quote ?? "error";
			} else {
				return 'error';
			}
		}

		public function numberQuote (int $id_user)
		{
			$req = $this->dbConnect()->prepare('SELECT id FROM quote WHERE id_user');
			$req->execute(array(
				"id_user"=>$id_user,
			));
			if ($req->rowCount() > 0) {
				while ($data = $req->fetch())
	    		{
	      			$quote[] = new Post($data);
	      		}
				return $quote ?? "error";
			} else {
				return 'error';
			}
		}

		public function showQuoteAdmin (int $limitStart, int $limitNumber)
		{
			$req = $this->dbConnect()->prepare('SELECT creation_date, validated, com_admin, com_member, city_name, number_tract FROM quote ORDER BY creation_date DESC LIMIT :limitStart, :limitNumber');
			$req->bindValue(':limitStart', (int) $limitStart, PDO::PARAM_INT);
			$req->bindValue(':limitNumber', (int) $limitNumber, PDO::PARAM_INT);
			$req->execute();
			if ($req->rowCount() > 0) {
				while ($data = $req->fetch())
	    		{
	      			$quote[] = new Post($data);
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
			if ($req->rowCount() > 0) {
				while ($data = $req->fetch())
	    		{
	      			$quote[] = new Post($data);
	      		}
				return $quote ?? "error";
			} else {
				return 'error';
			}
		}
	}