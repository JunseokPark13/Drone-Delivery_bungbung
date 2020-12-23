<?php
  include("../mainDB.php");
  session_start();
  $id = $_SESSION['ID'];
  $ispwChange = $_POST['newpw'];
  $password = password_hash($_POST['newpw'], PASSWORD_DEFAULT);
  $name=$_POST['name'];
  $birthDay = DATE($_POST['year']."-".$_POST['month']."-".$_POST['day']);
  $postnum = $_POST['postcode'];
  if($_POST['roadAddress'])$address = $_POST['roadAddress']."|".$_POST['detailAddress'];
  else $address;

  if($ispwChange)
    $sql = "UPDATE user_data SET user_name = '$name', user_birth = '$birthDay', user_password = '$password', user_postnum = '$postnum', user_address = '$address' WHERE user_id = '$id'";
  else
    $sql = "UPDATE user_data SET user_name = '$name', user_birth = '$birthDay', user_postnum = '$postnum', user_address = '$address' WHERE user_id = '$id'";

  $signup = mysqli_query($conn, $sql);
  $script = "<script>";

  if($signup){
    if($ispwChange){
      $script .="alert(\"수정이 완료되었습니다. 다시 로그인해주세요\");";
      $script .="location.href = \"/logout.php\";";
    }
    else{
      $script .="alert(\"수정이 완료되었습니다.\");";
      $script .= "location.href = \"/index.php\";";
    }
  }
  else{
    $script .= "alert(\"오류 발생\");";
    $script .= "location.href = \"/index.php\";";
  }

  $script .= "</script>";
  echo $script;
?>
