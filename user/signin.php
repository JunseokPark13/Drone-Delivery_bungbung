<?php
  include("../mainDB.php");
  session_start();
  $id = $_POST['id'];
  $pw = $_POST['pw'];
  $sql = "select * from user_data where user_id = '$id'";
	$result = mysqli_query($conn, $sql);
	$member = mysqli_num_rows($result);
  if($member == 1){
    $row = mysqli_fetch_array($result);
    if(password_verify($pw, $row['user_password'])){
      $_SESSION['ID'] = $id;
      if(isset($_SESSION['ID'])){
        header('Location: ../index.php');
      }
      else{
         echo "<script>
            alert(\"세션 저장 실패\");
            history.back();
         </script>";
      }
    }
    else{
      echo "<script>
         alert(\"비밀번호가 틀렸습니다.\");
         history.back();
      </script>";
    }
  }
  else{
    echo "<script>
       alert(\"잘못된 ID입니다.\");
       history.back();
    </script>";
  }
?>
