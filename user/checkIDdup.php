<?php
	include("../mainDB.php");
	$id = $_GET["userid"];
	$sql = "select * from user_data where user_id = '$id'";
	$result = mysqli_query($conn, $sql);
	$member = mysqli_num_rows($result);
?>
  <script>
   var member = "<?=$member?>";
   if(member == 0){
		 parent.document.getElementById("_idValue").value = "1";
     parent.document.getElementById("_idComment").innerText = "사용가능한 아이디입니다.";
   }
   else{
		 parent.document.getElementById("_idValue").value = "0";
     parent.document.getElementById("_idComment").innerText = "사용불가능한 아이디입니다.";
   }
  </script>
