
<?php
	require_once("./free_dbconfig.php");
	session_start();
	/* 페이징 시작 */
	//페이지 get 변수가 있다면 받아오고, 없다면 1페이지를 보여준다.
	if(isset($_GET['page'])) {
		$page = $_GET['page'];
	} else {
		$page = 1;
	}

	/* 검색 시작 */
$searchColumn = '';
$subString = '';
$paging = '1';

	if(isset($_GET['searchColumn'])) {
		$searchColumn = $_GET['searchColumn'];
		$subString .= '&amp;searchColumn=' . $searchColumn;
	}
	if(isset($_GET['searchText'])) {
		$searchText = $_GET['searchText'];
		$subString .= '&amp;searchText=' . $searchText;
	}

	if(isset($searchColumn) && isset($searchText)) {
		$searchSql = ' where ' . $searchColumn . ' like "%' . $searchText . '%"';
	} else {
		$searchSql = '';
	}

	/* 검색 끝 */

	$sql = 'select count(*) as cnt from board_free' . $searchSql;
	$result = $db->query($sql);
	$row = $result->fetch_assoc();

	$allPost = $row['cnt']; //전체 게시글의 수

	if(empty($allPost)) {
		$emptyData = '<tr><td class="textCenter" colspan="5">글이 존재하지 않습니다.</td></tr>';
	} else {

		$onePage = 10; // 한 페이지에 보여줄 게시글의 수.
		$allPage = ceil($allPost / $onePage); //전체 페이지의 수

		if($page < 1 && $page > $allPage) {
?>
			<script>
				alert("존재하지 않는 페이지입니다.");
				history.back();
			</script>
<?php
			exit;
		}

		$oneSection = 10; //한번에 보여줄 총 페이지 개수(1 ~ 10, 11 ~ 20 ...)
		$currentSection = ceil($page / $oneSection); //현재 섹션
		$allSection = ceil($allPage / $oneSection); //전체 섹션의 수

		$firstPage = ($currentSection * $oneSection) - ($oneSection - 1); //현재 섹션의 처음 페이지

		if($currentSection == $allSection) {
			$lastPage = $allPage; //현재 섹션이 마지막 섹션이라면 $allPage가 마지막 페이지가 된다.
		} else {
			$lastPage = $currentSection * $oneSection; //현재 섹션의 마지막 페이지
		}

		$prevPage = (($currentSection - 1) * $oneSection); //이전 페이지, 11~20일 때 이전을 누르면 10 페이지로 이동.
		$nextPage = (($currentSection + 1) * $oneSection) - ($oneSection - 1); //다음 페이지, 11~20일 때 다음을 누르면 21 페이지로 이동.

		$paging = '<ul>'; // 페이징을 저장할 변수

		//첫 페이지가 아니라면 처음 버튼을 생성
		if($page != 1) {
			$paging .= '<li class="page page_start"><a href="./free_index.php?page=1' . $subString . '">처음</a></li>';
		}
		//첫 섹션이 아니라면 이전 버튼을 생성
		if($currentSection != 1) {
			$paging .= '<li class="page page_prev"><a href="./free_index.php?page=' . $prevPage . $subString . '">이전</a></li>';
		}

		for($i = $firstPage; $i <= $lastPage; $i++) {
			if($i == $page) {
				$paging .= '<li class="page current">' . $i . '</li>';
			} else {
				$paging .= '<li class="page"><a href="./free_index.php?page=' . $i . $subString . '">' . $i . '</a></li>';
			}
		}

		//마지막 섹션이 아니라면 다음 버튼을 생성
		if($currentSection != $allSection) {
			$paging .= '<li class="page page_next"><a href="./free_index.php?page=' . $nextPage . $subString . '">다음</a></li>';
		}

		//마지막 페이지가 아니라면 끝 버튼을 생성
		if($page != $allPage) {
			$paging .= '<li class="page page_end"><a href="./free_index.php?page=' . $allPage . $subString . '">끝</a></li>';
		}
		$paging .= '</ul>';

		/* 페이징 끝 */


		$currentLimit = ($onePage * $page) - $onePage; //몇 번째의 글부터 가져오는지
		$sqlLimit = ' limit ' . $currentLimit . ', ' . $onePage; //limit sql 구문

		$sql = 'select * from board_free' . $searchSql . ' order by no desc' . $sqlLimit; //원하는 개수만큼 가져온다. (0번째부터 20번째까지
		$result = $db->query($sql);
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>자유게시판 | FLYAWAY BoongBoong Venture</title>
	<link rel="stylesheet" href="/stylesheet/free_normalize.css" />
	<link rel="stylesheet" href="/stylesheet/free_board.css" />

	<link rel="shortcut icon" href="/images/favicon.ico">
	<link rel="icon" href="/images/favicon.ico">
	<link rel="stylesheet" type="text/css" href="/stylesheet/titlePage.css">
	<link rel="stylesheet" type="text/css" href="/stylesheet/animate.css">
	<link rel="stylesheet" type="text/css" href="../stylesheet/form.css">
	<link rel="stylesheet" type="text/css" href="../stylesheet/form_plus.css">
	<link rel="stylesheet" type="text/css" href="/stylesheet/hover.css" media="all">
	<meta name="author" content="Kwonkyu Park">
	<meta name="description" content="Main page of Boong-Boong venture company.">
</head>
<body>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script type="/text/javascript" src="/scripts/bootstrap.js"></script>
	<header>
		<?php include("../navbar.html"); ?>
	</header>
	<?php include("./sidebar.html"); ?>
	<div class="introbox">
	<article style="margin-left:auto; margin-right:auto;" class="boardArticle">
		<h3 style="text-align:center; margin-bottom:5%;">자유게시판</h3>
		<div  id="boardList">
			<table  class="table">
				<thead>
					<tr style="background-color:#D5E8F6;"class="danger">
						<th scope="col" class="no">번호</th>
						<th scope="col" class="title">제목</th>
						<th scope="col" class="author">작성자</th>
						<th scope="col" class="date">작성일</th>
						<th scope="col" class="hit">조회</th>
					</tr>
				</thead>
				<tbody>
						<?php
						if(isset($emptyData)) {
							echo $emptyData;
						} else {
							while($row = $result->fetch_assoc())
							{
								$datetime = explode(' ', $row['b_date']);
								$date = $datetime[0];
								if(isset($datetime[1]))	$time = $datetime[1];
								if($date == Date('Y-m-d'))
									//$row['b_date'] = $time;
									$row['b_date'] = $date;
								else
									$row['b_date'] = $date;
						?>
						<tr>
							<td class="no"><?php echo $row['no']?></td>
							<td class="title">
								<a href="./free_view.php?bno=<?php echo $row['no']?>"><?php echo $row['title']?></a>
							</td>
							<td class="author"><?php echo $row['author']?></td>
							<td class="date"><?php echo $row['b_date']?></td>
							<td class="hit"><?php echo $row['hit']?></td>
						</tr>
						<?php
							}
						}
						?>
				</tbody>
			</table>
			<div class="btnSet">
				<a href="./free_write.php" class="btnWrite btn">글쓰기</a>
			</div>
			<div class="paging">
				<?php echo $paging ?>
			</div>
			<?php
			if(isset($emptyData)) {
				} else {
				}			?>
			<div class="searchBox">
				<form action="./free_index.php" method="get">
					<select name="searchColumn">
						<option <?php echo $searchColumn=='title'?'selected="selected"':null?> value="title">제목</option>
						<option <?php echo $searchColumn=='content'?'selected="selected"':null?> value="content">내용</option>
						<option <?php echo $searchColumn=='author'?'selected="selected"':null?> value="author">작성자</option>
					</select>
					<input type="text" name="searchText" value="<?php echo isset($searchText)?$searchText:null?>">
					<button class = cobtn type="submit">검색</button>
				</form>
			</div>
		</div>
	</article>
</div>
</body>
</html>
