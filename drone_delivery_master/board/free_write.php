<?php
	require_once("./free_dbconfig.php");
	//$_GET['bno']이 있을 때만 $bno 선언
	if(isset($_GET['bno'])) {
		$bNo = $_GET['bno'];
	}
	if(isset($bNo)) {
		$sql = 'select title, content, author from board_free where no = ' . $bNo;
		$result = $db->query($sql);
		$row = $result->fetch_assoc();
	}
?>

<?php
                session_start();
                $URL = "./free_index.php";
                if(!isset($_SESSION['ID'])) {
        ?>

                <script>
                        alert("로그인이 필요합니다");
                        location.replace("<?php echo $URL?>");
                </script>
        <?php
                }
        ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>자유게시판 | FLYAWAY BoongBoong Venture</title>

	<link rel="stylesheet" href="/stylesheet/free_normalize.css" />
	<link rel="stylesheet" href="/stylesheet/free_board.css" />
	<link rel="stylesheet" type="text/css" href="/stylesheet/form.css">
	<link rel="stylesheet" type="text/css" href="/stylesheet/titlePage.css">
</head>
<body>
	<header>
		<?php include("../navbar.html"); ?>
	</header>
	<?php include("./sidebar.html"); ?>
	<article class="boardArticle">
		<div class = "introbox">
		<h3>글쓰기</h3>
			<form action="./free_write_update.php" method="post">
				<?php
				if(isset($bNo)) {
					echo '<input type="hidden" name="bno" value="' . $bNo . '">';
				}
				?>
				<table style = "margin-right:30%;" width ="900" height="300" id="boardWrite" align = "center">
					<tbody>
						<tr>
							<th scope="row"></th>
							<td style="text-align: left; " class="id">
								<?php
								if(isset($_SESSION['ID'])){
									$row['author']=$_SESSION['ID'];
								}
										?>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="bTitle">제목</label></th>
							<td class="title"><input style="width:90%" type="text" name="bTitle" id="bTitle" value="<?php echo isset($row['title'])?$row['title']:null?>"></td>
						</tr>
						<tr>
							<th scope="row"><label for="bContent">내용</label></th>
							<td class="content"><textarea style="width:90%;" rows="30" cols="100" name="bContent" id="bContent"><?php echo isset($row['content'])?$row['content']:null?></textarea></td>
						</tr>
					</tbody>
				</table>
				<div class="btnSet">

					<input type="submit" class="btnSubmit btn" value=	<?php echo isset($bNo)?'수정':'작성'?>>

					<input type="button" onclick = "location.href= './free_index.php'" class="btnList btn" value = "목록"></a>
				</div>

			</form>
		</div>
	</article>
</body>
</html>
