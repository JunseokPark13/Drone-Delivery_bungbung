<?php
	require_once("./free_dbconfig.php");
	session_start();
	//$_GET['bno']이 있어야만 글삭제가 가능함.
	if(isset($_GET['bno'])) {
		$bNo = $_GET['bno'];
	}
$conn = mysqli_connect('localhost', 'qndqndqpscj', 'flyboong1024', 'flyawaymaindb');
$select_query = "SELECT author, no FROM board_free";
$result_set = mysqli_query($conn, $select_query);
$row = mysqli_fetch_array($result_set);
?>

<?php
                $URL = "./free_index.php";
                if(!isset($_SESSION['ID'])) {
        ?>

                <script>
                        alert("로그인 필요");
                        location.replace("<?php echo $URL?>");
                </script>

			<?php

						}			?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>자유게시판 | FLYAWAY BoongBoong Venture</title>
	<link rel="stylesheet" href="/stylesheet/free_normalize.css" />
	<link rel="stylesheet" href="/stylesheet/free_board.css" />
</head>
<body>
	<article class="boardArticle">
		<h3>자유게시판 글삭제</h3>
		<?php
			if(isset($bNo)) {
				$sql = 'select count(no) as cnt from board_free where no = ' . $bNo;
				$result = $db->query($sql);
				$row = $result->fetch_assoc();
				if(empty($row['cnt'])) {
		?>
		<script>
			alert('글이 존재하지 않습니다.');
			history.back();
		</script>
		<?php
			exit;
				}

				$sql = 'select title from board_free where no = ' . $bNo;
				$result = $db->query($sql);
				$row = $result->fetch_assoc();
		?>
		<div id="boardDelete">
			<form action="./free_delete_update.php" method="post">
				<input type="hidden" name="bno" value="<?php echo $bNo?>">
				<table>
					<caption class="readHide">자유게시판 글삭제</caption>
					<thead>
						<tr>
							<th scope="col" colspan="2">글삭제</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th scope="row">글 제목</th>
							<td><?php echo $row['title']?></td>
						</tr>
						<tr>
							<!--<th scope="row"><label for="bPassword">비밀번호</label></th>
							<td><input type="password" name="bPassword" id="bPassword"></td>-->
						</tr>
					</tbody>
				</table>

				<div class="btnSet">
					<button type="submit" class="btnSubmit btn">삭제</button>
					<a href="./free_index.php" class="btnList btn">목록</a>
				</div>
			</form>
		</div>
	<?php
		//$bno이 없다면 삭제 실패
		} else {
	?>
		<script>
			alert('정상적인 경로를 이용해주세요.');
			history.back();
		</script>
	<?php
			exit;
		}
	?>
	</article>
</body>
</html>
