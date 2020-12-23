<?php
  include("../mainDB.php");
  session_start();
  if(!isset($_SESSION['ID'])){

    echo "<script> alert(\"잘못된 접근입니다.\") window.history.back(); </script>";
  }

  else{
    $sql = "select * from user_data where user_id = '$_SESSION[ID]'";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);
    $bDay = explode("-",$data['user_birth']);
    $address = explode("|",$data['user_address']);
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>정보 수정 | Be With Us, Fly With Us</title>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="/images/favicon.ico">
    <link rel="icon" href="/images/favicon.ico">
    <link rel="stylesheet" type="text/css" href="/stylesheet/titlePage.css">
    <link rel="stylesheet" type="text/css" href="/stylesheet/form.css">
  	<meta name="author" content="Mingi Kim">
  	<meta name="description" content="Main page of Boong-Boong venture company.">
    <script src="/scripts/checkValidUpdate.js"></script>
    <script src="/scripts/address.js"></script>
    <script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
    <style media="screen">
    .box h2{
      font-weight: 500;
    }
    </style>
  </head>
  <body>
    <div class="section">
      <form name= changeInfo class="box" method = post action= "/user/update.php" onsubmit = "return check();">
        <a href="/index.php"><img src="/images/logo.png" width=100%></a>
        <h2>회원 정보 수정</h2>
        <iframe src = "" id = ifrm scrolling = no frameborder = no width = 0 height = 0 name= ifrm></iframe>
        <div class="form-element">
          <div class="text">
            현재 비밀번호
          </div>
          <div class="input">
            <input type = hidden name = cpwValue id = _cpwValue value = 0>
            <input type = password size = 20 maxlength = 20 name = currentpw id = _currentpw onblur = cpwCheck()>
            <div id = _cpwComment></div>
          </div>
        </div>

        <div class="form-element">
          <div class="text">
            새로운 비밀번호
          </div>
          <div class="input">
            <input type = hidden name = npwValue id = _npwValue value = 1>
            <input type = password size = 20 maxlength = 20 name = newpw id = _newpw onblur = npwCheck()>
          </div>
          <div class="text">
            새로운 비밀번호 확인
          </div>
          <div class="input">
            <input type = password size = 20 maxlength = 20 name = confirmpw id = _confirmpw onblur = npwCheck()>
            <div id = _npwComment></div>
          </div>
        </div>

        <div class="form-element">
          <div class="text">
            이름
          </div>
          <div class="input">
            <input type = hidden name = nameValue id = _nameValue value = 1>
            <input type = text size = 10 maxlength = 10 name = name value = "<?php echo $data['user_name'];?>" id = _name onblur = nameCheck()>
            <div id = _nameComment></div>
          </div>
        </div>

        <div class="form-element">
          <div class="text">
            생년 월일
          </div>
          <div class="input inline-block">
            <input type = hidden name = bDayValue id = _bDayValue value = 1>
            <input type = text size = 6 maxlength = 4 name = year placeholder= 년(4자리) value = "<?php echo $bDay[0];?>" id = _year onblur = bDayCheck() onkeypress = "return numkeyCheck(event)">
            <select name = month id = _month onchange = bDayCheck()>
              <?php
              for($i = 1; $i <= 12; $i++){
                if($i != $bDay[1]) echo "<option>$i";
                else echo "<option selected>$i";
              }
              ?>
            </select>
            <input type = text size = 2 maxlength = 2 name = day placeholder= 일 value = "<?php echo (int)$bDay[2];?>" id = _day onblur = bDayCheck() onkeypress = "return numkeyCheck(event)">
            <div id = _bDayComment></div>
          </div>
        </div>

        <div class="form-element">
          <div class="text">
            기본 배송지 설정
          </div>
          <div class="input">
            <input type="button" onclick="daumPostcode(_postcode, _roadAddress, _detailAddress, guide)" value="우편번호 찾기">
            <input type="text" name = "postcode" id="_postcode" value = "<?php echo $data['user_postnum'];?>" placeholder="우편번호">
            <input type="text" size = 70 name = "roadAddress" id="_roadAddress" value = "<?php echo $address[0];?>" placeholder="도로명주소">
            <input type="text" size = 30 name = "detailAddress" id="_detailAddress" value = "<?php echo $address[1];?>" placeholder="상세주소">
            <span id="guide" style="color:#999;display:none"></span>
          </div>
        </div>

        <input type = submit value = "변경하기">
      </form>
    </div>
  </body>
</html>
