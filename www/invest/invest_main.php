<?php
	session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../css/main.css"> <!-- main.css 를 불러옴 -->
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
	<table>
	<tr>
		<?php
		require_once $_SERVER['DOCUMENT_ROOT'].'/function/calculate.php'; /* function에서 계산하는 php를 불러옴 */
		require_once $_SERVER['DOCUMENT_ROOT'].'/function/db_connect.php'; /* function에서 db를 연결하는 php를 불러옴 */
		$db = new DBC; /* 새로운 db생성 */
		$db->DBI(); /* 관계형 데이터베이스를 접근할 때에는 데이터베이스에 독립적인 인터페이스(Database independent interface : DBI)가 표준으로 사용된다.
		따라서 DBI를 통해서 프로그래머는 데이터베이스와 독립적으로 SQL 코드를 자신의 프로그램에서 쓸 수 있다. (DBI를 통해서 DB에 접속했다고 보면됨)
		인터페이스란? : 컴퓨팅에서 컴퓨터 시스템끼리 정보를 교환하게 할 수 있는것		
		*/
		$db->query = "SELECT * FROM invest_page"; /* query(쿼리)란 데이터베이스에 정보를 요청하는 것이다. 우변에는 요청하는 사항을 문법에 맞게 기입하면 된다.*/
		$db->DBQ(); /* query(쿼리)를 DB에 전송 */
		
		for($i = 1; $data = $db->result->fetch_assoc(); ++$i) {
		/* for문(반복문)으로 반복한다
		DB에서 위(DBQ)에서 쿼리를 보낸 결과(result)를 fetch_assoc 함수를 통해 각 row 마다 호출하여 한 row의 값을 '배열'로 받는다.
		$data['invest_num'] -> $원하는이름[DB에서 원하는 column값]
		row : 행->한 개에 관련된 데이터들의 묶음(가로), column : 열->데이터들의 한 가지의 속성(세로)
		*/
		?>
		<div>
		<form action="invest_detail.php" method="POST">
		<!-- 웹 페이지에서는 form 요소를 사용하여 사용자로부터 입력을 받을 수 있습니다. 또한, 사용자가 입력한 데이터를 서버로 보낼 때에도 form 요소를 사용합니다.
		위에서 form요소의 전달방식은 POST방식으로 action에 해당하는 페이지주소로 이동하면서 데이터를 전달한다
		GET방식: GET 방식은 주소에 데이터(data)를 추가하여 전달하는 방식입니다. 데이터가 주소 입력창에 그대로 나타나며, 전송할 수 있는 데이터의 크기 또한 제한적입니다.
				 따라서 검색 엔진의 쿼리(query)와 같이 크기가 작고 중요도가 낮은 정보를 보낼 때 주로 사용합니다.
		POST방식: POST 방식은 데이터(data)를 별도로 첨부하여 전달하는 방식입니다. 데이터가 외부에 드러나지 않으며, 전송할 수 있는 데이터의 크기 또한 제한이 없습니다.
				  따라서 보안성 및 활용성이 GET 방식보다 좋습니다.
		-->
			<input type="hidden" name="invest_num" value="<?echo $data['invest_num']?>"/>
			<input type="image" name="invest_img" src="<?php echo '/upload/'.$data['invest_image1']?>" width="200px" height="200px" value="Submit" />
		</form>
		</div>
		<tr><?php echo "제".$data['invest_num']."호"."<br />\n";?></tr> 
		<tr><?php echo "제 ".$data['invest_num']."호 ".$data['invest_name']."<br />\n";?></tr>
		<tr><?php echo $data['invest_rate']."%<br />\n"?></tr>
		<tr><?php echo $data['invest_month']."월<br />\n";?></tr>
		<tr><?php echo $data['invest_type']."<br />\n";?></tr>
		<tr><?php $money1 = won($data['invest_money1']); echo $money1."<br />\n";?></tr> <!--calculate.php 에서 won 함수를 불러온다  -->
		<tr><?php $money2 = won($data['invest_money2']); echo $money2."<br />\n";?></tr>
		<tr><?php echo $data['invest_man']."명<br />\n";?></tr>
		<tr><?php echo $data['invest_period']."일<br />\n";?></tr>
		<tr><?php echo $data['invest_limit']."까지<br />\n";?></tr>
		
		<?php
		}
		$db->DBO(); /* DatabaseOut을 통해서 DB 접속을 끊어주는것 */
		?>
	</tr>
	</table>
	<div id="div_root">
		
	</div>
	
	
</body>
</html>
