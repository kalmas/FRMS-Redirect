<?php
namespace FRMS\Db;

class Mssql {
	
	private $host;
	private $database;
	private $user;
	private $pass;
	private $connection = null;
	
	public function __construct($host, $database, $user, $pass) {
		$this->host = $host;
		$this->database = $database;
		$this->user = $user;
		$this->pass = $pass;
	}
	
	private function getConnection() {
		if(is_null($this->connection)) {
			$conn = mssql_pconnect($this->host, $this->user, $this->pass);
			if(!$conn){ throw new \Exception('Database Connection Failed'); }

			$db_select = @mssql_select_db($this->database, $conn);
			if(!$db_select){ throw new \Exception('Invalid Database'); }
			
			$this->connection = $conn;
		}
		return $this->connection;	
	}
	
	/**
	 * Execute stored procedure
	 * @param string $procName
	 * @param array $names
	 * @param array $types
	 * @param array $values
	 * @return boolean|array
	 */
	public function executeProc($procName, array $names, array $types, array $values) {
		$conn = $this->getConnection();
		$stmt = mssql_init($procName, $conn);
		
		for($i = 0; $i < count($names); $i++){
			mssql_bind($stmt, $names[$i], $values[$i], $types[$i]);
		}
		
		$result = mssql_execute($stmt);
		mssql_free_statement($stmt);
		return $this->translateResultObjToArray($result);
	}
	
	/**
	 * Convert MSSQL Result object to an array of associative arrays
	 * Frees result
	 * @param resource $result
	 * @param boolean $freeResult
	 * @return boolean|array
	 */
	public function translateResultObjToArray($result) {
		$data = array();
		if(!is_resource($result)){
			return false;
		}
		
		while($row = mssql_fetch_assoc($result)) {
			$data[] = $row;
		}
		
		mssql_free_result($result);
		return $data;
	}

	
	
}