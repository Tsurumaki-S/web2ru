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
<title> 出欠確認表 </title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>

<!-- display subtitle -->
<?php subtitle("パスワード変更"); ?>

<section class="content">

<?php

try
{
	$new_pass = $_POST["new_pass"];
	$new_pass=md5($new_pass);

	$dsn  = "mysql:dbname=lab_attendance;host=localhost;charset=utf8" ;
	$user = "root";
	$password='';
	$dbh  = new PDO($dsn, $user, $password);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql    = "UPDATE mst_member SET password=? WHERE code=?";
	$stmt   = $dbh->prepare($sql);
	$data[] = $new_pass;
	$data[] = $_SESSION['member_code'];
	$stmt->execute($data);

	$dbh = null;

	print "パスワードを変更しました。<br /><br />";
}
catch(Exception $e)
{
	print "ただいま障害により大変ご迷惑をおかけしております。";
	exit();
}

?>

<a href="mypage.php">戻る</a>

</section>
</body>
</html>
