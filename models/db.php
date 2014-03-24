<?php
//database connection

class DB {
	
	public $cnn;
	
	function __construct() {
		if (strpos($_SERVER['HTTP_HOST'], "local") === false) {
			//server
			$this->dbserver = "mysql51-054.wc2.dfw1.stabletransit.com";	
		} else {
			//local server
			$this->dbserver = "72.32.40.35";	
		}
		$this->dbusername = "512772_uclasoc";
		$this->dbpassword = "J@pan2014$";
		$this->dbname = "512772_uclasoccer";
	}

	function openConn() {
		$this->cnn = mysql_connect($this->dbserver, $this->dbusername, $this->dbpassword);
		mysql_select_db($this->dbname);
		
		//add error handling and error message here, return error if applicable
		
		return $this->cnn;
	}
	
	function closeConn($cnn) {
	
		mysql_close($cnn);
	}
	
	//pass query
	function query($query) {

    	$rst = mysql_query($query);
    	
    	//add error handling and error message here, return error if applicable
    	
    	return $rst;
	}
}




















?>