<?php

class DB
{
	public static $host = 'localhost';
	public static $dbName = 'panda';
	protected static $username = 'bartix997';
	protected static $password = 'zxszxs321';

	private static function connect() {
		try {
			$pdo = new PDO("mysql:host=".self::$host.";dbname=".self::$dbName.";charset=utf8", self::$username, self::$password);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $pdo;
		}
		catch (PDOException $e) {
			Controller::createView('Error', array('data' => "Database connection error<br>Code: ".$e->getCode()));
			die();
		}
	}

	public static function query($query, $params=array(), $fetch=PDO::FETCH_NUM) {
		$statement = self::connect()->prepare($query);
		try {
			$statement->execute( $params );
			if (explode( ' ', $query )[0] == 'SELECT' || explode( ' ', $query )[0] == 'SHOW') {
				if ($statement) {
					$data = $statement->fetchAll( $fetch );
					return $data;
				}

			}
		}
		catch (PDOException $e) {
			Controller::createView('Error', array('data' => "Database query execution error<br>Code: ".$e->getCode()));
			die();
		}
	}
}