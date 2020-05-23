<?php

include $_SERVER['DOCUMENT_ROOT']."/board/db.php";

$date = date('Y-m-d');
$userpw = password_hash($_POST['pw'], PASSWORD_DEFAULT);
$sqlCk = dbSend("select * from levelpoint where userid='".$_SESSION['userid']."'");

if(isset($_POST['lockCk'])){
	$lock_post = '1';
}else{
	$lock_post = '0';
}

// 받아온 파일을 저장하고 임시파일 tmpName생성
$tmpfile = $_FILES['bFile']['tmp_name'];
// 원래파일명을 넣고
$oName = $_FILES['bFile']['name'];
// 한글꺠짐 방지
$filename = iconv("UTF-8", "EUC-KR", $_FILES['bFile']['name']);
$folder = "../upload/".$filename;
move_uploaded_file($tmpfile, $folder);
// auto_increment값 초기화
$idxReset = dbSend("alter table list_board auto_increment = 1");

$sql = dbSend("insert into list_board(name,pw,title,content,date,lockCk,file) 
values('".$_POST['name']."','".$userpw."','".$_POST['title']."','".$_POST['content']."',
'".$date."', '".$lock_post."', '".$oName."')"); ?>
<script type="text/javascript">alert("글쓰기 완료되었습니다.");</script>
<!-- 글쓰기 완료 후 회원레벨 포인트 증가 -->
<?php
	if(!isset($_SESSION['userid'])){

	}else{
		$loPoint = dbSend("update levelpoint set point = point+1 where userid='".$_SESSION['userid']."'");
	}
?>
<meta http-equiv="refresh" content="0 url=/board/" />


