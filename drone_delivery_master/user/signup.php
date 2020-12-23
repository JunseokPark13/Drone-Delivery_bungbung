<?php
  include("../mainDB.php");
  $id=$_POST['id'];
  $password = password_hash($_POST['pw'], PASSWORD_DEFAULT);
  $name=$_POST['name'];
  if($_POST['sex'] == "남성"){
    $sex= "M";
  }
  else{
    $sex = "F";
  }
  $birthDay = DATE($_POST['year']."-".$_POST['month']."-".$_POST['day']);
  $postnum = $_POST['postcode'];
  if($_POST['roadAddress'])$address = $_POST['roadAddress']."|".$_POST['detailAddress'];
  else $address;

  $sql = "INSERT INTO user_data (user_id, user_password, user_name, user_birth, user_gender, user_postnum, user_address) VALUES ('$id', '$password', '$name', '$birthDay', '$sex', '$postnum', '$address')";
  $signup = mysqli_query($conn, $sql);

  $script = "<script>";
  if($signup){
    $script .= 'alert("회원가입이 완료되었습니다.");';
  }
  else{
    $script .= 'alert("회원가입에 실패했습니다.");';
  }
  $script .= "location.href = '../index.php'";
  $script .= "</script>";
  echo $script;
?>
