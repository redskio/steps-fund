<?
	require_once $_SERVER['DOCUMENT_ROOT'].'/function/session.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/function/db_connect.php';
	$db = new DBC;
	$db->DBI();
?>
<meta charset="UTF-8" />

<?php

	$memberId = $_POST['memberId'];
	$memberPw = md5($memberPw = $_POST['memberPw']);
	$db->query = "select id, password from member where id='".$memberId."' and password='".$memberPw."'";
	$db->DBQ();

	$num = $db->result->num_rows;
	$data = $db->result->fetch_row();
	$db->DBO();
	if($num==1)
	{
		$_SESSION['ses_userid'] = $data[0];
		echo("<script>location.replace('../index.html');</script>");
	} else
	{
		echo "<script>alert('아이디와 비밀번호를 확인하세요');history.back(-2);</script>";
	} 

?>