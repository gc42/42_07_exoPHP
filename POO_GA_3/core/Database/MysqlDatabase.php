<?php
namespace Core\Database; // Le namespace courant pou cette page
use \PDO;               // Indique dans quel namespace chercher PDO

class MysqlDatabase extends Database
{

	private $db_name;
	private $db_user;
	private $db_pass;
	private $db_host;
	private $pdo;

	public function __construct($db_name, $db_user = 'root', $db_pass = 'toto', $db_host = 'localhost')
	{
		$this->db_name  = $db_name;
		$this->db_user  = $db_user;
		$this->db_pass  = $db_pass;
		$this->db_host  = $db_host;
	}



	
	private function getPDO()
	{
		if ($this->pdo === null)
		{
			$pdo = new PDO('mysql:host='.$this->db_host.';dbname='.$this->db_name, $this->db_user, $this->db_pass);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // On émet une alerte à chaque fois qu'une requête a échoué.
			$this->pdo = $pdo;
		}

		return $this->pdo;
	}




	public function query($statement, $class_name = null, $one = false)
	{
		$req = $this->getPDO()->query($statement);
		
		if (
			strpos($statement, 'UPDATE') === 0 ||
			strpos($statement, 'INSERT') === 0 ||
			strpos($statement, 'DELETE') === 0
		) {
			return $req;
		}
		
		if ($class_name === null)
		{
			$req->setFetchMode(PDO::FETCH_OBJ);
		} else {
			$req->setFetchMode(PDO::FETCH_CLASS, $class_name);
		}

		if($one)
		{
			$datas = $req->fetch();
		} else
		{
			$datas = $req->fetchAll();
		}

		return $datas;
	}



	
	public function prepare($statement, $attributes, $class_name = null, $one = false)
	{
		$req = $this->getPDO()->prepare($statement);
		$resultat = $req->execute($attributes);

		if (
			strpos($statement, 'UPDATE') === 0 ||
			strpos($statement, 'INSERT') === 0 ||
			strpos($statement, 'DELETE') === 0
		) {
			return $resultat;
		}

		if ($class_name === null)
		{
			$req->setFetchMode(PDO::FETCH_OBJ);
		} else {
			$req->setFetchMode(PDO::FETCH_CLASS, $class_name);
		}
		
		if($one)
		{
			$datas = $req->fetch();
		} else
		{
			$datas = $req->fetchAll();
		}

		return $datas;
	}
}

