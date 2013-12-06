<?php

use FRMS\ValueTranslator\PrcToFrc\SiteIdTranslator;

class SiteIdTranslatorTest extends PHPUnit_Framework_TestCase {

	public function test_translate() {
		
		$mssqlMock = $this->getMockBuilder('FRMS\Db\Mssql')
			->disableOriginalConstructor()
			->setMethods(array('executeProc'))
			->getMock();
		$mssqlMock->expects($this->once())
			->method('executeProc')
			->with($this->equalTo('[prc].[proc_Get_PRCtoFRC_Mapped_Site_Id_And_Vanity_URL]')
					, $this->equalTo(array('@PrcSiteId'))
					, $this->equalTo(array(SQLINT4))
					, $this->equalTo(array(1234567))
				)
			->will($this->returnValue(array(array('Site_Id' => 7654321
					, 'PRC_Vanity_Name' => 'willow'
				))
			));
		
		$translator = new SiteIdTranslator($mssqlMock);
		$val = $translator->translate('1234567');
		
		$this->assertEquals(7654321, $val);
	}
	
	public function test_translate_nonexistiant_site() {
		
		$mssqlMock = $this->getMockBuilder('FRMS\Db\Mssql')
			->disableOriginalConstructor()
			->setMethods(array('executeProc'))
			->getMock();
		$mssqlMock->expects($this->once())
			->method('executeProc')
			->with($this->equalTo('[prc].[proc_Get_PRCtoFRC_Mapped_Site_Id_And_Vanity_URL]')
					, $this->equalTo(array('@PrcSiteId'))
					, $this->equalTo(array(SQLINT4))
					, $this->equalTo(array(7777777))
				)
			->will($this->returnValue(false));
		
		$translator = new SiteIdTranslator($mssqlMock);
		$val = $translator->translate('7777777');
		
		$this->assertFalse($val);
	}

}