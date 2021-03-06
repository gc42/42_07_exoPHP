<?php
// namespace App; // Il a choisi de ne pas utiliser de namespace pour App
use Core\Config;
use Core\Database\MysqlDatabase;


class App
{
	public $title = "Mon site GA";
	private static $_instance;
	private $db_instance;
	

/*
	private function __construct()
	{
		echo 'prout';
	}
*/
	
	
	// MISE EN PLACE DU 'SIGLETON', pour que la class App ne soit instanciée qu'une fois
	public static function getInstance()
	{
		if (self::$_instance === null)
		{
			self::$_instance = new App();
		}
		return self::$_instance;
	}
	
	
	
	public static function load()
	{
		session_start();

		require ROOT . '/app/Autoloader.php';
		\App\Autoloader::register();
		
		require ROOT . '/core/Autoloader.php';
		\Core\Autoloader::register();
	}






	// TROUVE LE NOM DE LA TABLE A PARTIR DU NOM PASSE EN PARAMETRE
	public function getTable($name)
	{
		$class_name = '\\App\\Table\\' . ucfirst($name) . 'Table';
		return new $class_name($this->getDb());
	}



	// GESTION DE LA BDD
	public function getDB()
	{
		$config = Config::getInstance(ROOT . '/config/config.php');
		if (is_null($this->db_instance))
		{
			$this->db_instance = new MysqlDatabase($config->get('db_name'), $config->get('db_user'), $config->get('db_pass'), $config->get('db_host'));
		}
		return $this->db_instance;
	}


	// ERREUR SI LA PAGE EST INTROUVABLE
	public function notFound()
	{
		header("HTTP/1.0 404 Not Found");
		// header('Location:index.php?p=404');
		die('Page introuvable');
	}


	// ERREUR SI L'ACCES A LA PAGE EST INTERDIT
	public function forbidden()
	{
		header("HTTP/1.0 403 Forbidden");
		print_r($_POST); echo '<br>';
		print_r($_SESSION); echo '<br>';
		
		die('Acces interdit');
	}
}