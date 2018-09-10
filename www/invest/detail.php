<?php
	session_cache_limiter("private_no_expire");
	session_start();
	$invest_num = $_GET["invest_num"];
	require_once $_SERVER['DOCUMENT_ROOT'].'/function/calculate.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/function/db_connect.php';
	$db = new DBC;
	$db->DBI();
	$db->query = "SELECT * FROM invest_page where invest_num='$invest_num'";
	/*쿼리에 바로 변수를 넣으면 인식하지 못한다. 다음과 같이 '$invest_num' 변수 바깥에 ''을 입력하면 인식된다.
	$invest_num -> '$invest_num'
	*/
	$db->DBQ();
	$data = $db->result->fetch_assoc();
?>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>스탭스펀드-차이를 만들다</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/half-slider.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

	<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=fd2efbad9ac66ea21effa0f9bf8b9983&libraries=services"></script>
	
    <!-- Custom styles for this template 수정필요-->
    <link href="../css/agency.css" rel="stylesheet">
	<link href="../css/detail.css" rel="stylesheet">
  </head>

  <body id="page-top">
	<!--네비게이션바 navbar-expand-lg 화면크기에 따라 탄력적으로 반응 일정크기 이상이면 가로, 이하면 세로로 배치된다
					 fixed-top 네비게이션바가 계속 화면 위에 배치된다  
					 navbar-dark 네비게이션바의 글자색(navbar-dark는 흰색)-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
	  <!--컨테이너 -->	
      <div class="container">
	    <!--navbar-brand 네비게이션바에서 로고를 쓰고 싶을떄 사용한다.
		참고 : js-scroll-trigger 맨위로 올라가게 하는 용도(필요없어서 삭제)
		-->
        <a class="navbar-brand" href="../"><img src="../upload/steps_logo.jpg" width='70px'> STEPS FUND</a> 
		
		<!-- 부트스트랩 내비게이션바 : 화면크기가 줄었을때 생기는 메뉴(반응형) :  navbar-toggle
		data-target, aria-controls : id가 navbarResponsive인 클래스의 크기가 달라졌을때 반응한다
		-->
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
		<!-- 부트스트랩 내비게이션바 : 화면크기가 커졌을때 원래 메뉴로 돌아온다(반응형) : navbar-collapse -->
        <div class="collapse navbar-collapse" id="navbarResponsive">
		<!-- text-uppercase 모든문자를 대문자로 바꿈(필요없어서 삭제)
		ml-auto : 네비게이션바를 화면 오른쪽으로 배치한다-->
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="/invest/?page=1">투자하기</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="">대출받기</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="">이용안내</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="">회사소개</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="">로그인</a>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="">회원가입</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
	<section class="bg-light" >
	<div>
		<div id="investNum">
			<label class="detail_num"><?php echo "제".$data['invest_num']."호";?></label>
		</div>
		<div id="investTitle">
			<h1><? echo "제 ".$data['invest_num']."호 ".$data['invest_name'];?></h1>
		</div>
		<div id="investMoney">
			<label><? echo number_format($data['invest_money1'])."원";?></label>
		</div>
		<div id="investTime">
			<label><? echo $data['invest_limit'];?></label>
		</div>
		<div style="height:40px;">
		</div>
	</div>
	<div>
		<div class="progress-bar" role="progressbar" style="width: 100%" aria-valuemin="0" aria-valuemax="100">
		<div class="progress-value">100%</div>
		</div>
	</div>
	<div id="map" style="width:500px;height:400px;"></div>
	
	<script>
		var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
			mapOption = {
				center: new daum.maps.LatLng(33.450701, 126.570667), // 지도의 중심좌표
				level: 3 // 지도의 확대 레벨
			};  

		// 지도를 생성합니다    
		var map = new daum.maps.Map(mapContainer, mapOption); 

		// 주소-좌표 변환 객체를 생성합니다
		var geocoder = new daum.maps.services.Geocoder();
		var address = '<?echo $data['invest_address1']; ?>';
		// 주소로 좌표를 검색합니다
		geocoder.addressSearch(address, function(result, status) {

			// 정상적으로 검색이 완료됐으면 
			 if (status === daum.maps.services.Status.OK) {

				var coords = new daum.maps.LatLng(result[0].y, result[0].x);

				// 결과값으로 받은 위치를 마커로 표시합니다
				var marker = new daum.maps.Marker({
					map: map,
					position: coords
				});

				// 인포윈도우로 장소에 대한 설명을 표시합니다
				var infowindow = new daum.maps.InfoWindow({
					content: '<div style="width:200px;text-align:center;padding:6px 0;"><?= $data['invest_name'];?></div>'
				});
				infowindow.open(map, marker);

				// 지도의 중심을 결과값으로 받은 위치로 이동시킵니다
				map.setCenter(coords);
			} 
		});    
	</script>
	
	</section>
