<?php
  session_start();
  if(isset($_SESSION['ID'])){
    echo '<script>alert("이미 로그인 되어 있습니다.");window.history.back();</script>';
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>로그인 | Be With Us, Fly With Us</title>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="./images/favicon.ico">
    <link rel="icon" href="./images/favicon.ico">
    <link rel="stylesheet" type="text/css" href="stylesheet/titlePage.css">
  	<meta name="author" content="Mingi Kim">
  	<meta name="description" content="Login page of Boong-Boong venture company.">
    <style>
    body{
      margin: 0;
      padding: 0;
    }
    .box{
      color: black;
      width: 300px;
      padding: 30px;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%,-50%);
      background: white;
      box-shadow: cyan 5px 5px;
      border-radius: 24px;
      text-align: center;
    }
    .box h2{
      font-weight: 500;
    }
    .box input[type="text"],.box input[type="password"]{
      border:0;
      background: none;
      display: block;
      margin: 20px auto;
      text-align: center;
      border: 2px solid #3498db;
      padding: 14px 10px;
      width: 200px;
      outline: none;
      border-radius: 24px;
      transition: 0.25s;
    }
    .box input[type="text"]:focus,.box input[type="password"]:focus{
      width: 280px;
      border-color: #2ecc71;
    }
    .box input[type="submit"]{
      border:0;
      background: none;
      display: block;
      margin: 20px auto;
      text-align: center;
      border: 2px solid #2ecc71;
      padding: 14px 40px;
      outline: none;
      border-radius: 24px;
      transition: 0.25s;
      cursor: pointer;
    }
    .box input[type="submit"]:hover{
      background: #2ecc71;
    }

    li {
      list-style: none;
    }
    </style>
  </head>
  <body>
    <form name=login class=box method=post action="./user/signin.php">
      <a href="index.php"><img src="./images/logo.png" width=100%></a>
      <input type=text name=id placeholder="ID">
      <input type=password name=pw placeholder="PASSWORD">
      <input type=checkbox>ID 저장
      <input type=submit value = "로그인">

      <dl>
        <dt><a href="login.html">ID 찾기</a></dt>
        <dt><a href="login.html">비밀번호 찾기</a></dt>
        <dt><a href="join.php">회원가입</a></dt>
      </dl>
    </form>
  </body>
</html>
