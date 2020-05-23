<?php
 include "header.php";
 include "db.php";
?>
<div id="boardArea">
    <h1>회원레벨게시판</h1>
    <h4>자유롭게 글을 쓸 수 있는 게시판. </h4>
    <span id="memInfo">
     <?php
      if(isset($_SESSION['userid'])) { // 세션 userid가 있으면 페이지를 보여줌
          $sqlCk = dbSend("select * from levelpoint where userid='".$_SESSION['userid']."'");
          $loPoint = $sqlCk -> fetch_array();
      ?>
      <?php echo $_SESSION['userid']; ?>님 어서오세요. &nbsp;&nbsp;&nbsp;<a href="member/logout.php">로그아웃</a><br />
        <?php
         switch($loPoint['point']) {
             case '0':
             echo "현재등급 : 새싹등급 0포인트";
             break;

             case '1':
                echo "현재등급 : 일반등급 1포인트";
             break;

             case '2':
                echo "현재등급 : 중간등급 2포인트";
             break;

             case '3':
                echo "현재등급 : 고급등급 3포인트";
             break;

             case '4':
                echo "현재등급 : 최고급등급 4포인트";
             break;

             default:
             echo "현재등급 : 슈퍼등급 ", $loPoint['point'], "포인트";
            break;
         } // switch?>
         <?php }else { // 세션 userid체크해서 없으면 로그인 폼 표시?> 
          <form action = "member/loginOK.php" method="post">
           <ul>
            <li><input type="text" name="userid" placeholder="아이디" required /></li>
            <li><input type="text" name="userpw" placeholder="비밀번호" required /></li>
            <li><input type="submit" value="로그인" ></li>
            <li> <a href='member/joinForm.php'>회원가입</a></li>
           </ul>
          </form>
        <?php } ?> </span>
        <div id="boardList">
        <h2>일반유저 게시판</h2>
         <p><b>게시판 선택</b></p>
          <ul>
           <li><a href="index.php">자유게시판</a></li>
           <li><a href="board2.php">일반유저 게시판</a></li>
           <li><a href="board3.php">중간게시판</a></li>
           <li><a href="board4.php">고급게시판</a></li>
           <li><a href="board5.php">최고급게시판</a></li>
          </ul>
        </div>
        
        <?php
				if(!isset($_SESSION['userid'])){
					echo "<div id='notUse'>로그인을 해야 볼 수 있습니다.</div>";
				}else if($loPoint['point']=='1' || $loPoint['point']>'1'){
			?>
         
        <table class="listTable">
            <thead>
                <tr>
                 <th width = "70">번호</th>
                 <th width = "500">제목</th>
                 <th width = "120">작성자</th>
                 <th width = "100">작성일</th>
                 <th width = "100">조회수</th>
                </tr>
            </thead>
            <?php
					$sql = dbSend("select * from list_board order by idx desc limit 0,5");  
					while($board = $sql->fetch_array()){

					$title=$board["title"]; 
						if(strlen($title)>30){ 
							$title=str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]);
						}
					?>
					<tbody>
						<tr>
							<td><?php echo $board['idx']; ?></td>
							<td><a href='page/read.php?idx=<?php echo $board["idx"]; ?>'><?php echo $title; ?></a></td>
							<td><?php echo $board['name']?></td>
							<td><?php echo $board['date']?></td>
                     <td width = "100"><?php echo $board['hit'];?></td>
						</tr>
					</tbody>
				<?php } ?>
			</table>
			<div id="writeBtn">
				<a href="page/write.php"><button>글쓰기</button></a>
			</div>
		</div>
		
		<?php }else{
			echo "<div id='notUse'>일반등급만 볼 수 있는 게시판입니다.<br />글을 작성해서 1포인트를 적립하세요.(일반등급 1포인트)</div>";
		}?>
	</div>
</body>
</html>