<link rel="stylesheet" type="text/css" href="/styletest.css"/>
<?php
    $db = new mysqli("localhost", "root", "1234", "php");

    if($db){
        echo "MySQL 접속 성공";
    }else{
        echo "MySQL 접속 실패";
    }
 ?>