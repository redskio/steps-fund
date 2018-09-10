<?php
	session_cache_limiter("private_no_expire");
	/* PHP POST 방식에서 뒤로가기 지원하기
	session_start(); 함수가 실행되기 이전에 session_cache_limiter("private_no_expire"); 함수를 호출해야 한다.
	이 소스코드를 삽입하게 되면 Post로 전달받은 웹 페이지도 [뒤로가기]를 통해서 볼 수 있다.
	반드시 보안이슈를 확인하여야 한다.
	*/
	session_start();
	$invest_num = $_POST["invest_num"];
	$charge = $_POST["charge"];
	require_once $_SERVER['DOCUMENT_ROOT'].'/function/calculate.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/function/db_connect.php';
	$db = new DBC;
	$db->DBI();
	$db->query = "SELECT * FROM invest_page where invest_num='$invest_num'";
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
	<div>
	--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	</div>
	<div>
	<?php echo "제 ".$data['invest_num']."호 ".$data['invest_name']."<br />\n";?>
	</div>
	<?php
		$db->query = "SELECT * FROM member where id='".$_SESSION['ses_userid']."'";
		$db->DBQ();
		$data = $db->result->fetch_assoc();
	?>
	<div><?php echo "가능 투자금액 : 5000000원"?></div>
	<div><?php echo "남은 투자금액 : ".((int)$charge*10000)."원";?></div>
	<div><?php echo "예치금 잔액 : ".$data['cash']."원";?></div>
	<div>투자하기</div>
	<form name="invest_form" method="post" action="../invest/invest_finish.php" onsubmit="return check()">
		<input type="hidden" name="invest_num" value="<?echo $invest_num;?>"/>
		<input type="hidden" name="cash" value="<?echo (int)$data['cash'];?>"/>
		<div>예치금 <input type="text" name="invest_money" value="0" /> 원</div> <!-- onKeyPress="return numkeyCheck(event)" 숫자만 입력-->
		<div><input type="submit" value="투자 신청"/></div>
	</form>
	
</body>
</html>
<script>

function check() {

  if(invest_form.invest_money.value == "") {

    alert("값을 입력해 주세요.");

    fr.cash.focus();

    return false;

  }else if(invest_form.invest_money.value <= 0){
	alert("0원보다 큰 값을 입력해 주세요.");

    fr.cash.focus();

    return false;
  }

  else return true;

}
<!--숫자만 입력-->
function numkeyCheck(e){
	var keyValue = event.keyCode;
	if( ((keyValue >= 48) && (keyValue <= 57)) )
		return true;
	else return false; 
}

</script>