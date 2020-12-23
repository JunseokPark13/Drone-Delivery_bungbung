<?php
  include("./mainDB.php");
  session_start();
  if(!isset($_SESSION['ID'])){
    echo '<script>alert("로그인이 필요합니다.");window.history.back();</script>';
    exit;
  }

  $order_query = "select is_admin from user_data where user_id=\"".$_SESSION['ID']."\"";
  if((($conn->query($order_query))->fetch_array(MYSQLI_ASSOC))['is_admin'] != 1){
    echo '<script>alert("올바르지 않은 접근입니다.");window.history.back();</script>';
    exit;
  }

  $user_query = "select * from user_data";
  $order_query = "select * from order_data";
  $drone_query = "select * from drone_data";

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="icon" href="/images/favicon.ico">
    <link href="http://fonts.googleapis.com/earlyaccess/nanumgothic.css" rel="stylesheet">
    <meta name="author" content="Kwonkyu Park">
    <meta name="description" content="Order view page of Boong-Boong venture company.">
    <meta http-equiv="X-UA-Compatible" content="IE=9"/>
    <title>관리자 페이지 | Be With Us, Fly With Us</title>
    <style media="screen">
      table {
        border: 2px solid black;
        border-collapse: collapse;
      }

      li {
        list-style-type: none;
      }
    </style>
  </head>
  <body>

    <a name="INDEX">
    <li>
      <ol>
        <a href="#USER">USER DATA</a>
      </ol>
      <ol>
        <a href="#ORDER">ORDER DATA</a>
      </ol>
      <ol>
        <a href="#DRONE">DRONE DATA</a>
      </ol>
    </li>

    <a name="USER">
    <table>
      <caption>USER LIST <a href="#INDEX">▲</a></caption>
      <tr>
        <th>USER ID</th><th>USER NAME</th><th>USER BIRTHDAY</th><th>USER GENDER</th><th>USER ADDRESS</th><th>ADMIN</th>
      </tr>
      <?php
        $result = $conn->query($user_query);
        while($user_data = $result->fetch_array(MYSQLI_ASSOC)){
          echo "<tr>";
          echo "<td>".$user_data['user_id']."</td><td>".$user_data['user_name']."</td><td>".$user_data['user_birth']."</td><td>".$user_data['user_gender']."</td><td>".$user_data['user_address']."</td><td>".$user_data['is_admin']."</td>";
          echo "</tr>";
        }

       ?>
    </table>

    <a name="ORDER">
    <table>
      <caption>ORDER LIST <a href="#INDEX">▲</a></caption>
      <tr>
        <th>SENDER</th><th>SENDER ID</th><th>RECEIVER</th><th>Delivery: Source</th><th>Delivery: Destination</th><th>Items</th><th>ID</th><th>DATE</th>
      </tr>
      <?php
        $result = $conn->query($order_query);
        while($order_data = $result->fetch_array(MYSQLI_ASSOC)){
          echo "<tr>";
          echo "<td>".$order_data['sender']."</td><td>".$order_data['sender_id']."</td><td>".$order_data['receiver']."</td><td>".$order_data['delivery_src']."</td><td>".$order_data['delivery_dst']."</td><td>".$order_data['item']."</td><td>".$order_data['order_id']."</td><td>".$order_data['delivery_date'];
          echo "</tr>";
        }

       ?>
    </table>

    <a name="DRONE">
    <table>
      <caption>DRONE LIST <a href="#INDEX">▲</a></caption>
      <tr>
        <th>ID</th><th>STATUS</th><th>REASON</th><th>ORDER ID</th><th>REGION</th>
      </tr>
      <?php
        $result = $conn->query($drone_query);
        while($drone_data = $result->fetch_array(MYSQLI_ASSOC)){
          echo "<tr>";
          echo "<td>".$drone_data['drone_id']."</td><td>".$drone_data['drone_status']."</td><td>".$drone_data['reason']."</td><td>".$drone_data['order_id']."</td><td>".$drone_data['region']."</td>";
          echo "</tr>";
        }

       ?>
    </table>
  </body>
</html>
