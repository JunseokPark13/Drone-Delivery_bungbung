<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Introduce</title>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="/images/favicon.ico">
    <link rel="shortcut icon" href="./images/favicon.ico">
    <link rel="icon" href="./images/favicon.ico">
    <link rel="stylesheet" type="text/css" href="/stylesheet/titlePage.css">
    <link rel="stylesheet" type="text/css" href="/stylesheet/animate.css">
    <link rel="stylesheet" type="text/css" href="/stylesheet/hover.css" media="all">
    <link rel="stylesheet" type="text/css" href="/stylesheet/form.css">
    <link href="http://fonts.googleapis.com/earlyaccess/hanna.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/earlyaccess/nanumgothic.css" rel="stylesheet">
    <meta name="author" content="Taehwi Kim">
    <meta name="description" content="Introduce page of Boong-Boong venture company.">
    <meta http-equiv="X-UA-Compatible" content="IE=9"/>
  </head>

  <body>
    <header>
      <?php include("../navbar.html"); ?>
    </header>
    <?php include("./sidebar.html"); ?>
    <div class="introbox">
    <img src = "/images/flyaway.png" width = "300" height = "60"><br>
    <h3>붕붕벤처는 IT기술과 드론을 활용해 배송을 편리하게하는 서비스를 제공합니다.</h3>
    <h3>수많은 사람들이 편리한 삶을 살 수 있도록 노력하겠습니다.</h3>
    <img src = "/images/droneinsky.jpg" width = "900" height = "300">
    <table border = 1 bordercolor="white" width ="907" height="300" align = center>
    <tr bgcolor=#59B48F align ="center">
      <p><td colspan = "4" span style="color:white"> Company Profile</td></p>
    <tr>
    <td bgcolor=#59B48F style="color:white"> 설립연도 </td> <td> 2019년 6월 </td>
  </tr>
  <tr>
  <td bgcolor=#59B48F style="color:white"> 본사위치 </td> <td> 충청남도 천안시 병천면 </td>
</tr>
<tr>
<td bgcolor=#59B48F style="color:white"> 주요서비스 </td> <td> 드론 배송</td>
</tr>
<tr>
<td bgcolor=#59B48F style="color:white"> 전체인력 </td> <td> 4.0명 </td>
</tr>
</table>
  </div>
  </body>
</html>
