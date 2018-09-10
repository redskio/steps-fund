<?php
	session_cache_limiter("private_no_expire");
	session_start();
	$invest_num = $_POST["invest_num"];
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
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=fd2efbad9ac66ea21effa0f9bf8b9983&libraries=services"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<link rel="stylesheet" href="../css/main.css">

<title>스탭스 펀딩</title>

<script type="text/javascript">

	//Onsubmit 이벤트
	function alert_submit(){
		var user_id = '<?php echo $_SESSION['ses_userid']; ?>';
		if(user_id == ''){
			alert("로그인하세요");
			location.href='../member/login.php';
			return false;
		}else{
			return true; 
		}
		return true;
	};
	//다음지도
      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['선순위금액', 14000],
          ['스탭스금액', 10000],
          ['잔여금액', 6000]
        ]);

        // Set chart options
        var options = {'title':'담보비율 그래프',
                       'width':800,
                       'height':600};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>

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
	<?php
		$percent = percent($data['invest_money1'],$data['invest_money2'])."%";
	?>
	<div>
		<div class="progress" style="width:50%">
		<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $percent; ?>;">
			<?php echo $percent;?> 투자완료
		</div>
	</div>
	<?php
		$charge = charge($data['invest_money1'],$data['invest_money2']);
	?>
	<div>
		<form action="../invest/invest_ing.php" method="POST" onsubmit="return alert_submit()">
		<input type="hidden" name="invest_num" value="<?echo $data['invest_num']?>"/>
		<input type="hidden" name="charge" value="<?echo $charge?>"/>
		<button type="submit">투자진행</button>
		</form>
	</div>
	<table>
	<tr><?php echo "제".$data['invest_num']."호"."<br />\n";?></tr>
	<tr><?php echo "제 ".$data['invest_num']."호 ".$data['invest_name']."<br />\n";?></tr>
	<tr><?php echo $data['invest_rate']."%<br />\n"?></tr>
	<tr><?php echo $data['invest_month']."월<br />\n";?></tr>
	<tr><?php echo $data['invest_type']."<br />\n";?></tr>
	<?php
		$money1 = won($data['invest_money1']); echo $money1."<br />\n";
		$money2 = won($data['invest_money2']); echo $money2."<br />\n";
	?>
	<tr><?php echo $data['invest_man']."명<br />\n";?></tr>
	<tr><?php echo $data['invest_period']."일<br />\n";?></tr>
	<tr><?php echo $data['invest_limit']."까지<br />\n";?></tr>
	<tr><img src="<?php echo '/upload/'.$data['invest_image1']; ?>"  width="500px" height="400px" /></tr>
	</table>
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
		var address = '<?= $data['invest_address1']; ?>';
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
	<div>
	상품설명 :<br />
	<?php echo $data['invest_desc1']."<br />\n";?>
	</div>
	<div id="chart_div"></div>
	<div>첨부파일
	<button type="button" onclick="location.href='../function/addfile_download.php' ">다운로드</button>
	</div>
</body>
</html>
