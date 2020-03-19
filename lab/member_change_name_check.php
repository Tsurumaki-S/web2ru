<?php
require_once("../common/common.php");
require_once("../common/display.php");
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
<?php subtitle("名前の変更"); ?>

<section class="content">

<?php
try
{
	$post=sanitize($_POST);
	$new_name=$post['new_name'];
	$member_pass=$post['pass'];

	if($new_name=="")
	{
		print "新しい名前が入力されていません。<br />" ;
	}

	if($member_pass == "")
	{
		print "パスワードが入力されていません。<br />";
	}

	if( $new_name=="" || $member_pass=="" )
	{
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
			print "<input type='button' onclick='history.back()' value='戻る'>";
			exit();
		}
		else
		{
			print "新しい名前：";
			print $new_name ;
			print "<br />";
			print "名前を変更してよろしいですか。";
			print '<form method="post" action="member_change_name_done.php">';
			print "<input type='hidden' name='new_name' value='".$new_name."'>";
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
