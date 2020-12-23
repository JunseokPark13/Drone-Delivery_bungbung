<?php
include("../mainDB.php");
session_start();
if(!isset($_SESSION['ID'])){
  echo "<script> alert(\"로그인이 필요합니다.\"); window.history.back(); </script>";
}

$order_id = $_GET['id'];
$order_query = "select * from order_data where order_id=\"".$order_id."\"";
$order = ($conn->query($order_query))->fetch_array(MYSQLI_ASSOC);

$sender = $order['sender'];
$receiver = $order['receiver'];
$delivery_src = $order['delivery_src'];
$delivery_dst = $order['delivery_dst'];
$items = $order['item'];
$delivery_date = $order['delivery_date'];

$delivery_src = str_replace("|", " ", $delivery_src);
$delivery_dst = str_replace("|", " ", $delivery_dst);

?>
<!DOCTYPE html>
<html>
<head>
  <title>주문 내역 상세 | Be With Us, Fly With Us</title>
  <meta charset="utf-8">
  <link rel="icon" href="/images/favicon.ico">
  <link href="http://fonts.googleapis.com/earlyaccess/nanumgothic.css" rel="stylesheet">
  <meta name="author" content="Kwonkyu Park">
  <meta name="description" content="Order view page of Boong-Boong venture company.">
  <meta http-equiv="X-UA-Compatible" content="IE=9"/>
  <style media="screen">
    table {
      border:1px solid black;
      border-collapse: collapse;
      text-align:center;
    }
  </style>
</head>
<body>
<table>
  <tr>
    <th width=100px>보내는 사람</th><th width=100px>받는 사람</th><th>보내는 주소</th><th>받는 주소</th><th width=250px>물품</th><th width=100px>접수 일자</th>
  </tr>
  <tr>
    <td><?php echo $sender; ?></td><td><?php echo $receiver; ?></td><td><?php echo $delivery_src; ?></td><td><?php echo $delivery_dst; ?></td><td><?php echo $items; ?></td><td><?php echo $delivery_date; ?></td>
  </tr>
</table>
</body>
