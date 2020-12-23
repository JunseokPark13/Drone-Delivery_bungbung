<?php
include("../mainDB.php");
session_start();
if(!isset($_SESSION['ID'])){
  echo "<script> alert(\"로그인이 필요합니다.\"); window.history.back(); </script>";
}

$user_query = "select * from user_data where user_id=\"".$_SESSION['ID']."\"";
$userinfo = ($conn->query($user_query))->fetch_array(MYSQLI_ASSOC);
$userid = $userinfo['user_id'];
$username = $userinfo['user_name'];
$postnum = $userinfo['user_postnum'];
$address = $userinfo['user_address'];
$address = str_replace("|", " ", $address);
?>

<html>
<head>
  <title>개인 주문 내역 | Be With Us, Fly With Us</title>
  <meta charset="utf-8">
  <link rel="icon" href="/images/favicon.ico">
  <link href="http://fonts.googleapis.com/earlyaccess/nanumgothic.css" rel="stylesheet">
  <link type="text/css" href="/stylesheet/titlePage.css" rel="stylesheet">
  <meta name="author" content="Kwonkyu Park">
  <meta name="description" content="Order view page of Boong-Boong venture company.">
  <meta http-equiv="X-UA-Compatible" content="IE=9"/>
  <script type="text/javascript">
    function openDetailOrder(url){
      window.open("/order/order-detail.php?id="+url, "detail", "width=1000 height=200 top=100 left=20 resizable=no titlebar=no");
    }
  </script>
  <style media="screen">
    body {
      font-family: 'Nanum Gothic';
      background-color:skyblue;
    }

    .full-width{
      width:100%;
      height:auto;
    }

    .medium-width {
      width:70%;
      height: auto;
    }

    .big-text {
      font-size: 3em;
    }

    .medium-text {
      font-size :2em;
    }

    .small-text {
      font-size: 1em;
    }

    div#user-info {
      margin: 5px 10px;
      background-color: white;
      font-family: 'Nanum Gothic';
      border-radius: 15px;

    }

    .detail-view {
      margin-left: auto;
      margin-right: auto;
      background-color: white;
      font-family: 'Nanum Gothic';
      border-radius: 15px;
    }

    .detail-view:before {
      content: "\a0";
      display: block;
      padding: 2px 0;
      line-height: 1px;
      border-top: 1px dashed #000;
    }

    .field {
      padding: 10px 5px;
    }

    .inner-box {
      margin: 10px 5px;
      padding:5px;
    }

    .inline-block {
      display: inline-block;
    }

  </style>
</head>
<body>
  <header>
    <?php include "../navbar.html" ?>
  </header>
  <section>
    <div id="greeting" class="full-width">
    <!-- width 100%? -->
      <div id="user-info" class="inner-box">
        <!-- Showing information of user. Like name, order amount, etc.. or random greeting text. -->
        <div id="greet" class="inner-box">
          <span class="text medium-text">
            안녕하세요, <?php echo $username; ?>님!
          </span>
       </div>
       <div id="latest-order" class="inner-box">
          <!-- Showing progress of users' latest order. -->
          <span class="text small-text">
          <?php
          $orders = $conn->query("select * from order_data where sender_id='$userid'");
          $latest_order = $orders->fetch_array(MYSQLI_ASSOC);
          if($latest_order) echo "최근에 주문하신 내역은 ".str_replace("|", " ", $latest_order['delivery_src'])."에서 ".str_replace("|", " ", $latest_order['delivery_dst'])."로 보내신 ".$latest_order['item']." 입니다.";
          else echo "주문하신 내역이 없습니다!";
           ?>
         </span>
        </div>
      </div>
    </div>

    <div id="order-list" class="full-width list">
      <!-- Showing order history of user. It could be large so divide it if it's possible. -->
      <!-- Maybe use of iframes? -->

      <?php
      $orders = $conn->query("select * from order_data where sender_id='$userid'");
      while($order = $orders->fetch_array(MYSQLI_ASSOC)){
        $sender = $order['sender'];
        $receiver = $order['receiver'];
        $delivery_src = $order['delivery_src'];
        $delivery_dst = $order['delivery_dst'];
        $items = $order['item'];
        $order_id = $order['order_id'];

        $delivery_src = str_replace("|", " ", $delivery_src);
        $delivery_dst = str_replace("|", " ", $delivery_dst);

        echo '<div id="order" class="detail-view medium-width inner-box">'."\r\n";
        echo '  <div id="order-number">주문번호 '.$order_id.'</div>'."\r\n";
        echo '  <div id="order-info" class="field-set">'."\r\n";
        echo '    <div id="upper-box" class="layer-box inner-box inline-block">'."\r\n";
        echo '      <span id="delivery-items" class="field medium-text">'.$items.'</span>'."\r\n";
        echo '    </div>'."\r\n";
        echo '  </div>'."\r\n";
        echo '  <div id="order-detail" class="field-set">'."\r\n";
        echo '    <dd><span id="delivery-source" class="field">'.$delivery_src.'</span></dd>'."\r\n";
        echo '    <dd><span id="delivery-destination" class="field">'.$delivery_dst.'</span></dd>'."\r\n";
        echo '  </div>'."\r\n";
        echo '<br><input type="button" value="상세조회" onclick=openDetailOrder('.$order_id.")>"."\r\n";
        echo '</div>'."\r\n";
      }

      ?>
    </div>
  </section>
</body>
</html>
