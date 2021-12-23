<?php
/**
 * Classe feita para manipulação do objeto UserDAO
 * @author Jefferson Uchôa Ponte
 */

namespace ASPTest\dao;
use PDO;

class DAO {
 
	protected $connection;
	private $sgdb;
	    
	public function getSgdb(){
		return $this->sgdb;
	}
	public function __construct(PDO $connection = null) {
		if ($connection  != null) {
			$this->connection = $connection;
		} else {
			$this->connect();
		}
	}
	public function connect() {
		$sgdb = "sqlite";
		$dbName = "./asptest.db";		
	    $this->sgdb = $sgdb;
		$this->connection = new PDO('sqlite:'.$dbName);
	}
	public function setConnection($connection) {
		$this->connection = $connection;
	}
	public function getConnection() {
		return $this->connection;
	}
	public function closeConnection() {
		$this->connection = null;
	}
}
