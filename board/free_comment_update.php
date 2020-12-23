<?php
	require_once('./free_dbconfig.php');
	session_start();

	$w = '';

	$coNo = 'null';
//	$coId = $_SESSION['userid'];


	//2Depth & 수정 & 삭제

	if(isset($_POST['w'])) {

		$w = $_POST['w'];

		$coNo = $_POST['comment_no'];

	}

	//공통 변수
	$bNo = $_POST['bno'];
	//$coPassword = $_POST['coPassword'];

	//if($w !== 'w') $coID = $_SESSION['userid'];

	if($w !== 'd') {//$w 변수가 d일 경우 $coContent와 $coId가 필요 없음.

	$coContent = $_POST['coContent'];

	if($w !== 'u') {//$w 변수가 u일 경우 $coId가 필요 없음.

	//	$coId = $_POST['coId'];
			$coId = $_SESSION['ID'];

	}

}



if(empty($w) || $w === 'w') { //$w 변수가 비어있거나 w인 경우

	$msg = '작성';

	$sql = 'insert into board_comment values(null, ' .$bNo . ', ' . $coNo . ', "' . $coContent . '", "' . $coId . '")';
	$sql = 'insert into board_comment ()
															values(null, ' .$bNo . ', ' . $coNo . ', "' . $coContent . '", "' . $coId . '")';



	if(empty($w)) { //$w 변수가 비어있다면,

		$result = $db->query($sql);



		$coNo = $db->insert_id;

		$sql = 'update board_comment set comment_recur = comment_no where comment_no = ' . $coNo;

	}



} else if($w === 'u') { //작성

	$msg = '수정';

	//$sql = 'select count(*) as cnt from board_comment where comment_password=password("' . $coPassword . '") and comment_no = ' . $coNo;
//	$result = $db->query($sql);
//	$row = $result->fetch_assoc();

//	if(empty($row['cnt'])) { //맞는 결과가 없을 경우 종료
?>
<!--
		<script>
			alert('비밀번호가 맞지 않습니다.');
			history.back();
		</script>
-->

<?php
//		exit;
//	}

	$sql = 'update board_comment set comment_content = "' . $coContent . '" where comment_no = ' . $coNo;



} else if($w === 'd') { //삭제

	$msg = '삭제';

?>
		<script>
		var ok = Confirm('덧글을 삭제하시겠습니까?');

		if(ok==true){
			document.write("ok");
		}
		else if(ok==false){
			document.write("nope");
		}

		</script>



<?php
	//	exit;
	//}

	$sql = 'delete from board_comment where comment_no = ' . $coNo;

} else {

?>

	<script>

		alert('정상적인 경로를 이용해주세요.');

		history.back();

	</script>

<?php

	exit;

}



$result = $db->query($sql);

if($result) {

?>

	<script>

		alert('댓글이 정상적으로 <?php echo $msg?>되었습니다.');

		location.replace("./free_view.php?bno=<?php echo $bNo?>");

	</script>

<?php

} else {

?>

	<script>

		alert('댓글 <?php echo $msg?>에 실패했습니다.');

		history.back();

	</script>

<?php

	exit;

}

?>
