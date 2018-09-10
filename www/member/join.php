<!doctype html>
<html>
<head>
<meta charset="UTF-8" />
<title>스탭스 펀딩</title>
<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js" ></script>
<script type="text/javascript" src="./join_form.js"></script>
</head>
<body>
<div id="wrap">
    <div id="container">
        <h1 class="title">회원가입</h1>
        <form name="signUp" action="./member_save.php" method="post" onsubmit="return checkSubmit()">
            <div class="line">
                <p>아이디</p>
                <div class="inputArea">
                    <input type="text" name="memberId" class="memberId" />
                </div>
                <div class="memberIdCheck"><button type="button">중복확인</button></div>
                <div class="memberIdComment comment"></div>
            </div>
            <div class="line">
                <p>이름</p>
                <div class="inputArea">
                    <input type="text" name="memberName" class="memberName" />
                </div>
            </div>
            <div class="line">
                <p>비밀번호</p>
                <div class="inputArea">
                    <input type="password" name="memberPw" class="memberPw" />
                </div>
            </div>
            <div class="line">
                <p>비밀번호 확인</p>
                <div class="inputArea">
                    <input type="password" name="memberPw2" class="memberPw2"  />
                    <div class="memberPw2Comment comment"></div>
                </div>
            </div>
            <div class="line">
                <p>휴대폰번호</p>
                <div class="inputArea">
                    <input type="text" name="memberPhone" class="memberNickName"  />
                    <div class="memberPhoneComment comment"></div>
                </div>
            </div>
            <div class="line">
                <p>이메일</p>
                <div class="inputArea">
                    <input type="text" name="memberEmailAddress" class="memberEmailAddress" />
                    <div class="memberEmailAddressComment comment"></div>
                </div>
            </div>
            <div class="line">
                <p>돈</p>
                <div class="inputArea">
                    <input type="text" name="memberCash" class="memberBirthDay" />
                    <div class="memberCashComment comment"></div>
                </div>
            </div>
            <div class="line">
                <input type="submit" value="가입하기" class="submit" />
            </div>
        </form>
 
        <div class="formCheck">
            <input type="hidden" name="idCheck" class="idCheck" />
            <input type="hidden" name="pw2Check" class="pwCheck2" />
            <input type="hidden" name="eMailCheck" class="eMailCheck" />
        </div>
    </div>
</div>
</body>
</html>