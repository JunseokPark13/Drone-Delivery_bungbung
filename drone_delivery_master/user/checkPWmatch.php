<?php
  include("../mainDB.php");
  session_start();
  $pw = $_POST['currentpw'];
  $id = $_SESSION['ID'];
  $sql = "select * from user_data where user_id = '$id'";
	$result = mysqli_query($conn, $sql);
  $data = mysqli_fetch_array($result);
  $correct = password_verify($pw, $data['user_password']);
	$member = mysqli_num_rows($result);
?>
  <script>
   var member = "<?=$member?>";
   var correct = "<?=$correct?>";
   if(member == 0){
		 parent.document.getElementById("_cpwValue").value = "0";
     parent.document.getElementById("_cpwComment").innerText = "에러";
   }
   else{
     if(correct){
       parent.document.getElementById("_cpwValue").value = "1";
       parent.document.getElementById("_cpwComment").innerText = "비밀번호가 일치합니다.";
     }
		 else{
       parent.document.getElementById("_cpwValue").value = "0";
       parent.document.getElementById("_cpwComment").innerText = "비밀번호가 일치하지 않습니다.";
     }
   }
  </script>
