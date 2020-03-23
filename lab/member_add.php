<?php
require_once("../common/common.php");
session_start();
session_regenerate_id(true);
/* check login or not */
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

<form method="post" action="member_add_check.php">
メンバー名を入力してください。<br />
<input type="text" name="name" style="width:200px"><br />
初期パスワードを入力してください。<br />
<input type="password" name="pass" style="width:200px"><br />
初期パスワードを再度入力してください。<br />
<input type="password" name="pass2" style="width:200px"><br />
管理者権限を付与しますか。<br />
<input type="radio" name="admin" value="1">はい
<input type="radio" name="admin" value="0" checked>いいえ<br />
<br />
<!--<input type="button" onclick="history.back()" value="戻る">-->
<input type="submit" class="button-ok" value="OK">
</form>

<a href="admin_setting.php" class="btn-border-bottom">戻る</a>

</section>
</body>
</html>
