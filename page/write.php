<!doctype html>
<head>
    <meta charset = "UTF-8">
    <title> 게시판 </title>
    <link rel = "stylesheet" type = "text/css" href = "../css/style.css"/>
</head>
<body>
    <div id = "boardWrite">
        <h1><a href = "/board/"> 회원레벨게시판 </a></h1>
        <h4> 글 작성 공간.</h4>
            <div id = "writeArea">
                <form action = "writeOk.php" method = "post" enctype="multipart/form-data">
                    <div id = "inTitle">
                        <textarea name = "title" id = "utitle" rows="1" cols="55" placeholder = "제목" maxlength="100" required></textarea>
                    </div> <!-- required는 필수입력항목(빈칸일 경우 경고) -->
                    <div id = "writeLine"></div>
                    <div id = "inName">
                        <textarea name = "name" id = "uname" rows="1" cols="55" placeholder = "작성자" maxlength="100" require></textarea>
                    </div>
                    <div id = "writeLine"></div>
                    <div id = "inContent">
                        <textarea name = "content" id = "ucontent" placeholder = "내용" require></textarea>
                    </div>
                    <div id = "inPw">
                        <input type = "password" name = "pw" id = "upw" placeholder = "비밀번호" require/>
                    </div>
                    <div id = "inLock">
                        <input type = "checkbox" value = "1" name = "lockCk" /> 해당글을 잠금니다.
                    </div>
                    <div id = "inFile">
                        <input type="file" value="1" name="bFile" />
                    </div>
                    <div class = "btnInsert">
                        <button type = "submit">글 작성</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>


