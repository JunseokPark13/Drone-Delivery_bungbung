<?php
	session_start();
	require_once("./free_dbconfig.php");
	//$_POST['bno']이 있을 때만 $bno 선언
	if(isset($_POST['bno'])) {
		$bNo = $_POST['bno'];
	}
	//bno이 없다면(글 쓰기라면) 변수 선언
	if(empty($bNo)) {
		if($_SESSION['ID']){
			$bID = $_SESSION['ID'];
			$date = date('Y-m-d H:i:s');
		}
		else{
		$bID = $_POST['bID'];
		$date = date('Y-m-d H:i:s');
		}
	}
	//항상 변수 선언
	//$bPassword = $_POST['bPassword'];
//	$bAuthor = $P_POST['author'];
	$bTitle = $_POST['bTitle'];
	$bContent = $_POST['bContent'];
//글 수정
if(isset($bNo)) {
	//수정 할 글의 비밀번호가 입력된 비밀번호와 맞는지 체크
	//$sql = 'select count(author) as cnt from board_free where author=password("' . $bPassword . '") and no = ' . $bNo;
//	$result = $db->query($sql);
//	$row = $result->fetch_assoc();
	//비밀번호가 맞다면 업데이트 쿼리 작성

		$sql = 'update board_free set title="' . $bTitle . '", content="' . $bContent . '" where no = ' . $bNo;
		$msgState = '수정';
	//틀리다면 메시지 출력 후 이전화면으로

	?>

	<?php

//글 등록
} else {
	$sql = "INSERT INTO board_free (no, title, content, hit, author, b_date) VALUES (null, '$bTitle', '$bContent', 0, '$bID', '$date')";

	$msgState = '등록';
}
//메시지가 없다면 (오류가 없다면)
if(empty($msg)) {
	$result = $db->query($sql);
	//쿼리가 정상 실행 됐다면,
	if($result) {
		$msg = '정상적으로 글이 ' . $msgState . '되었습니다.';
		if(empty($bNo)) {
			$bNo = $db->insert_id;
		}
		$replaceURL = './free_view.php?bno=' . $bNo;
	}
	else {
		$msg = '글을 ' . $msgState . '하지 못했습니다.';
?>
		<script>
			alert("<?php echo $msg?>");
			history.back();
		</script>
<?php
		exit;
	}
}
?>
<script>
	alert("<?php echo $msg?>");
	location.replace("<?php echo $replaceURL?>");
</script>
