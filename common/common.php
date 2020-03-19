<?php

function sanitize($before)
{
	foreach($before as $key=>$value)
	{
		$after["$key"]=htmlspecialchars($value,ENT_QUOTES,"UTF-8");
	}
	return $after;
}

function pulldown_year()
{
	print'<select name="year">';
	print'<option value="2017">2017</option>';
	print'<option value="2018">2018</option>';
	print'<option value="2019">2019</option>';
	print'<option value="2020">2020</option>';
	print'</select>';
}

function pulldown_month()
{
	print'<select name="month">';
	print'<option value="01">01</option>';
	print'<option value="02">02</option>';
	print'<option value="03">03</option>';
	print'<option value="04">04</option>';
	print'<option value="05">05</option>';
	print'<option value="06">06</option>';
	print'<option value="07">07</option>';
	print'<option value="08">08</option>';
	print'<option value="09">09</option>';
	print'<option value="10">10</option>';
	print'<option value="11">11</option>';
	print'<option value="12">12</option>';
	print'</select>';
}

function pulldown_day()
{
	print'<select name="day">';
	print'<option value="01">01</option>';
	print'<option value="02">02</option>';
	print'<option value="03">03</option>';
	print'<option value="04">04</option>';
	print'<option value="05">05</option>';
	print'<option value="06">06</option>';
	print'<option value="07">07</option>';
	print'<option value="08">08</option>';
	print'<option value="09">09</option>';
	print'<option value="10">10</option>';
	print'<option value="11">11</option>';
	print'<option value="12">12</option>';
	print'<option value="13">13</option>';
	print'<option value="14">14</option>';
	print'<option value="15">15</option>';
	print'<option value="16">16</option>';
	print'<option value="17">17</option>';
	print'<option value="18">18</option>';
	print'<option value="19">19</option>';
	print'<option value="20">20</option>';
	print'<option value="21">21</option>';
	print'<option value="22">22</option>';
	print'<option value="23">23</option>';
	print'<option value="24">24</option>';
	print'<option value="25">25</option>';
	print'<option value="26">26</option>';
	print'<option value="27">27</option>';
	print'<option value="28">28</option>';
	print'<option value="29">29</option>';
	print'<option value="30">30</option>';
	print'<option value="31">31</option>';
	print'</select>';
}


function msg_out_session()
{
		print '<!DOCTYPE html>';
		print '<html>';
		print '<head>';
		print '<meta charset="UTF-8">';
		print '<meta name="viewport" content="width=device-width">';
		print '<title> 出欠確認表 </title>';
		print '<link rel="stylesheet" href="../css/style.css">';
		print '</head>';
		print '<body>';
		print '<section class="content">';
		print "セッションが切れました。<br />";
		print "<a href='../member_login.html'>ログイン画面へ</a><br />";
		print '</section>';
		print '</body>';
		print '</html>';
	exit();
}


function msg_in_session()
{
	print 'ようこそ、';
	print $_SESSION["member_name"];
	print "&nbsp;";
	print '様';
	print '<br />';
	print '<a href="mypage.php">トップページ</a>';
	print "&emsp;";
	print '<a href="member_setting.php">設定</a>';
	print "&emsp;";
	if($_SESSION['member_admin']==1)
	{
		print '<a href="admin_setting.php">設定(管理者)</a>';
	}
	print "&emsp;";
	print '<a href="member_logout.php">ログアウト</a>';
	print '<br />';
}

function subtitle($str)
{
	print '<div class="container">';
	print '<header>';
	print '<h1>Web-2ru</h1>';
	print '</header>';
	print '<section class="information">';
	print '<h1>'.$str.'</h1>';
	print '</section>';
	print '</div>';
}

?>
