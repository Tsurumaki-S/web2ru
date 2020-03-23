<?php
require_once("../common/common.php");
session_start();
session_regenerate_id(true);
if(isset($_SESSION["member_login"])==false)
msg_out_session(); else msg_in_session();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width">
<title> 出欠確認表 </title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>

<!-- display subtitle -->
<?php subtitle("メンバー追加"); ?>

<section class="content">

<?php

try
{
	$member_name = $_POST["name"];
	$member_pass = $_POST["pass"];
	$member_admin = $_POST["admin"];

	$dsn  = "mysql:dbname=lab_attendance;host=localhost;charset=utf8" ;
	$user = "root";
	$password='';
	$dbh  = new PDO($dsn, $user, $password);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	/* lock */
	$sql='LOCK TABLES mst_member WRITE,dat_status WRITE,dat_memo WRITE';
	$stmt=$dbh->prepare($sql);
	$stmt->execute();

	$sql    = "INSERT INTO mst_member(name,password,admin) VALUES (?,?,?)";
	$stmt   = $dbh->prepare($sql);
	$data=array();
	$data[] = $member_name;
	$data[] = $member_pass;
	$data[] = $member_admin;
	$stmt->execute($data);

	$sql='SELECT LAST_INSERT_ID()';
	$stmt=$dbh->prepare($sql);
	$stmt->execute();
	$rec=$stmt->fetch(PDO::FETCH_ASSOC);
	$lastmembercode=$rec['LAST_INSERT_ID()'];
	//print $lastmembercode; // DEBUG

	$sql    = "INSERT INTO dat_status(code_member) VALUES (?)";
	$stmt   = $dbh->prepare($sql);
	$data=array();
	$data[] = $lastmembercode;
	$stmt->execute($data);

	$sql    = "INSERT INTO dat_memo(code_member,memo) VALUES (?,?)";
	$stmt   = $dbh->prepare($sql);
	$data=array();
	$data[] = $lastmembercode;
	$data[] = "";
	$stmt->execute($data);

	/* unlock */
	$sql='UNLOCK TABLES';
	$stmt=$dbh->prepare($sql);
	$stmt->execute();

	$dbh = null;

	print $member_name;
	print "さんを追加しました。<br />";
}
catch(Exception $e)
{
	print "ただいま障害により大変ご迷惑をおかけしております。";
	exit();
}

?>

<a href="mypage.php" class="btn-border-bottom">トップページへ</a>

</section>

</body>
</html>
