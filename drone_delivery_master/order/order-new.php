<?php
  include("../mainDB.php");
  session_start();
  if(!isset($_SESSION['ID'])){
    echo "<script> alert(\"로그인이 필요합니다.\") window.history.back(); </script>";
    exit;
  }
  else{
    $sql = "select * from user_data where user_id = \"".$_SESSION['ID']."\"";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);
    $name = $data['user_name'];
    $address = explode("|",$data['user_address']);
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Be With Us, Fly With Us</title>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="/images/favicon.ico">
    <link rel="icon" href="/images/favicon.ico">
    <link rel="stylesheet" type="text/css" href="/stylesheet/titlePage.css">
    <link rel="stylesheet" type="text/css" href="/stylesheet/form.css">
    <link href="http://fonts.googleapis.com/earlyaccess/nanumgothic.css" rel="stylesheet">
  	<meta name="author" content="Junseok Park">
  	<meta name="description" content="주문서 작성">
    <script src="/scripts/address.js"></script>
    <script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
    <script type="text/javascript">

      function checkValid(tagID){
        var target = document.getElementById(tagID);
        if(target.value == ""){
          target.scrollIntoView();
          target.focus();
          return true;
        }
        return false;
      }


      function check(){
        var sender = document.getElementById('sender').value;
        var receiver = document.getElementById('receiver').value;
        var arrival = document.getElementById('_postcode').value+" "+document.getElementById('roadAddress').value+" "+document.getElementById('detailAddress').value;
        var destination = document.getElementById('_deldst').value+" "+document.getElementById('dstroadAddress').value+" "+document.getElementById('dstdetailAddress').value;
        var item = document.getElementById('item').value;

        if(checkValid("sender") || checkValid("receiver") || checkValid("_postcode") || checkValid("roadAddress") || checkValid("detailAddress")
           || checkValid("_deldst") || checkValid("dstroadAddress") || checkValid("dstdetailAddress") || checkValid("item")){
             document.getElementById("check-result").innerHTML = "아직 입력해야 할 정보가 있습니다.";
          return false;
        }

        var finalcheck = "보내는 사람: " + sender + ", " + arrival + "\r\n";
        finalcheck = finalcheck + "받는 사람: " + receiver + ", " + destination + "\r\n";
        finalcheck = finalcheck + "다음과 같은 물건들을 보냅니다. " + item + ".\r\n배송을 확정지으려면 확인을 눌러주세요.";
        document.getElementById("check-result").innerHTML = "모든 정보가 입력되었습니다.";
        return confirm(finalcheck);

      }
    </script>
  </head>
  <body>
    <header>
      <?php include("../navbar.html");?>
    </header>
    <div class="section">
      <form name= join class= "box" method= post action= order.php onsubmit="return check();">
        <a href="../index.php"><img src="/images/logo.png" width=70%></a>

        <div class="form-element">
          <div class="text">
            주문자
          </div>
          <div class="input">
              <input type = text size = 10 maxlength=20 name=sender value = "<?php echo $name;?>" id=sender>
              <input type="hidden" name="sender_id" value="<?php echo $_SESSION['ID']; ?>">
          </div>
        </div>

        <div class="form-element">
          <div class="text">
            수령자
          </div>
          <div class="input">
            <input type=text size=10 maxlength=20 name=receiver id=receiver>
          </div>
        </div>

        <div class="form-element">
          <div class="text">
            배송 출발지
          </div>
          <div class="input">
            <input type="button" onclick="daumPostcode(_postcode, _roadAddress, _detailAddress, guide)" value="우편번호 찾기">
          </div>
          <div class="input long-width">
            <input type="text" name = "postcode" id="_postcode" value = "<?php echo $data['user_postnum'];?>" placeholder="우편번호">
            <input type="text" size = 70 name = "_roadAddress" id="roadAddress" value = "<?php echo $address[0];?>" placeholder="도로명주소">
            <input type="text" size = 30 name = "_detailAddress" id="detailAddress" value = "<?php if(isset($address[1])) echo $address[1];?>" placeholder="상세주소">
            <span id="guide" style="color:#999;display:none"></span>
          </div>
        </div>

        <div class="form-element">
          <div class="text">
            배송 도착지
          </div>
          <div class="input">
            <input type="button" onclick="daumPostcode(_deldst, _dstroadAddress, _dstdetailAddress, dstguide)" value="우편번호 찾기">
          </div>
          <div class="input long-width">
            <input type="text" name = "deldst" id="_deldst" placeholder="우편번호">
            <input type="text" size = 70 name = "_dstroadAddress" id="dstroadAddress" placeholder="도로명주소">
            <input type="text" size = 30 name = "_dstdetailAddress" id="dstdetailAddress" placeholder="상세주소">
            <span id="dstguide" style="color:#999;display:none"></span>
          </div>
        </div>

        <div class="form-element">
          <div class="text">
            배송 물품
          </div>
          <div class="input">
            <input type=text size=30 maxlength=30 name=item id=item>
          </div>
        </div>

        <div class="form-element">
          <div class="text">
            드론 선택
          </div>
          <div class="input">
            <select name="drone_id">
              <option selected value="N/A">선택하지 않음</option>
              <?php
                $query = "select drone_id, drone_status from drone_data";
                $result = $conn->query($query);
                while($drone = $result->fetch_array(MYSQLI_ASSOC)) {
                  $drone_id = $drone['drone_id'];
                  $drone_status = $drone['drone_status'];
                  $option = "<option value=\"".$drone_id."\"";
                  if($drone_status == 0)  $option .=" disabled";
                  $option = $option.">".$drone_id."</option>";
                  echo $option;
                }
              ?>
            </select>
          </div>
          <div class="text">
            만약 사용할 수 있는 드론이 존재하지 않는다면 그대로 제출해주세요!<br>
            사용할 수 있는 드론이 파악되면 시스템이 자동적으로 드론을 선택하여 배송합니다.
          </div>
        </div>

        <div class="form-element">
          <div class="text">
            배송 비밀번호
          </div>
          <div class="input">
            <input type = hidden name = pwValue id =_pwValue value = 0>
            <input type = password size=20 maxlength=20 name=pw id=_pw>
          </div>
        </div>

        <?php
        $date = date('ymdHis');
        $nNum = strlen($data['user_id']);
        $iNum = $date.$nNum;
         ?>

        <input type = hidden name = orderid id=_orderid value=<?php echo $iNum ?> >
        <div class="text">
          현재 주문되는 물품의 주문 번호는
          <?php
          echo $iNum;
           ?>
           입니다.
        </div>

        <input type = submit value = "주문하기">
        <div class="text small-text"><span id="check-result">아직 입력해야 할 정보가 있습니다.</span></div>
      </form>
    </div>
  </body>
</html>
