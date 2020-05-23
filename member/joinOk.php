<?php

include "../db.php";

$userid = $_POST['userid'];
$userpw = password_hash($_POST['userpw'], PASSWORD_DEFAULT);
$username = $_POST['name'];

// 중복체크
$id_check = dbSend("select * from member where id='$userid'");
 $id_check = $id_check->fetch_array();
 if($id_check >= 1) {
     echo "<script>alert('아이디가 중복됩니다.'); history.back();</script>";
 }else{
     $sql = dbSend("insert into member(id, pw, name) values('".$userid."','".$userpw."','".$username."')");
     // 회원추가 시 권한도 추가(기본포인트 0)
     $sql2 = dbSend("insert into levelpoint(userid, point) values('".$userid."', '0')");
     ?>
    <script type="text/javascript">alert('회원가입 완료되었습니다!');</script>
    <meta http-equiv="refresh" content="0 url=/board/">
 <?php } ?>