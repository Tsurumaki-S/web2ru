<?php

function display_one_status($dbh,$member_code)
{
	try
	{
		$sql  = "SELECT status FROM dat_status
				 WHERE  code_member=?
				 ORDER BY time DESC LIMIT 1";
		$stmt = $dbh->prepare($sql);
		$data = array();
		$data[] = $member_code;
		$stmt->execute($data);
		$rec = $stmt->fetch(PDO::FETCH_ASSOC);
	}
	catch (Exception $e)
	{
		print "ただいま障害により大変ご迷惑をお掛けしております。";
		exit();
	}

	print "YOUR STATUS: ".$rec["status"];
}

function display_table($dbh)
{
	try
	{
		$sql  = "SELECT name,code FROM mst_member WHERE 1";
		$stmt_member = $dbh->prepare($sql);
		$stmt_member->execute();
	}
	catch (Exception $e)
	{
		print "ただいま障害により大変ご迷惑をお掛けしております。";
		exit();
	}

	print '<table>';
	print '<tr>';
	print '<th>NAME</th>';
	print '<th>STATUS</th>';
	print '<th>MEMO</th>';
	print '</tr>';
	print '<br />';
	print '<br />';
	print "MEMBER";

	while(true)
	{
		$rec_member = $stmt_member->fetch(PDO::FETCH_ASSOC);

		if($rec_member==false)
		{
			break;
		}

		$code_member = $rec_member['code'];

		$sql  = "SELECT status FROM dat_status
		         WHERE  code_member=?
				 ORDER BY time DESC LIMIT 1";
		$stmt = $dbh->prepare($sql);
		$data = array();
		$data[] = $code_member;
		$stmt->execute($data);
		$rec_status = $stmt->fetch(PDO::FETCH_ASSOC);
		$now_status = $rec_status['status'];

		$sql  = "SELECT memo FROM dat_memo
		         WHERE  code_member=?
				 ORDER BY time DESC LIMIT 1";
		$stmt = $dbh->prepare($sql);
		$data = array();
		$data[] = $code_member;
		$stmt->execute($data);
		$rec_memo = $stmt->fetch(PDO::FETCH_ASSOC);
		$now_memo = $rec_memo['memo'];
		print '<tr>';
		print '<td>';
		print $rec_member["name"];
		print '</td>';
		print '<td>';
		print $now_status;
		print '</td>';
		print '<td>';
		print $now_memo;
		print '</td>';
		print '</tr>';
	}
}

?>
