<?php
namespace FRMS\Db;

class Json {
	
	private $filepath;
	private $data = null;
	
	public function __construct($filepath) {
		$this->filepath = $filepath;
	}
	
	/**
	 * Build an associative array from JSON file
	 * @throws \Exception
	 * @return array
	 */
	private function getArray(){
		if(is_null($this->data)) {
			$string = file_get_contents($this->filepath);
			if(!$string){ throw new \Exception('File Read Failed'); }
			
			$obj = json_decode($string, true);
			if(!$obj){ throw new \Exception('JSON Parse Failed'); }
			
			$this->data = $obj;
		}
		
		return $this->data;
	}
	
	/**
	 * Return the value associated with provide key, or null if not found
	 * @param $key
	 * @return string|int|null
	 */
	public function fetch($key){
		$array = $this->getArray();
		return $array[$key];
	}

}
