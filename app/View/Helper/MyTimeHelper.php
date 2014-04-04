<?php
App::uses('TimeHelper', 'View/Helper');

/* Class MyTimeHelper */
/* Version 0.1 */
/* Date : 04-04-2014 */
/* Utilities to complete and simplify the cakephp TimeHelper */
/* Author : Nicolas HENRY */
/* Site : http://www.nicolas-henry.fr */
/* GitHub : https://github.com/Nicolas-Henry */

/* showStringDate method = It will display a date (in string format) without having to know the date format in php */
/* convertSqlDateToIso = It will convert a standard date (sql format : yyyy-mm-dd HH:MM:SS) to Iso 8601 date format */

class MyTimeHelper extends TimeHelper {
	
	/*  function showStringDate
	 *
	 *  return date in french, english, spanish ... format
	 *
	 *  Parameters:
	 *  	$isoDate (required)						: ISO 8601 date
	 *  	$longFormat	(default = false)			: if true lundi 08 juillet 2013 // if false 08/07/2013
	 *		$showTime (default = false)				: if true show time : lundi 08 juillet 2013 12:42 // if false lundi 08 juillet 2013
	 *		$gmt (default = 0)						: integer (2 = gmt +2)
	 *		$datetimeSeparator (default = " ")		: separator string between date and time
	 *
	 *	Requirements :
	 *		Only Works windows server !!! Warning : This uses the internal functions of management time operating system Windows
	 *		setlocale(LC_TIME, $language) must be defined in bootstrap.php
	*/
	public function showStringDate($isoDate, $longFormat = false, $showTime = false, $gmt = 0, $datetimeSeparator = " ") {
		if(empty($isoDate)) {
			return null;
		}
		
		// format date (differents languages)
		if($longFormat) {
			$formatDateTime = "%#x";	// long format - eg : lunes, 08 de julio de 2013
		}
		else {
			$formatDateTime = "%x";		// short format - eg : 08/07/2013
		}
		
		$formatDateTime .= $datetimeSeparator;
		
		if($showTime) {
			$formatDateTime .= "%T";	// time : eg : 16:19:57
		}
		
		// compose date string (translated)
		$timeString = strtotime($isoDate);
		$result = $this->i18nFormat($timeString, $formatDateTime, null, $gmt);
		
		return $result;
	}
	
	/* function convertSqlDateToIso
	 *
	 *	return a convertion of SqlDate (eg 2008-10-27 14:52:00) to Iso 8601 format date
	 *
	 *	Parameters:
	 *		$sqlDate
	 *		
	*/
	public function convertSqlDateToIso($sqlDate) {
			$isoDate = date("c",strtotime($sqlDate));
			
			return $isoDate;
	}
}