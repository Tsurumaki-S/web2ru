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
<?php subtitle("メンバー削除"); ?>

<section class="content">

<?php

try
{
	$dsn = "mysql:dbname=lab_attendance;host=localhost;charset=utf8";
	$user = "root";
	$password='';
	$dbh = new PDO($dsn,$user,$password);
	$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	$sql  = "SELECT code,name FROM mst_member WHERE 1";
	$stmt = $dbh->prepare($sql);
	$stmt->execute();

	$dbh  = null;

	print "削除するメンバーを選択してください。<br /><br />";

	print "<form method='post' action='member_delete_check.php'>";

	while(true)
	{
		$rec = $stmt->fetch(PDO::FETCH_ASSOC);

		if($rec==false)
		{
			break;
		}

		print "<label><input type='radio' name='member_code' value='".$rec["code"]."'>";
		print $rec["name"];
		print "</label>";
	}

	print "<br />";
	//print '<input type="button" onclick="history.back()" value="戻る">';
	print "<input type='submit' class='button-ok' name='delete' value='削除'>";
	print "</form>";
}
catch (Exception $e)
{
	print "ただいま障害により大変ご迷惑をお掛けしております。";
	exit();
}

?>

<a href="admin_setting.php" class="btn-border-bottom">戻る</a>

</section>

</body>
</html>
