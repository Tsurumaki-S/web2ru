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

require_once("../common/common.php");

/* recieve data (modified ver.) */
$post=sanitize($_POST);
$member_name=$post["name"];
$member_pass=$post["pass"];
$member_pass2=$post["pass2"];
$member_admin=$post["admin"];

if($member_name=="")
{
	print "メンバー名が入力されていません。<br />" ;
}
else
{
	print "メンバー名：";
	print $member_name ;
	print "<br />";
}

if($member_pass == "")
{
	print "パスワードが入力されていません。<br />";
}

if($member_pass != $member_pass2)
{
	print "パスワードが一致しません。<br />";
}

if($member_name=="" || $member_pass=="" || $member_pass != $member_pass2)
{
	print "<form>";
	print "<input type='button' onclick='history.back()' value='戻る'>";
	print "</form>";
}
else
{
	$member_pass=md5($member_pass);
	print "<form method='post' action='member_add_done.php'>";
	print "<input type='hidden' name='name'  value='".$member_name."'>";
	print "<input type='hidden' name='pass'  value='".$member_pass."'>";
	print "<input type='hidden' name='admin' value='".$member_admin."'>";
	print "<br />";
	print "<input type='button' onclick='history.back()' value='戻る'>";
	print "<input type='submit' value='OK'>";
	print "</form>";
}

?>

</section>

</body>
</html>
