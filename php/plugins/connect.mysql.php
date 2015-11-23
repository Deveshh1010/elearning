<?php

class SyncDatabase
{
	protected $dbConnect;
	
	public function __construct()
	{
		//$hostname = 'aotkung.no-ip.info:3306';
		$hostname = 'localhost';
		$username = 'vhost';
		$password = '123456';
		$database = 'e-learning';
		try {
			$this->dbConnect = @mysql_connect($hostname, $username, $password);
			if (!$this->dbConnect) {
				throw new Exception('<strong>Error:</strong> '.mysql_error());
			} else {
				mysql_select_db($database);
				mysql_set_charset('UTF8',$this->dbConnect); 
			}
		} catch(Exception $e) {
			echo '<p>'.$e->getMessage().'</p>';
		}
	}
	
	public function Query($sqlString)
	{
		list($sqlType) = explode(' ',$sqlString);
		switch(strtolower($sqlType))
		{
			case 'select':
				$result = array();				
				try {
					$tmpQuery = @mysql_query($sqlString, $this->dbConnect);
					if(!$tmpQuery)
					{
						throw new Exception('<strong>SQL SELECT:</strong> '.mysql_error().'<br/><strong>SEL STRING:</strong> '.$sqlString);
					} else {
						while($tmpValue = mysql_fetch_array($tmpQuery))
						{
							$result[] = $tmpValue;
						}
					}
				} catch(Exception $e) {
					echo '<p>'.$e->getMessage().'</p>';
				}
				if(ereg('(limit 1)', strtolower($sqlString)) && isset($result[0]) ) { $result = $result[0]; }
				if(ereg('(count\(\*\))', strtolower($sqlString)) && isset($result[0]) ) { $result = $result[0][0]; }
				return $result;
			break;
			case 'insert':
				try {
					$tmpQuery = @mysql_query($sqlString, $this->dbConnect);
					if(!$tmpQuery)
					{
						throw new Exception('<strong>SQL INSERT:</strong> '.mysql_error().'<br/><strong>SEL STRING:</strong> '.$sqlString);
					} else {
						return mysql_insert_id($this->dbConnect);
					}
				} catch(Exception $e) {
					echo '<p>'.$e->getMessage().'</p>';
					return false;
				}
			break;
			case 'update':
				try {
					$tmpQuery = @mysql_query($sqlString, $this->dbConnect);
					if(!$tmpQuery)
					{
						throw new Exception('<strong>SQL UPDATE:</strong> '.mysql_error().'<br/><strong>SEL STRING:</strong> '.$sqlString);
					} else {
						return mysql_affected_rows($this->dbConnect);
					}
				} catch(Exception $e) {
					echo '<p>'.$e->getMessage().'</p>';
					return false;
				}
			break;
			default:
				try {
					$tmpQuery = @mysql_query($sqlString, $this->dbConnect);
					if(!$tmpQuery)
					{
						throw new Exception('<strong>SQL Query:</strong> '.mysql_error().'<br/><strong>SEL STRING:</strong> '.$sqlString);
					} else {
						return true;
					}
				} catch(Exception $e) {
					echo '<p>'.$e->getMessage().'</p>';
					return false;
				}
			break;
		}
	}

	public function __destruct()
	{
		@mysql_close($this->dbConnect);
	}
}

class ThaiDate
{
	public static function TimeStamp($isHour, $isMinute, $isDay, $isMonth, $isYear)
	{
		return mktime($isHour, $isMinute, 0, $isMonth, $isDay, $isYear);
	}
	
	public static function Full($timestamp)
	{
		$fullMonth = array(0,_January, _February, _March, _April, _Mays, _June, _July, _August, _September, _October, _November, _December);
		
		$isDay = date('d',$timestamp);
		$isMonth = date('n',$timestamp);
		$isYear = date('Y',$timestamp);
		
		return _DATE_DAY.$isDay.' '.$fullMonth[$isMonth]._DATE_PS.($isYear+543);
	}	
	
	public static function Mid($timestamp)
	{
		$fullMonth = array(0,_January, _February, _March, _April, _Mays, _June, _July, _August, _September, _October, _November, _December);
		$isDay = date('d',$timestamp);
		$isMonth = date('n',$timestamp);
		$isYear = date('Y',$timestamp);
		
		return $isDay.' '.$fullMonth[$isMonth].' '.($isYear+543);
	}
}

define("_January","มกราคม");
define("_February","กุมพาพันธ์");
define("_March","มีนาคม");
define("_April","เมษายน");
define("_Mays","พฤษภาคม");
define("_June","มิถุนายน");
define("_July","กรกฏาคม");
define("_August","สิงหาคม");
define("_September","กันยายน");
define("_October","ตุลาคม");
define("_November","พฤษจิกายน");
define("_December","ธันวาคม");
?>