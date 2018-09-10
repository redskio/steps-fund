<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/function/session.php';
?>
<meta charset="UTF-8" />
<?
    echo $_SESSION['ses_userid'].'님 로그아웃 하겠습니다.';
 
    unset($_SESSION['ses_userid']);
 
    if($_SESSION['ses_userid'] == null){
       echo("<script>location.replace('../index.html');</script>");
    }
?>