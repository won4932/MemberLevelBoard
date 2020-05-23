<?php
    include $_SERVER['DOCUMENT_ROOT']."/board/db.php";

    $bno = $_GET['idx'];
    $sql = dbSend("select * from list_board where idx = '$bno'; ");
    $board = $sql -> fetch_array();
?>
<!doctype html>
<head>
<meta charset = "UTF-8">
<title>게시판</title>
<link rel = "stylesheet" href = "../css/style.css"/>
</head>
<body>
    <div id="boardWrite">
        <h1><a href = "/board/">회원레벨게시판</a></h1>
        <h4>글을 수정합니다</h4>
            <div id = "writeArea">
            <!-- write.php 동일 -->
            <!-- modifyOK.php 데이터 전송하면서 수정한 데이터를 게시글번호에 전송 -->
                <form action = "modifyOk.php/<?php echo $board['idx']; ?>" method = "POST">
                    <input type ="hidden" name = "idx" value= "<?=$bno?>"/>
                    <div id = "inTitle">
                        <textarea name = "title" id = "utitle" rows="1" cols="55" placeholder = "제목" maxlength="100" required><?php echo $board['title']; ?></textarea>
                    </div> 
                    <div id = "writeLine"></div>
                    <div id = "inName">
                        <textarea name = "name" id = "uname" rows="1" cols="55" placeholder = "작성자" maxlength="100" require><?php echo $board['name']; ?></textarea>
                    </div>
                    <div id = "writeLine"></div>
                    <div id = "inContent">
                        <textarea name = "content" id = "ucontent" placeholder = "내용" require><?php echo $board['content']; ?></textarea>
                    </div>
                    <div id = "inPw">
                        <input type = "password" name = "pw" id = "upw" placeholder = "비밀번호" require/>
                    </div>
                    <?php if($board['lockCk']=='1') { ?>
                        <div id = "inLock">
                        <input type = "checkbox" value = "1" name = "lockCk" checked/> 해당글을 잠금니다.
                    </div>
                    <?php }else { ?>
                    <div id = "inLock">
                        <input type = "checkbox" value = "1" name = "lockCk" /> 해당글을 잠금니다.
                    </div>
                    <?php } ?>
                    <div id = "inFile">
                        <input type="file" value="1" name="bFile" /><?php echo $board['file']; ?>
                    </div>
                    <div class = "btnInsert">
                        <button type = "submit">글 작성</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>