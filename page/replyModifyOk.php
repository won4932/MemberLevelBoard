<?php
include $_SERVER['DOCUMENT_ROOT']."/board/db.php";
$rno = $_POST['rno'];
$sql = dbSend("select * from reply where idx = '".$rno."'");
$reply = $sql -> fetch_array();

$bno = $_POST['reBno'];
$sql2 = dbSend("select * from list_board where idx='".$bno."'");
$board = $sql2 -> fetch_array();
// reply, board idx가 같은 것 찾아 저장

//  <textarea>에서 입력한 내용을 가져옴
$sql3 = dbSend("update reply set content='".$_POST['content']
."' where idx = '".$rno."'"); ?>
<script type = "text/javascript">alert('수정되었습니다'); 
location.replace("read.php?idx=<?php echo $bno; ?>"); </script>