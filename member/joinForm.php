<?php
 include "../header.php";

 if(isset($_SESSION['userid'])) {
     echo "<script> alert('잘못된 접근입니다.'); history.back(); </script>";
 } else {
     ?>
     <!-- 아이디, 비밀번호, 이름 -->
     <div id="joinFormIn.php" method="post">
      <h2>회원가입</h2>
       <form action="joinOk.php" method="post">
        <div id="joinF">
         <div class="formGroup">
          <label for="userid">아이디</label>
          <div class="mb"><input type="text" class="input" id="userid" name="userid" placeholder="아이디"/></div>
         </div>
         <div class="formGroup">
          <label for="userpw">비밀번호</label>
          <div class="mb"><input type="password" class="input" id="userpw" name="userpw" placeholder="비밀번호"/></div>
         </div>
         <div class="formGroup">
          <label for="name">이름</label>
          <div class="mb"><input type="text" class="input" id="name" name="name" placeholder="이름을 입력해 주세요"/></div>
         </div>
         <div class="formBtn">
          <button type="submit" class="joinBtn">회원가입</button>
          <input type="button" value="가입취소" onclick="history.back(-1);"/>
         </div>
        </div> <!-- joinF end -->
    </form>
</div>

<?php }