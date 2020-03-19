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

パスワードの変更<br />
<br />
<form method="post" action="member_change_pass_check1.php">
現在のパスワードを入力してください。<br />
<input type="password" name="pass" style="width:200px"><br />
<br />
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="OK">
</form>

</section>

</body>
</html>
