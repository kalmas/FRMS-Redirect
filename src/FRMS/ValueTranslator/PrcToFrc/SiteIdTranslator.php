<?php

namespace FRMS\ValueTranslator\PrcToFrc;

use FRMS\ValueTranslator\IValueTranslator;
use FRMS\Db\Mssql;

class SiteIdTranslator implements IValueTranslator {
	const STORED_PROC = '[prc].[proc_Get_PRCtoFRC_Mapped_Site_Id_And_Vanity_URL]';
	const SITE_ID_PARAM = '@PrcSiteId';
	const SITE_ID_KEY = 'Site_Id';
	
	/**
	 * @var Mssql
	 */
	private $db = null;
	
	public function __construct(Mssql $mssql){
		$this->db = $mssql;
	}
	
	/* (non-PHPdoc)
	 * @see \FRMS\ValueTranslator\IValueTranslator::translate()
	 */
	public function translate($value) {
		$return = $this->db->executeProc(self::STORED_PROC
				, array(self::SITE_ID_PARAM)
				, array(SQLINT4)
				, array($value));
		
		if(!$return){ 
			return $return;
		}
			
		return $return[0][self::SITE_ID_KEY];
	}

	
}