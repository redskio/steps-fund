<!doctype html>
<html>
<head>
    <meta charset="UTF-8" />
	<title>스탭스 펀딩</title>
    <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js" ></script>
    <script type="text/javascript" src="./login_form.js"></script>
</head>
<body>
<div id="wrap">
    <div id="container">
        <form name="singIn" action="./member_login.php" method="post" onsubmit="return checkSubmit()">
            <div class="line">
                <p>아이디</p>
                <div class="inputArea">
                    <input type="text" name="memberId" class="memberId" />
                </div>
            </div>
            <div class="line">
                <p>비밀번호</p>
                <div class="inputArea">
                    <input type="password" name="memberPw" class="memberPw" />
                </div>
            </div>
            <div class="line">
                <input type="submit" value="로그인" class="submit" />
            </div>
        </form>
        <a href="./join.php">회원가입 하기</a>
    </div>
</div>
</body>
</html>