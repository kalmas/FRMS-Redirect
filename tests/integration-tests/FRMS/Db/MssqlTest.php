<?php

class MssqlTest extends PHPUnit_Framework_TestCase {
	
	public function setup() {
		parent::setUp ();
		
		$app = new Silex\Application();
		$app->register(new Igorw\Silex\ConfigServiceProvider(__DIR__ . '/../../../../config.json'));
		
		$this->db = new \FRMS\Db\Mssql($app['config']['db']['host']
				, $app['config']['db']['database']
				, $app['config']['db']['user']
				, $app['config']['db']['pass']
			);
	}
	
	public function test_executeProc() {
		$return = $this->db->executeProc('[prc].[proc_Get_PRCtoFRC_Mapped_Site_Id_And_Vanity_URL]'
				, array('@PrcSiteId')
				, array(SQLINT4)
				, array(1000008758));
		
		$this->assertCount(1, $return);
		$this->assertCount(2, $return[0]);
		$this->assertEquals(1005116, $return[0]['Site_Id']);
		$this->assertEquals('willows', $return[0]['PRC_Vanity_Name']);
	}
	
	public function test_executeProc_nonexistant_record() {
		$return = $this->db->executeProc('[prc].[proc_Get_PRCtoFRC_Mapped_Site_Id_And_Vanity_URL]'
				, array('@PrcSiteId')
				, array(SQLINT4)
				, array(7777777)
			);
	
		$this->assertFalse($return);
	}
	
	public function test_executeProc_invalid_param() {
		$return = $this->db->executeProc('[prc].[proc_Get_PRCtoFRC_Mapped_Site_Id_And_Vanity_URL]'
				, array('@PrcSiteId')
				, array(SQLINT4)
				, array('aint_no_int')
		);
	
		$this->assertFalse($return);
	}
	
}