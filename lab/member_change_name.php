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

<?php subtitle("名前の変更"); ?>

<section class="content">

	<form method="post" action="member_change_name_check.php">
		新しい名前を入力してください。<br />
		<input type="text" name="new_name" style="width:200px"><br />
		パスワードを入力してください。<br />
		<input type="password" name="pass" style="width:200px"><br />
		<br />
		<input type="button" onclick="history.back()" value="戻る">
		<input type="submit" value="OK">
	</form>

</section>

</body>
</html>
