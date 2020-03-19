<?php
header('Location:mypage.php');
require_once("../common/common.php");
session_start();
session_regenerate_id(true);
if(isset($_SESSION["member_login"])==false)
{ msg_out_session(); }
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title> 出欠確認表 </title>
</head>
<body>

<?php

try
{
	/* recieve data (modified ver.) */
	$post=sanitize($_POST);
	$new_status=$post["new_status"];
	
	$dsn  = "mysql:dbname=lab_attendance;host=localhost;charset=utf8" ;
	$user = "root";
	$password='';
	$dbh  = new PDO($dsn, $user, $password);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	/* lock */
	$sql='LOCK TABLES dat_status WRITE';
	$stmt=$dbh->prepare($sql);
	$stmt->execute();
	
	$sql    = "INSERT INTO dat_status(code_member,status) VALUES (?,?)";
	$stmt   = $dbh->prepare($sql);
	$data=array();
	$data[] = $_SESSION['member_code'];
	$data[] = $new_status;
	$stmt->execute($data);
	
	/* unlock */
	$sql='UNLOCK TABLES';
	$stmt=$dbh->prepare($sql);
	$stmt->execute();

	exit();
}
catch(Exception $e)
{
	print "ただいま障害により大変ご迷惑をおかけしております。";
	exit();
}

?>

</body>
</html>
