<?php
    session_start();
    // utf-8 인코딩
    header('Content-Tyoe: text/html; charset=utf-8');

    // mysql연결 db호스트주소, id, pw, db이름
    $db = new mysqli("localhost", "root", "1234", "php");
    $db-> set_charset("utf8");

    // 외부에서 선언된 sql를 함수내에서 쓰기 위해 global 선언
    function dbSend($sql) {
        global $db;
        return $db->query($sql);
    }
?>