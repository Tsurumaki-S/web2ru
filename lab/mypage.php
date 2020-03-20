<?php
require_once("../common/common.php");
require_once("../common/display.php");
require_once("../common/sql.php");
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
<meta http-equiv="refresh" content=180; URL="mypage.php">
<title> 出欠確認表 </title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>

<!-- display subtitle -->
<?php subtitle("在室確認表"); ?>

<section class="content">

<!-- prepare sql -->
<?php $dbh=set_dbh("lab_attendance"); ?>

<!-- display my status -->
<?php display_one_status($dbh,$_SESSION['member_code']); ?>

<br />
<br />

STATUS
<br />
<form method="post" class="btn-flat-border-base" action="member_change_status.php">
	<input type="submit" class="btn-flat-border" name="new_status" value="在室" />
	<input type="submit" class="btn-flat-border" name="new_status" value="帰宅" />
	<input type="submit" class="btn-flat-border" name="new_status" value="会議" />
	<input type="submit" class="btn-flat-border" name="new_status" value="食事" />
	<input type="submit" class="btn-flat-border" name="new_status" value="出張" />
	<input type="submit" class="btn-flat-border" name="new_status" value="その他" />
</form>

MEMO
<br />
<form method="post" action="member_change_memo.php">
	<div class="centering">
	<!--<div class="centering_parent">
		<div class="centering_item">-->
			<!--<input type="text" name="new_memo" class="memo"><br />-->
			<!--<input type="submit" class="memo input_submit" value="メモ更新" />-->
			<input id="sbox5"  id="s" name="new_memo" type="text" placeholder="メモを入力" />
			<input id="sbtn5" type="submit" value="更新" />
	<!--</div>
	</div>-->
	</div>
</form>


<!-- make and display all member's status table -->
<?php display_table($dbh); ?>

<?php $dbh = null; ?>

</section>

</body>
</html>
