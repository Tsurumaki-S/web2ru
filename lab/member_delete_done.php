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
<?php subtitle("メンバー削除"); ?>

<section class="content">

<?php

try
{
	$member_code = $_POST["code"];

	$dsn  = "mysql:dbname=lab_attendance;host=localhost;charset=utf8" ;
	$user = "root";
	$password='';
	$dbh  = new PDO($dsn, $user, $password);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql    = "DELETE FROM mst_member WHERE code=?";
	$stmt   = $dbh->prepare($sql);
	$data[] = $member_code;
	$stmt->execute($data);

	$dbh = null;

}
catch(Exception $e)
{
	print "ただいま障害により大変ご迷惑をおかけしております。";
	exit();
}

?>

削除しました。<br />
<br />

<a href="mypage.php">戻る</a>

</section>

</body>
</html>
