<?php
include $_SERVER['DOCUMENT_ROOT']."/board/db.php";
$rno = $_POST['rno']; 
$sql = dbSend("select * from reply where idx='".$rno."'");
$reply = $sql->fetch_array();

$bno = $_POST['reBno'];
$sql2 = dbSend("select * from list_board where idx='".$bno."'");
$board = $sql2->fetch_array();

$pwk = $_POST['pw'];
$bpw = $reply['pw'];

if(password_verify($pwk, $bpw)) {
    $sql = dbSend("delete from reply where idx = '".$rno."'"); ?>
    <script type = "text/javascript">alert('댓글이 삭제되었습니다');
    location.replace("read.php?idx=<?php echo $board["idx"]; ?>");</script>
    <?php
}else {
    ?> <script type="text/javascript">alert('비밀번호가 틀립니다!');
    history.back(); </script>
<?php } ?>
}