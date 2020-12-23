<?php
include("../mainDB.php");
session_start();
if(!isset($_SESSION['ID'])){
  echo "<script> alert(\"로그인이 필요합니다.\"); window.history.back(); </script>";
  exit;
}
?>
<html>
<head>
  <title>개인 사용자 | Be With Us, Fly With Us</title>
  <meta charset="utf-8">
  <link rel="icon" href="/images/favicon.ico">
  <link rel="stylesheet" type="text/css" href="/stylesheet/titlePage.css">
  <link href="http://fonts.googleapis.com/earlyaccess/nanumgothic.css" rel="stylesheet">
  <link href="http://fonts.googleapis.com/earlyaccess/hanna.css" rel="stylesheet">
  <meta name="author" content="Kwonkyu Park">
  <meta name="description" content="Customer page of Boong-Boong venture company.">
  <meta http-equiv="X-UA-Compatible" content="IE=9"/>
  <style media="screen">
    .box {
      margin:20px auto;
      position: relative;
      text-align: center;
      display:table;
      background-color: rgb(255, 255, 255);
      border-radius: 24px;
      padding:20px 30px;
    }

    .box div.box-element{
      margin:auto 30px;
      vertical-align: middle;
    }

    div#linkage {
      cursor: pointer;
    }

    .box#linkage:hover{
      transition:0.1s;
      box-shadow: inset gray 4px 4px 5px;
    }

    .box#linkage:active{
      box-shadow: inset black 3px 3px 5px;
    }

    div.inline-block {
      display: inline-block;
    }

    .font-hanna {
      font-family:'Hanna';
    }

  </style>
</head>
  <body>
    <header>
      <?php include("../navbar.html"); ?>
    </header>

    <iframe id="inner_frm" src="#" width="100%" height="100%" hidden>
    </iframe>
    <div class="box" style="background-color:rgb(0, 177, 44);">
      <div class="box-element inline-block">
        <div id="linkage" class="box" onclick="location.href='/order/order-new.php'">
          <div class="medium-text font-hanna">
            New Order
          </div>
          <div class="small-image">
            <img src="/images/icon/drone3.png" width=400px alt="make new delivery">
          </div>
          <div class="small-text">
            새로운 배송을 신청합니다.
          </div>
        </div>
      </div>
      <div class="box-element inline-block">
        <div id="linkage" class="box" onclick="location.href='/order/order-view.php'">
          <div class="medium-text font-hanna">
            Review Order
          </div>
          <div class="small-image">
            <img src="/images/icon/delivery.png" width=400px alt="review previous delivery">
          </div>
          <div class="small-text">
            신청한 주문을 조회합니다.
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
