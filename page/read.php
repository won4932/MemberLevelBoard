<?php
    include $_SERVER['DOCUMENT_ROOT']."/board/db.php";
?>
<!doctype html>
<head>
<meta charset="UTF-8">
<title>게시판</title>
<link rel ="stylesheet" type="text/css" href="/board/css/style.css" />
<link rel = "stylesheet" type = "text/css" href="/board/css/jquery-ui.css"/>
<script type = "text/javascript" src = "/board/js/jquery-3.2.1.min.js"></script>
<script type = "text/javascript" src = "/board/js/jquery-ui.js"></script>
<script type = "text/javascript" src = "/board/js/common.js"></script>
</head>
<body>
    <?php
        $bno = $_GET['idx'];
        // 번호를 기준으로 검색
        $hit = mysqli_fetch_array(dbSend("select * from list_board where idx = '".$bno."'"));
        $hit = $hit['hit'] + 1; // 조회수 카운트
        // db업데이트 후 검색
        $fet = dbSend("update list_board set hit = '".$hit."' where idx = '".$bno."'");
        $sql = dbSend("select * from list_board where idx = '".$bno."'");
        $board = $sql -> fetch_array();
    ?>

<!-- 글 불러오기 -->
<div id = "boardRead">
    <h2><?php echo $board['title']; ?></h2>
        <div id = "userInfo">
            <?php echo $board['name']; ?> <?php echo $board['date']; ?> 조회 : <?php echo $board['hit']; ?>
                <div id = "boLine"></div>
        </div>
        <div>
        파일 : <a href="../upload/<?php echo $board['file'];?>" download><?php echo $board['file']; ?></a>
        </div>
        <div id = "boContent">
            <?php echo nl2br("$board[content]"); ?>
        </div>
<!-- list, 수정, 삭제 -->
<div id = "boSer">
    <ul>
        <li><a href = "/board/"> [목록으로] </a></li>
        <li><a href = "modify.php?idx=<?php echo $board['idx']; ?>"> [수정] </a></li>
        <li><a href = "delete.php?idx=<?php echo $board['idx']; ?>"> [삭제] </a></li>
    </ul>
</div>
<!-- 댓글 -->
<div class="replyView">
    <h3>댓글목록</h3>
        <?php 
        // db에 있는 댓글목록들을 불러옴, 게시판번호에 해당하는 댓글들을 불러온다
            $sql2 = dbSend("select * from reply where con_num='".$bno."' order by idx desc");
            while($reply = $sql2->fetch_array()) {
        ?>
        <div class="dapLo">
        <!-- 수정/삭제는 jquery-ui에 dialog기능 이용-->
                <div><b><?php echo $reply['name'];?></b></div>
                <div class="dapTo conmentEdit"><?php echo nl2br("$reply[content]"); ?></div>
                <div class="repMe dapTo"><?php echo $reply['date']; ?></div>
                <div class="repMenu">
                    <a class="datEditBtn" href="#">수정</a>
                    <a class="datDelBtn" href="#">삭제</a>
                </div>
                <!-- 댓글 수정 dialog -->
                <div class="datEdit">
                <form method="post" action="replyModifyOk.php">
					<input type="hidden" name="rno" value="<?php echo $reply['idx']; ?>" />
					<input type="hidden" name="reBno" value="<?php echo $bno; ?>">
					<input type="password" name="pw" class="dapPw" placeholder="비밀번호" />
					<textarea name="content" class="dapEditText"><?php echo $reply['content']; ?></textarea>
					<input type="submit" value="수정하기" class="reModifyBtn">
				</form>
                </div>

                <!--- 댓글 삭제 pw 확인 -->
                <div class='datDelete'>
				<form action="replyDelete.php" method="post">
                    <input type="hidden" name="rno" value="<?php echo $reply['idx']; ?>" />
                    <input type="hidden" name="reBno" value="<?php echo $bno; ?>">
                     <p>비밀번호<input type="password" name="pw" /> 
                     <input type="submit" value="확인"></p>
				 </form>
			</div>
            </div>
        <?php    } ?>

        <!-- 댓글 입력 -->
        <div class="dapInsert">
                <input type="hidden" name="bno" class="bno" value="<?php echo $bno; ?>">
                <input type="text" autocomplete="off" name="datUser" id="datUser" class="datUser" size="15" placeholder="아이디">
                <input type="password" name="datPw" id="datPw" class="datPw" size="15" placeholder="비밀번호">
                <div style="margin-top:10px;">
                    <textarea name="content" class="replyContent" id="reContent"></textarea>
                    <button id="repBtn" class="repBtn">댓글</button>
                </div>
            </div>
        </div><!-- 댓글 불러오기 끝 -->
    <div id ="footBox"></div>
</div>
</body>
</html>

