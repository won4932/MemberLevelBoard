<?php
	include $_SERVER['DOCUMENT_ROOT']."/board/db.php";

	$bno = $_POST['bno'];
	$userpw = password_hash($_POST['datPw'], PASSWORD_DEFAULT);
	$sql = dbSend("insert into reply(con_num,name,pw,content) values('".$bno."','".$_POST['datUser']."','".$userpw."','".$_POST['content']."')");
?>
<script type="text/javascript" src="/board/js/common.js"></script>

	<h3>댓글목록</h3>
		<?php
			$sql2 = dbSend("select * from reply where con_num='".$bno."' order by idx desc");
			while($reply = $sql2->fetch_array()){ 
		?>
		<!-- read.php내용-->
		<div class="dapLo">
                <div><b><?php echo $reply['name'];?></b></div>
                <div class="dapConEdit"><?php echo nl2br("$reply[content]"); ?></div>
                <div class="repMeDapTo"><?php echo $reply['date']; ?></div>
                <div class="repMenu">
                    <a class="datEditBtn" href="#">수정</a>
                    <a class="datDelBtn" href="#">삭제</a>
                </div>
			<!-- 댓글 수정 폼 dialog -->
			<div class="datEdit">
				<form method="post" action="replyModifyOk.php">
					<input type="hidden" name="rno" value="<?php echo $reply['idx']; ?>" />
					<input type="hidden" name="reBno" value="<?php echo $bno; ?>">
					<input type="password" name="pw" class="dapPw" placeholder="비밀번호" />
					<textarea name="content" class="dapEditText"><?php echo $reply['content']; ?></textarea>
					<input type="submit" value="수정하기" class="reModifyBtn">
				</form>
			</div>
			<!-- 댓글 삭제 비밀번호 확인 -->
			<div class='datDelete'>
				<form action="replyDelete.php" method="post">
					<input type="hidden" name="rno" value="<?php echo $reply['idx']; ?>" />
					<input type="hidden" name="reBno" value="<?php echo $bno; ?>">
					 <p>비밀번호<input type="password" name="pw" /> 
					 <input type="submit" value="확인"></p>
				 </form>
			</div>
		</div>
	<?php } ?>

	<!--- 댓글 입력 폼 -->
	<div class="dapInsert">
		<form method="post" class="replyForm">
				<input type="hidden" name="bno" class="bno" value="<?php echo $bno; ?>">
                <input type="text" name="datUser" id="datUser" class="datUser" size="15" placeholder="아이디">
                <input type="password" name="datPw" id="datPw" class="datPw" size="15" placeholder="비밀번호">
                <div style="margin-top:10px;">
                    <textarea name="content" class="replyContent" id="reContent"></textarea>
				<button type="submit" id="repBtn" class="repBtn">댓글</button>
			</div>
		</form>
	</div>