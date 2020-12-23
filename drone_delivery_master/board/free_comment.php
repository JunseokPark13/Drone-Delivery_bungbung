<?php
	if(session_status() == PHP_SESSION_NONE) session_start();

	$sql = 'select * from board_comment where comment_no=comment_recur and no=' . $bNo;

	$result = $db->query($sql);

?>

<div id="commentView">
	<form action="free_comment_update.php" method="post">
		<input type="hidden" name="bno" value="<?php echo $bNo?>">

	<?php

		while($row = $result->fetch_assoc()) {

	?>

	<ul style = list-style:none; class="oneDepth">

		<li>

			<div id="co_<?php echo $row['comment_no']?>" class="commentSet">

		<div class="commentInfo">

			<span class="coId"><?php echo $row['comment_id']?></span>

				<div class="commentBtn">
					<?php
						if($_SESSION['ID']!=NULL) {
					?>
					<a style = color:white; href="#" class="comt write">답글</a>
					<?php
				}
					 ?>
				<?php
					if($_SESSION['ID'] == $row['comment_id']){
				?>

					<a style = color:white; href="#" class="comt modify">수정</a>

					<a style = color:white; href="#" class="comt delete">삭제</a>
					<?php
						}
						 ?>
				</div>

			</div>
			<div class="commentContent"><?php echo $row['comment_content']?></div>
		</div>

			<?php

				$sql2 = 'select * from board_comment where comment_no!=comment_recur and comment_recur=' . $row['comment_no'];

				$result2 = $db->query($sql2);



				while($row2 = $result2->fetch_assoc()) {

			?>

			<ul style = list-style:none;  class="twoDepth">

				<li>

					<div id="co_<?php echo $row2['comment_no']?>" class="commentSet">

							<div class="commentInfo">

								<div class="commentId"><span class="coId"><?php echo $row2['comment_id']?></span></div>

								<div class="commentBtn">
									<?php
										if($_SESSION['ID'] == $row2['comment_id']){
									?>

									<a style = color:white; href="#" class="comt modify">수정</a>

									<a style = color:white; href="#" class="comt delete">삭제</a>
									<?php
										}
									?>
								</div>

							</div>

							<div class="commentContent"><?php echo $row2['comment_content'] ?></div>

						</div>

				</li>

			</ul>

			<?php

				}

			?>

		</li>

	</ul>

	<?php } ?>
</form>
</div>
<?php if(isset($_SESSION['ID'])){
	?>
<form action="free_comment_update.php" method="post">
	<input type="hidden" name="bno" value="<?php echo $bNo?>">
	<table>
		<tbody>
			<tr>
				<th scope="row"></th>
				<td>  <!-- <input type="text" name="coId" id="coId"> -->
					<?php
					$row['comment_id'] = $_SESSION['ID'];
				//	"coId" = $_SESSION['userid'];
					 ?>
				</td>
			</tr>
			<!--
			<tr>
				<th scope="row"><label for="coPassword">비밀번호</label></th>
				<td><input type="password" name="coPassword" id="coPassword"></td>
			</tr>
		-->
			<tr>
				<th scope="row"></th>
				<td><textarea class = coCon name="coContent" id="coContent"></textarea></td>
				<div class="btnSet">
					<td><input class = cobtn type="submit" value="코멘트 작성"></td>
				</div>
			</tr>
	</tbody>
	</table>
</form>
<?php
	}
	?>

<script>

	$(document).ready(function () {

		var action = '';



		$('#commentView').delegate('.comt', 'click', function () {

			//현재 위치에서 가장 가까운 commentSet 클래스를 변수에 넣는다.

			var thisParent = $(this).parents('.commentSet');



			//현재 작성 내용을 변수에 넣고, active 클래스 추가.

			var commentSet = thisParent.html();

			thisParent.addClass('active');



			//취소 버튼

			var commentBtn = '<a style = color:white; href="#" class="addComt cancel">취소</a>';



			//버튼 삭제 & 추가

			$('.comt').hide();

			$(this).parents('.commentBtn').append(commentBtn);





			//commentInfo의 ID를 가져온다.

			var comment_no = thisParent.attr('id');



			//전체 길이에서 3("co_")를 뺀 나머지가 comment_no

			comment_no = comment_no.substr(3, comment_no.length);



			//변수 초기화

			var comment = '';

			var coId = '';

			var coContent = '';



			if($(this).hasClass('write')) {

				//댓글 쓰기

				action = 'w';

				//ID 영역 출력

				//coId = '<input type="text" name="coId" id="coId">';
				coId = '<?php echo $_SESSION['ID'] ?>'



			} else if($(this).hasClass('modify')) {

				//댓글 수정

				action = 'u';



				coId = thisParent.find('.coId').text();
				//coId = '$_SESSION['userid']';
				var coContent = thisParent.find('.commentContent').text();



			} else if($(this).hasClass('delete')) {

				//댓글 삭제

				action = 'd';

			}



				comment += '<div class="writeComment">';

				comment += '	<input type="hidden" name="w" value="' + action + '">';

				comment += '	<input type="hidden" name="comment_no" value="' + comment_no + '">';

				comment += '	<table>';

				comment += '		<tbody>';

				if(action !== 'd') {

					comment += '			<tr>';

					comment += '				<th scope="row"><label for="coId"></label></th>';

					comment += '			</tr>';

				}

				/*
				comment += '			<tr>';

				comment += '				<th scope="">';

				comment += '			<label for="coPassword">비밀번호</label></th>';

				comment += '				<td><input type="password" name="coPassword" id="coPassword"></td>';

				comment += '			</tr>';
				*/


				if(action !== 'd') {

					comment += '			<tr>';

					comment += '				<th scope="row"><label for="coContent"></label></th>';

					comment += '				<td><textarea class = coCon name="coContent" id="coContent">' + coContent + '</textarea></td>';

					comment += '	<div class="btnSet">';

					comment += '		<td><input class = cobtn type="submit" value="확인"></td>';

					comment += '	</div>';

					comment += '			</tr>';

				}
				else{
					comment += '	<div class="btnSet">';

					comment += '		<input class = cobtn type="submit" value="확인">';

					comment += '	</div>';
				}

				comment += '		</tbody>';

				comment += '	</table>';



				comment += '</div>';



				thisParent.after(comment);

			return false;

		});



		$('#commentView').delegate(".cancel", "click", function () {

				$('.writeComment').remove();

				$('.commentSet.active').removeClass('active');

				$('.addComt').remove();

				$('.comt').show();

			return false;

		});

	});

</script>
