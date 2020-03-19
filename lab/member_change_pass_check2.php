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
	$post=sanitize($_POST);
	$new_pass1=$post['pass1'];
	$new_pass2=$post['pass2'];

	if($new_pass1 == "" || $new_pass2 == "")
	{
		print "新しいパスワードが２度入力されていません。<br />";
		print "<form>";
		print "<input type='button' onclick='history.back()' value='戻る'>";
		print "</form>";
		exit();
	}
	if($new_pass1 != $new_pass2)
	{
		print "新しいパスワードの1度目の入力内容と2度目の入力内容が異なります。<br />";
		print "<form>";
		print "<input type='button' onclick='history.back()' value='戻る'>";
		print "</form>";
		exit();
	}
	else
	{
		print "パスワードを変更してよろしいですか。";
		print '<form method="post" action="member_change_pass_done.php">';
		print "<input type='hidden' name='new_pass' value='".$new_pass1."'>";
		print '<input type="button" onclick="history.back()" value="戻る">';
		print '<input type="submit" value="OK">';
		print '</form>';
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
