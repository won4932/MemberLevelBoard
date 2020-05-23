<?php
// 로그아웃 시 세션값 삭제
 include "../db.php";
 session_destroy();
?>
<meta charset="utf-8">
<script>alert("로그아웃되었습니다!"); location.href="/board/"; </script>