<?php
  include("../mainDB.php");
  session_start();
  if(!isset($_SESSION['ID'])){
    echo '<script>alert("올바르지 않은 접근입니다.");window.history.back();</script>';
  }

  $delivery_date = date("Y-m-d");
  $sender=$_POST['sender'];
  $sender_id=$_POST['sender_id'];
  $receiver=$_POST['receiver'];
  $password = password_hash($_POST['pwValue'], PASSWORD_DEFAULT);
  $item=$_POST['item'];
  $id = $_POST['orderid'];
  $drone_id = $_POST['drone_id'];

  $delsrc = $_POST['postcode'];
  if(isset($_POST['_roadAddress'])) $delsrc = $delsrc."|".$_POST['_roadAddress']."|".$_POST['_detailAddress'];

  $deldst = $_POST['deldst'];
  if(isset($_POST['_dstroadAddress'])) $deldst = $deldst."|".$_POST['_dstroadAddress']."|".$_POST['_dstdetailAddress'];

  $sql = "INSERT INTO order_data (sender, sender_id, receiver, item, delivery_src, delivery_dst, order_password, order_id, delivery_date)
                          VALUES ('$sender', '$sender_id', '$receiver', '$item', '$delsrc', '$deldst', '$password', '$id', '$delivery_date')";
  $order_result = $conn->query($sql);

  $drone_result = true;
  if($drone_id != "N/A"){
    $sql = "UPDATE drone_data set order_id=$id,drone_status=0 where drone_id=\"".$drone_id."\"";
    // Error when drone_id has whitespace between characters.
    $drone_result = $conn->query($sql);
  }

  $script = "<script>";
  if($order_result && $drone_result){
    $script .= 'alert("주문이 완료되었습니다.");';
  }
  else{
    $script .= 'alert("주문에 실패하였습니다.");';
  }
  $script .= "location.href = '/index.php'";
  $script .= "</script>";
  echo $script;
?>
