<?php
  // GET 파라미터로 가로 막대 그래프 적용 위한 설정
  if(ctype_print($_GET["h_bar"])) $h_bar = explode(",", $_GET['h_bar']);
  else $h_bar = array(20, 10, 80, 40, 33, 26, 3);
  
  //막대 총 수
  $bar_count = count($h_bar);
  
  // 전체 화면
  $width = 250;
  $height = 200;
  
  // 간격
  $padding = 5;
  
  // 막대 하나 길이
  $bar_one = $width / $bar_count;
  
  // 이미지 생성
  $im = imagecreate($width, $height);
  $bgc1 = imagecolorallocate ($im, 0xcc, 0xcc, 0xcc);
  $bgc2 = imagecolorallocate ($im, 0x7f, 0x7f, 0x7f);
  $tc   = imagecolorallocate ($im, 0xff, 0xff, 0xff);
  
  // 이미지 배경색
  imagefilledrectangle ($im, 0, 0, $width, $height, $tc);
  
  // 최대값
  $max = max($h_bar);
  
  // 각각의 막대 그림
  for($i = 0; $i < $bar_count; $i++){
    $bar_h = ($height / 100) * (($h_bar[$i] / $max) *100 );
    
    $x1 = $i*$bar_one;
    $y1 = $height - $bar_h;
    $x2 = (($i+1)*$bar_one)-$padding;
    $y2 = $height;
    
    imagefilledrectangle ($im, $x1, $y1, $x2, $y2, $bgc1);
    imagefilledrectangle ($im, $x2, $y1, $x2, $y2, $bgc2);
  }
  
  // 이미지 타입 전송
  header("Content-Type: image/png");
  
  // 이미지 출력
  imagepng($im);
  
  // 이미지 자원 제거
  //imagedestroy($img);
  
?>
