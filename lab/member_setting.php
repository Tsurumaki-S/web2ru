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
<?php subtitle("設定"); ?>

<section class="content">
<a href="member_change_name.php">名前変更</a><br />
<br />
<a href="member_change_pass.php">パスワード変更</a><br />
<br />
<br />
<br />
<a href="mypage.php" class="btn-border-bottom">戻る</a><br />
</section>

</body>
</html>
