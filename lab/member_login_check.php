<?php
try
{
	require_once("../common/common.php");
	$post=sanitize($_POST);
	$member_name=$post['name'];
	$member_pass=$post['pass'];

	$member_pass=md5($member_pass);

	$dsn='mysql:dbname=lab_attendance;host=localhost;charset=utf8';
	$user='root';
	$password='';
	$dbh=new PDO($dsn,$user,$password);
	$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	$sql='SELECT code,name,admin FROM mst_member WHERE name=? AND password=?';
	$stmt=$dbh->prepare($sql);
	$data[]=$member_name;
	$data[]=$member_pass;
	$stmt->execute($data);

	$dbh = null;

	$rec = $stmt->fetch(PDO::FETCH_ASSOC);

	if($rec==false)
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
		print '名前かパスワードが間違っています。<br />';
		print '<a href="../member_login.html" class="btn-border-bottom">戻る</a>';
		print '</section>';
		print '</body>';
		print '</html>';
	}
	else
	{
		session_start();
		$_SESSION['member_login']=1;
		$_SESSION['member_code']=$rec['code'];
		$_SESSION['member_name']=$rec['name'];
		$_SESSION['member_admin']=$rec['admin'];
		header('Location:mypage.php');
		exit();
	}
}
catch(Exception $e)
{
	print 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}
?>


