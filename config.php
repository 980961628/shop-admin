<?php
    session_start();
    date_default_timezone_set('PRC'); //设置中国时区

//    const HOST = "localhost";
//    const USER = "root";
//    const PASSWORD = "root";
//    const DB_NAME = "shop";
    const HOST = "bdm260329549.my3w.com";
    const USER = "bdm260329549";
    const PASSWORD = "zhu561559";
    const DB_NAME = "bdm260329549_db";

    $mysqli = mysqli_connect(HOST,USER,PASSWORD,DB_NAME) or die('数据库连接失败');
    $sql = "set names utf8";
    $mysqli->query($sql);
