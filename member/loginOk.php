<?php
 include "../db.php";

 $password = $_POST['userpw'];
 $sql = dbSend("select * from member where id='".$_POST['userid']."'");
 $member = $sql->fetch_array();
 // 해당 id에 저장된 비밀번호
 $hashPw = $member['pw'];
 // 비밀번호가 일치한다면 세션 저장 후 메인으로
 if(password_verify($password, $hashPw)){
     $_SESSION['userid'] = $member["id"];
     $_SESSION['userpw'] = $member["pw"];
     echo "<script>alert('로그인 되었습니다.'); location.href='/board/'; </script>";
 }else{
     // 같지 않다면 전 페이지로
     echo "<script>alert('아이디 혹은 비밀번호를 확인하세요.'); history.back();</script>";
 }
?>