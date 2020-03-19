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
	$member_code = $_POST["member_code"];

	$dsn      = "mysql:dbname=lab_attendance;host=localhost;charset=utf8";
	$user     = "root";
	$password='';
	$dbh      = new PDO($dsn,$user,$password);
	$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	$sql    = "SELECT name FROM mst_member WHERE code=?";
	$stmt   = $dbh->prepare($sql);
	$data[] = $member_code;
	$stmt->execute($data);

	$rec = $stmt->fetch(PDO::FETCH_ASSOC);
	$member_name = $rec["name"];

	$dbh = null;

}
catch(Exception $e)
{
	print "ただいま障害により大変ご迷惑をお掛けしております。";
	exit();
}

?>

<br />
メンバー名<br />
<?php print $member_name; ?>
<br />
<br />
このメンバーを削除してよろしいですか？<br />
<br />
<form method="post" action="member_delete_done.php">
<input type="hidden" name="code" value="<?php print $member_code; ?>">
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">
</form>

</section>

</body>
</html>
