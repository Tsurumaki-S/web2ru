<?php
require_once("../common/common.php");
session_start();
$_SESSION=array();
if(isset($_COOKIE[session_name()])==true)
{
	setcookie(session_name(),'',time()-42000,'/');
}
session_destroy();
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
<?php subtitle("&nbsp;"); ?>

<section class="content">


ログアウトしました。<br />
<br />
<a href="../member_login.html" class="btn-border-bottom">ログイン画面へ</a>

</section>
</body>
</html>
