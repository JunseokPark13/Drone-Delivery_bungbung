<?php
  session_start();
  if(isset($_SESSION['ID'])){
    echo '<script>alert("이미 저희 회원이십니다.");window.history.back();</script>';
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>회원가입 | Be With Us, Fly With Us</title>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="/images/favicon.ico">
    <link rel="icon" href="/images/favicon.ico">
    <link rel="stylesheet" type="text/css" href="/stylesheet/titlePage.css">
    <link rel="stylesheet" type="text/css" href="/stylesheet/form.css">
    <link href="http://fonts.googleapis.com/earlyaccess/nanumgothic.css" rel="stylesheet">
  	<meta name="author" content="Mingi Kim">
  	<meta name="description" content="Sign up page of Boong-Boong venture company.">
    <script src="/scripts/checkValidInput.js"></script>
    <script src="/scripts/address.js"></script>
    <script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
    <script>
    document.getElementsByClassName("section").onkeypress = function(e) {
      var key = e.charCode || e.keyCode || 0;
      if (key == 13) {
        e.preventDefault();
      }
    } // prevent hitting enter as submit.
    </script>
  </head>
  <body>
    <div class="section">
      <form name= join class= "box" method= post action="/user/signup.php" onsubmit="return check();">
        <a href="/index.php"><img src="./images/logo.png" width=60%></a>
        <div class="form-element">
          <div class="text">
            ID
          </div>
          <div class="input">
            <input type=hidden name=idValue id=_idValue value=0>
            <input type=text size=30 maxlength=30 name=id id=_id>
            <input type=button value=중복확인 onclick=idCheck()>
            <div id =_idComment></div>
            <iframe src="" id=ifrm scrolling=no frameborder=no width=0 height=0 name=ifrm></iframe>
          </div>
        </div>

        <div class="form-element">
          <div class="text">
            비밀번호
          </div>
          <div class="input">
            <input type = hidden name = pwValue id =_pwValue value = 0>
            <input type = password size=20 maxlength=20 name=pw id=_pw onblur=pwCheck()>
          </div>

          <div class="text">
            비밀번호 확인
          </div>
          <div class="input">
            <input type=password size=20 maxlength=20 name=confirmpw id=_confirmpw onblur=pwCheck()>
            <div id = _pwComment></div>
          </div>
        </div>

        <div class="form-element">
          <div class="text">
            이름
          </div>
          <div class="input">
            <input type = hidden name = nameValue id = _nameValue value = 0>
            <input type = text size = 10 maxlength = 10 name = name id = _name onblur = nameCheck()>
            <div id = _nameComment></div>
          </div>
        </div>

        <div class="form-element">
          <div class="text">
            <td>생년 월일</td>
          </div>
          <div class="input inline-block">
            <input type = hidden name = bDayValue id = _bDayValue value = 0>
            <input type = text size = 6 maxlength = 4 name = year placeholder= 년(4자리) id = _year onblur = bDayCheck() onkeypress = "return numkeyCheck(event)">
            <select name = month id = _month onchange = bDayCheck()>
              <option>1 <option>2 <option>3 <option>4 <option>5 <option>6
              <option>7 <option>8 <option>9 <option>10 <option>11 <option>12
            </select>
            <input type = text size = 2 maxlength = 2 name = day placeholder= 일 id = _day onblur = bDayCheck() onkeypress = "return numkeyCheck(event)">
            <div id = _bDayComment></div>
          </div>
        </div>

        <div class="form-element">
          <div class="text">
            성별
          </div>
          <div class="input">
            <select name = sex>
              <option>남성 <option>여성
            </select>
          </div>
        </div>

        <div class="form-element">
          <div class="text">
            기본 배송지 설정
          </div>
          <div class="input">
            <input type="button" onclick="daumPostcode(_postcode, _roadAddress, _detailAddress, guide)" value="우편번호 찾기">
            <input type="text" name = "postcode" id="_postcode" placeholder="우편번호">
            <input type="text" size = 70 name = "roadAddress" id="_roadAddress" placeholder="도로명주소">
            <input type="text" size = 30 name = "detailAddress" id="_detailAddress" placeholder="상세주소">
            <span id="guide" style="color:#999;display:none"></span>
          </div>
        </div>

        <input type="submit" value = "가입하기">
      </form>
    </div>
  </body>
</html>
