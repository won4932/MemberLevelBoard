<?php
include $_SERVER['DOCUMENT_ROOT']."/board/db.php";
?>

<link rel = "stylesheet" type = "text/css" href="/board/css/jquery-ui.css"/>
<script type = "text/javascript" src = "/board/js/jquery-3.2.1.min.js"></script>
<script type = "text/javascript" src = "/board/js/jquery-ui.js"></script>
<script type = "text/javascript">
    $(function() {
        $("#writepass").dialog({
            modal:true, 
            title : '비밀글입니다!', 
            width : 400, 
        });
    });
</script>
<?php
    $bno = $_GET['idx'];
    $sql = dbSend("select * from list_board where idx = '".$bno."'");
    $board = $sql -> fetch_array();
?>
<div id = 'writepass'>
    <form action="" method="post">
        <p>비밀번호 <input type = "password" name = "pwChk"/>
        <input type = "submit" value = "확인"/> </p>
    </form>
</div>
    <?php 
    $bpw = $board['pw'];

    if(isset($_POST['pwChk'])) {
        // pwChk있다면 확인
        $pwk = $_POST['pwChk'];
        // 입력받은 값이 비밀번호와 같은지 체크
        if(password_verify($pwk, $bpw)) {
            $pwk == $bpw;
        ?>
        <script type = "text/javascript"> 
        // 같으면 read.php
        location.replace("read.php?idx=<?php echo $board["idx"]; ?>");
        </script>
        <?php }else{ ?>
        <!-- 다르면 틀리다는 메세지 표시 -->
            <script type = "text/javascript"> alert('비밀번호가 틀렸습니다!'); </script>
        <?php } } ?>