<?php
	require_once("./free_dbconfig.php");
	session_start();
	$bNo = $_GET['bno'];
	if(isset($_SESSION['ID'])){
		$admin = $_SESSION['ID'];
	}

	if(!empty($bNo) && empty($_COOKIE['board_free_' . $bNo])) {
		$sql = 'update board_free set hit = hit + 1 where no = ' . $bNo;
		$result = $db->query($sql);
		if(empty($result)) {
			?>
			<script>
				alert('오류가 발생했습니다.');
				history.back();
			</script>
			<?php
		} else {
			setcookie('board_free_' . $bNo, TRUE, time() + (60 * 60 * 24), '/');
		}
	}

	$sql = 'select title, content, b_date, hit, author from board_free where no = ' . $bNo;
	//$sql = 'select title, content, hit, author from board_free where no = ' . $bNo;
	$result = $db->query($sql);
	$row = $result->fetch_assoc();

	$sql2 = "select is_admin from user_data where user_id ='$_SESSION[ID]'";
	//$sql2 = 'select title, content, b_date, hit, author from board_free where no = ' . $bNo;
	$result2 = $db->query($sql2);
	$row2 = $result2->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>자유게시판 | FLYAWAY BoongBoong Venture</title>
	<link rel="stylesheet" href="/stylesheet/normalize.css" />
	<link rel="stylesheet" href="/stylesheet/board.css" />
	<script src="/scripts/free_jquery-2.1.3.min.js"></script>

	<link rel="shortcut icon" href="./images/favicon.ico">
	<link rel="icon" href="./images/favicon.ico">
	<link rel="stylesheet" type="text/css" href="/stylesheet/form_plus.css">
	<link rel="stylesheet" type="text/css" href="/stylesheet/form.css">
	<link rel="stylesheet" type="text/css" href="/stylesheet/titlePage.css">
	<link rel="stylesheet" type="text/css" href="/stylesheet/animate.css">
	<link rel="stylesheet" type="text/css" href="/stylesheet/hover.css" media="all">
	<meta name="author" content="Kwonkyu Park">
	<meta name="description" content="Main page of Boong-Boong venture company.">
</head>
<body>
	<header>
		<?php include("../navbar.html"); ?>
	</header>
	<?php include("./sidebar.html"); ?>

	<article class="boardArticle">


		<div id="boardView">
			<div class = boardif id="boardInfo">
				<span style="background-color:white;" id="boardID">작성자 : <?php echo $row['author']?>&nbsp;&nbsp;</span>
				<span style="background-color:white;" id="boardDate">작성일 : <?php echo $row['b_date']?>&nbsp;&nbsp;</span>
				<span style="text-align: right; background-color:white;" id="boardHit"> 조회 : <?php echo $row['hit']?></span>
			</div>

			 <h3 id="boardTitle">
				<?php echo $row['title']?>
			 </h3>

					<div id="boardContent">
						<div style="margin-bottom:5% "><?php echo $row['content']?></div>
					</div>
					<div style="margin-left:5%; margin-top:5%; margin-right:5% " align=right class="btnSet">
						<?php
							if(($_SESSION['ID']) == $row['author'] || $row2['is_admin']==1){
						?>
				<form class="button" method="post">
						<input type="hidden" name="no" value="<?=$row['no']?>">
						<a type="submit" href="./free_write.php?bno=<?php echo $bNo?>">수정</a>
				</form>
				<form class="button" method="post">
						<a type="submit" href="./free_delete.php?bno=<?php echo $bNo?>">삭제</a>
				</form>
					<?php
				     }
					  ?>
				<form class="button" method="post">
						<a type="submit" href="./free_index.php">목록</a>
					</div>
				</form>
					<div style="margin-left:5%" id="boardComment">
						<?php require_once('./free_comment.php')?>
					</div>
		</div>
	</article>
</body>
</html>
