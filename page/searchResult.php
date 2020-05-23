<?php
    include $_SERVER['DOCUMENT_ROOT']."/board/db.php";
?>
<!doctype html>
<head>
<meta charset="UTF-8">
<title>PHP게시판</title>
<link rel="stylesheet" type="text/css" href="../css/style.css" />
</head>
<body>
<div id="boardArea">
<?php
 $category = $_GET['category'];
 $searchCon = $_GET['search'];

?>

<h1><?php echo $category; ?>에서 '<?php echo $searchCon; ?>'검색결과</h1>
<h4 style="margin-top:30px;"><a href="/board/">홈으로</a></h4>
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
   $sql2 = dbSend("select * from list_board where $category like '%$searchCon%' order by idx desc");
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
            <td width="500"><?php 
           $lockimg = "<img src='/board/img/lockCk.png' alt='lockCk' title='lockCk' width='20' height='20' />";
            if($board['lockCk']=="1"){ ?>
            <a href='ckRead.php?idx=<?php echo $board["idx"];?>'><?php echo $title, $lockimg;
            }else{  ?>

            <?php
            $boardTime = $board['date'];
            $timeNow = date("Y-m-d");
               
           
            if($boardTime==$timeNow) {
                $img = "<img src='/board/img/new.png' alt='new' title='new' />";
            }else {
                $img = "";
            } ?>
             <a href='read.php?idx=<?php echo $board["idx"]; ?>'><?php echo $title; }?>
             <span class="reCount">[<?php echo $repCount; ?>]<?php echo $img; ?> </span></a></td>
            <td width = "120"><?php echo $board['name'];?></td>
            <td width = "100"><?php echo $board['date'];?></td>
            <td width = "100"><?php echo $board['hit'];?></td>
           </tr>
   </tbody>
       <?php } ?>
</table>
<div id="searchBox2">
      <form action="searchResult.php" method="get">
      <select name="category">
        <option value="title">제목</option>
        <option value="name">글쓴이</option>
        <option value="content">내용</option>
      </select>
      <input type="text" name="search" size="40" required="required"/> <button>검색</button>
    </form>
  </div>
</div>
</body>
</html>