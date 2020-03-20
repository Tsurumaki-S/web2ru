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
<?php subtitle("パスワード変更"); ?>

<section class="content">
<?php
try
{
	$post=sanitize($_POST);
	$member_pass=$post['pass'];

	if($member_pass == "")
	{
		print "パスワードが入力されていません。<br />";
		print "<form>";
		print "<input type='button' onclick='history.back()' value='戻る'>";
		print "</form>";
		exit();
	}
	else
	{
		$member_pass=md5($member_pass);

		$dsn='mysql:dbname=lab_attendance;host=localhost;charset=utf8';
		$user='root';
		$password='';
		$dbh=new PDO($dsn,$user,$password);
		$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

		$sql='SELECT name FROM mst_member WHERE code=? AND password=?';
		$stmt=$dbh->prepare($sql);
		$data[]=$_SESSION['member_code'];
		$data[]=$member_pass;
		$stmt->execute($data);

		$dbh = null;

		$rec = $stmt->fetch(PDO::FETCH_ASSOC);

		if($rec==false)
		{
			print 'パスワードが間違っています。<br />';
			print '<a href="../member_login.html" class="btn-border-bottom">戻る</a>';
			exit();
		}
		else
		{
			print 'パスワードの変更<br />';
			print '<br />';
			print '<form method="post" action="member_change_pass_check2.php">';
			print '新しいパスワードを入力してください。<br />';
			print '<input type="password" name="pass1" style="width:200px"><br />';
			print '再度、新しいパスワードを入力してください。<br />';
			print '<input type="password" name="pass2" style="width:200px"><br />';
			print '<br />';
			print '<input type="button" onclick="history.back()" value="戻る">';
			print '<input type="submit" value="OK">';
			print '</form>';
		}
	}
}
catch(Exception $e)
{
	print 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}
?>

</section>

</body>
</html>
