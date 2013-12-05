<?php

class JsonTest extends PHPUnit_Framework_TestCase {
	
	public function setup() {
		parent::setUp ();
		$filepath = __DIR__ . '/mockMetros.json';
		$this->db = new FRMS\Db\Json($filepath);
	}
	
	public function test_fetch() {
		$value = $this->db->fetch('alabama/montgomery');
		$this->assertEquals('AL/Greater-Montgomery.php', $value);
	}
	
	public function test_fetch_nonexistant_key_returns_null() {
		$value = $this->db->fetch('virginia/norfork');
		$this->assertEquals(null, $value);
	}
	
	public function test_fetch_numeric_key_returns_null() {
		$value = $this->db->fetch(9);
		$this->assertEquals(null, $value);
	}
	
	public function test_nonexistant_file_throws_exception_on_fetch(){
		$filepath = __DIR__ . '/no_file_here.json';
		$this->db = new FRMS\Db\Json($filepath);
		
		$caught = false;
		try {
			$value = $this->db->fetch('alabama/montgomery');
		} catch(Exception $e){
			$caught = true;
		}
		
		$this->assertTrue($caught);			
	}
	
	public function test_malformed_json_throws_exception_on_fetch(){
		$filepath = __DIR__ . '/badJson.json';
		$this->db = new FRMS\Db\Json($filepath);
	
		$caught = false;
		try {
			$value = $this->db->fetch('alabama/montgomery');
		} catch(Exception $e){
			$caught = true;
		}
	
		$this->assertTrue($caught);
	}
	
	
}