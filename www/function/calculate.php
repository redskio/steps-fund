<?
function won($k) {
       
       $len = strlen ($k);

       $len_ahr = ceil($len/4);

       $len_skanwj = $len%4;


       $a=0;
       for ($i=1;$i<=$len_ahr;$i++) {
                            
              $sub = array("만원", "억", "조","경");
                     
              $a=$a-4;

              if ($i < $len_ahr) {
                     if (substr($k, $a, 4) !="0000") {
                            $str=substr($k, $a, 4)+0;
                            $k2 = $str.$sub[$i-1].$k2;
                     }
              }else {
                     if ($len_skanwj==0) {
                            $len_skanwj=4;
                     }
                     $k2 = substr($k, $a,$len_skanwj).$sub[$i-1].$k2;
              }


       }

       $ch = strpos($k2,"원");

       if ($ch == 0) {
              $k2=$k2."원";
       }


       return $k2;
}
function percent($a,$b) {
	$percent = (int)$b / (int)$a *100;
	return $percent;
}
function charge($a,$b) {
	$charge = (int)$a - (int)$b;
	return $charge;
}
?>