<?php
    // 현재위치에 db.php연결
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
                echo "현재등급 : 일반등급 2포인트";
             break;

             case '3':
                echo "현재등급 : 일반등급 3포인트";
             break;

             case '4':
                echo "현재등급 : 일반등급 4포인트";
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
        <h2>자유게시판</h2>
         <p><b>게시판 선택</b></p>
          <ul>
           <li><a href="index.php">자유게시판</a></li>
           <li><a href="board2.php">일반유저 게시판</a></li>
           <li><a href="board3.php">중간게시판</a></li>
           <li><a href="board4.php">고급게시판</a></li>
           <li><a href="board5.php">최고급게시판</a></li>
          </ul>
        </div>
        
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
            // 현재페이지 번호를 가져옴 번호가 없다면 첫페이지
            if(isset($_GET['page'])){
                $page = $_GET['page'];
            }else{
                $page = 1;
            }

            $sql = dbSend("select * from list_board");
            $rowNum = mysqli_num_rows($sql); // 게시판의 총 레코드 수
            $list = 5; // 한 페이지에 보여줄 개수
            $blockCt = 5; // 블록당 보여줄 페이지 개수
            // 블록이란 블록당 보여줄 페이지 블록1 - 1~5 / 블록2 6 ~ 10

            $blockNum = ceil($page/$blockCt); // 현재 페이지 블록 구하기
            // 1~5까지 1페이지(Ceil은 올림함수, 0.2, 0.4, 0.6...)
            $blockStart = (($blockNum -1) * $blockCt) + 1; // 블록 시작번호
            $blockEnd = $blockStart + $blockCt -1; // 블록 마지막번호

            $totalPage = ceil($rowNum / $list); // 페이징한 페이지 수
            // 만약 블록 마지막번호가 페이지 수보다 많다면 마지막번호는 페이지 수
            if($blockEnd > $totalPage) $blockEnd = $totalPage; 
            $totalBlock = ceil($totalPage / $blockCt); // 블록 총 개수
            $startNum = ($page - 1) * $list; // 시작번호

            $sql2 = dbSend("select * from list_board order by idx desc limit $startNum, $list");
            // 행이 끝날때까지 레코드 리턴
            while($board = $sql2 -> fetch_array()) {
                $title = $board["title"];
                    //title이 30넘어서면 ...으로 표시
                    if(strlen($title) > 30) {
                        $title = str_replace($board["title"], mb_substr($board["title"], 0, 30, "utf-8")."...", $board["title"]);
                    }
                    // con_num이 idx와 같은 것을 선택
                    $sql3 = dbSend("select * from reply where con_num='".$board['idx']."'");
                    // num_rows(행 개수 구하기)로 정수형태로 출력
                    $repCount = mysqli_num_rows($sql3);
            ?>
            <!-- 게시판 내용 -->
            <tbody>
                    <tr>
                     <td width = "70"><?php echo $board['idx']; ?></td>
                     <!-- idx를 가져와 read.php로 이동-->
                     <!-- lock 걸려있는 경우와 아닌경우를 분리 / lockimg -->
                     <td width="500">
                     <?php
                     $boardTime = $board['date'];
                     $timeNow = date("Y-m-d");
                        
                    
                     if($boardTime==$timeNow) {
                         $img = "<img src='img/new.png' alt='new' title='new' />";
                     }else {
                         $img = "";
                     } ?>
                     
                     <?php 
                    $lockimg = "<img src='img/lockCk.png' alt='lockCk' title='lockCk' width='20' height='20' />";
                     if($board['lockCk']=="1"){ ?>
                     <a href='/board/page/ckRead.php?idx=<?php echo $board["idx"];?>'><?php echo $title, $lockimg;
                     }else{  ?>

                     
                      <a href='page/read.php?idx=<?php echo $board["idx"]; ?>'><?php echo $title; }?>
                      <span class="reCount">[<?php echo $repCount;?>]<?php echo $img;?> </span></a></td>
                     <td width = "120"><?php echo $board['name'];?></td>
                     <td width = "100"><?php echo $board['date'];?></td>
                     <td width = "100"><?php echo $board['hit'];?></td>
                    </tr>
            </tbody>
                <?php } ?>
        </table>

        <div id="pageNum">
            <ul>
                        <?php
                        // 처음
                        // page가 1보다 크거나 같다면 처음에 빨간색
                        // 아니라면 처음글자에 1번으로 이동
                        if($page <= 1) {
                            echo "<span class='foRe'>처음</span>";
                        }else {
                            echo "<a href='?page=1'>처음</a>";
                        }
                        // 이전
                        // page가 1보다 크거나 같으면 빈 값
                        if($page <= 1) {

                        }else {
                            // 현재 페이지가 3이면 이전버튼을 누르면 2페이지로 가는 변수
                            $pre = $page -1;
                            echo "<a href='?page=$pre'>이전</a>";
                        }
                        // 블록 시작번호가 마지막 블록보다 작거나 같을때까지 반복
                        for($i = $blockStart; $i <= $blockEnd; $i++) {
                            // 페이지가 $i라면 번호에 굵은 빨간색
                            if($page == $i) {
                                echo "<span class='foRe'>[$i]</span>";
                            }else {
                                echo "<a href='?page=$i'>[$i]</a>";
                            }
                        }
                        //다음
                        // 현재블록이 총 블록개수 보다 크거나 같다면 빈 값
                        // next변수를 통해 다음 링크
                        if($blockNum >= $totalBlock) {

                        }else {
                            $next = $page + 1;
                            echo "<a href='?page=$next'>다음</a>";
                        }
                        // 마지막 글자에 빨간색
                        if($page >= $totalPage) {
                            echo "<span class='foRe'>마지막</span>";
                        }else {
                            echo "<a href='?page=$totalPage'>마지막</a>";
                        }
                    ?>
                </ul>
            </div>

        <!-- 글쓰기 -->
        <div id = "writeBtn">
                    <a href="page/write.php"><button>글쓰기</button></a>
        </div>

        <!-- 검색기능 -->
        <div id="searchBox">
            <form action="page/searchResult.php" method="get">
                <select name="category">
                    <option value="title">제목</option>
                    <option value="name">글쓴이</option>
                    <option value="content">내용</option>
                </select>
                <input type="text" name="search" size="40" required="required" />
            <button>검색</button></form>
        </div>
    </div>
</body>
</html>