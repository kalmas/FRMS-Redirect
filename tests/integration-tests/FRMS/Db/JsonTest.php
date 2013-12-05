<?php

class JsonTest extends PHPUnit_Framework_TestCase {
	
	public function setup() {
		parent::setUp ();
		$filepath = __DIR__ . '/mockMetros.json';
		$this->db = new FRMS\Db\Json($filepath);
	}
	
	public function testFetch() {
		$value = $this->db->fetch('alabama/montgomery');
		$this->assertEquals('AL/Greater-Montgomery.php', $value);
	}
	
	
}