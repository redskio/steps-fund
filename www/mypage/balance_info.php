<?php
	session_cache_limiter("private_no_expire");

	session_start();
	require_once $_SERVER['DOCUMENT_ROOT'].'/function/calculate.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/function/db_connect.php';
	$db = new DBC;
	$db->DBI();
	$db->query = "SELECT * FROM member where id='".$_SESSION['ses_userid']."'";
	$db->DBQ();
	$data = $db->result->fetch_assoc();
?>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../css/main.css">

<title>스탭스 펀딩</title>


</head>

<body>
	<div id="div_top">
		<?echo $_SESSION['ses_userid'].'님 안녕하세요';?>
		<button type="button" onclick="location.href='../member/join.php' ">회원가입</button>
		<button type="button" onclick="location.href='../member/guide_add.html' ">가이드등록</button>
		<button type="button" onclick="location.href='../mypage/mypage.php' ">내정보</button>
		<button type="button" onclick="location.href='../member/login.php' ">로그인</button>
		<button type="button" onclick="location.href='../member/logout.php' ">로그아웃</button>
	</div>
	<div id="div_info">
		<button type="button" onclick="location.href='../invest/invest_main.php' ">투자하기</button>
	</div>
	<div id="div_menu">
		<div>
		<button type="button" onclick="location.href='./dash_board.php' ">대쉬보드</button>
		</div>
		<div>
		<button type="button" onclick="location.href='./invest_info.php' ">투자내역</button>
		</div>
		<div>
		<button type="button" onclick="location.href='./balance_info.php' ">예치금내역</button>
		</div>
		<div>
		<button type="button" onclick="location.href='./member_info.php' ">회원정보수정</button>
		</div>
		<div>
		<button type="button" onclick="location.href='../member/logout.php' ">로그아웃</button>
		</div>
	</div>

	
</body>
</html>
