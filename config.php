<?php
    session_start();
    const HOST = "localhost";
    const USER = "root";
    const PASSWORD = "root";
    const DB_NAME = "shop";

    $mysqli = mysqli_connect(HOST,USER,PASSWORD,DB_NAME) or die('数据库连接失败');
    $sql = "set names utf8";
    $mysqli->query($sql);
