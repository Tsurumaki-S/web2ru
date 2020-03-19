<?php

function set_dbh($dbname)
{
	try
	{
		$dsn = "mysql:dbname=".$dbname.";host=localhost;charset=utf8";
		$user = "root";
		$password = "";
		$dbh = new PDO($dsn,$user,$password);
		$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

		return $dbh;
	}
	catch (Exception $e)
	{
		print "ただいま障害により大変ご迷惑をお掛けしております。";
		exit();
	}

	}

?>
