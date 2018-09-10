<meta charset="UTF-8" />
<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/function/db_connect.php';
	$db = new DBC;
	$db->DBI();
 
    $id = $_POST['memberId'];
    $name = $_POST['memberName'];
    $pw1 = $_POST['memberPw'];
    $pw2 = $_POST['memberPw2'];
    $phone = $_POST['memberPhone'];
    $email = $_POST['memberEmailAddress'];
    $cash = $_POST['memberCash'];
 
    //PHP에서 유효성 재확인
 
    //아이디 중복검사.
    $db->query = "select * from member where id='".$id."'";
	$db->DBQ();
    $num = $db->result->num_rows;

	if($num >=1)
	{
		echo "아이디가 존재합니다";
		exit;
	}
    //비밀번호 일치하는지 확인
    if($pw1 !== $pw2){
        echo '비밀번호가 일치하지 않습니다.';
        exit;
    }else{
        //비밀번호를 암호화 처리.
        $password = md5($pw1);
    }
 
    //닉네임, 생일 그리고 이름이 빈값이 아닌지
    if($phone == '' || $cash == '' || $name == ''){
        echo '생일혹은 닉네임의 값이 없습니다.';
    }
 
    //이메일 주소가 올바른지
    $checkEmailAddress = filter_var($email, FILTER_VALIDATE_EMAIL);
 
    if($checkEmailAddress != true){
        echo "올바른 이메일 주소가 아닙니다.";
        exit;
    }
 
    //이제부터 넣기 시작
	$db->query = "insert into member values ('','".$id."','".$name."', '".$phone."',  '".$password."', '".$email."', '".$cash."')";
	$db->DBQ();
	
	if(!$db->result)
	{
	echo "회원가입에 실패하였습니다.";
	$db->DBO();
	exit;
	} else
	{
	echo "<script>alert('회원가입에 성공하였습니다.');location.replace('../index.html');</script>";
	$db->DBO();
	exit;
	}

?>