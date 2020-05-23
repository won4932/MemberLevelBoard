<?php
include $_SERVER['DOCUMENT_ROOT']."/board/db.php";

$bno = $_POST['idx'];
$userpw = password_hash($_POST['pw'], PASSWORD_DEFAULT);

if(isset($_POST['lockCk'])){
	$lock_post = '1';
}else{
	$lock_post = '0';
}


$sql = dbSend("update list_board set name='".$_POST['name']."',pw='".$userpw."',title='".$_POST['title']."'
,content='".$_POST['content']."',lockCk='".$lock_post."' where idx='".$bno."'"); 
?>
<script type="text/javascript">alert("수정되었습니다.");</script>
<meta http-equiv="refresh" content="0 url=/board/page/read.php?idx=<?php echo $bno; ?>">