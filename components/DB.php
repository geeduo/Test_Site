<?php
namespace components;
use config\ConnectSettings;
use PDO;

class DB
{
	public static function getConnection()
	{
		$db = null;
    	$host = ConnectSettings::$host;
    	$db_name = ConnectSettings::$db_name;
    	$db_user = ConnectSettings::$db_user;
    	$db_pass = ConnectSettings::$db_pass;

    	if (is_null($db)) {
        	try {
    	$db = new PDO('mysql:host='.$host.';dbname='.$db_name.';charset=utf8', $db_user, $db_pass);
    	}
    	catch (PDOException $e) {
    	die($e->getMessage());
    	}
    	return $db;
    	}
    }
}