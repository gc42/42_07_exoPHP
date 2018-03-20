<?php
namespace App\Table;
use App\App;

class Table
{
	protected static $table;



	private static function getTable()
	{
		if (static::$table === null)
		{
			$class_name = explode('\\', get_called_class());
			static::$table = strtolower(end($class_name)) . 's';
		}
		
		// die(static::$table);
		return static::$table;
	}



	public static function all()
	{
		return App::getDb()->query("
		SELECT *
		FROM ".static::$table."
		", get_called_class());
	}


	/**
	 * 
	 */
	public static function find($id)
	{
		// return App::getDb()->prepare("
		return static::query("
		SELECT *
		FROM ".static::getTable()."
		WHERE id = ?
		", [$id], true);
	}



	/**
	 * 
	 */
	public static function query($statement, $attributes = null, $one = false)
	{
		if ($attributes)
		{
			return App::getDb()->prepare($statement, $attributes, get_called_class(), $one);
		}
		else
		{
			return App::getDb()->query($statement, get_called_class(), $one);
		}
	}



	/**
	 * 
	 */
	public function __get($key)
	{
		$method = 'get' . ucfirst($key);
		$this->key = $this->$method();
		
		return $this->key;
	}
}