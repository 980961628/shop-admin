<?php
//    session_start();
//    session_destroy();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
    <title>用户注册</title>
    <link rel="stylesheet" href="public/plugins/Swiper3/css/swiper.min.css">
    <link rel="stylesheet" href="public/css/login.css">
    <link rel="stylesheet" href="public/plugins/frozen.1.3.0/css/frozen.css">
</head>
<body>
<!--    <header class="ui-header ui-header-positive ui-border-b">-->
<!--        <i class="ui-icon-return" onclick="history.back()"></i><h1>登录</h1>-->
<!--    </header>-->
<img src="public/images/fmj.jpg" alt="img" class="bg-img">

<div class="page">
    <div class="login-box" style="margin-top: 40%">
        <form action="api/api.php" method="post" id="form">
            <input type="hidden" value="register" name="module">
            <ul>
                <li><input type="text" name="username" placeholder="请输入用户名" id="username"></li>
                <li><input type="text" name="tel" placeholder="请输入手机号" id="tel"></li>
                <li><input type="password" name="password" placeholder="请输入密码" id="password"></li>
                <li><input type="password" name="password2" placeholder="请确认密码" id="password2"></li>
                <li><input type="submit" value="马上注册"></li>
                <li><a href="login.php">已有账号，去登录</a></li>
            </ul>
        </form>
    </div>
</div>

<script src="public/plugins/jquery-3.2.1/jquery.min.js"></script>
<script src="public/plugins/jquery.form.min.js"></script>
<!--    <script src="public/plugins/frozen.1.3.0/js/frozen.js"></script>-->
<!--    <script src="public/plugins/Swiper3/js/swiper.min.js"></script>-->

<script>
    $(function(){
        var options={
            beforeSubmit: function(){
                var username = $("#username").val();
                var tel = $("#tel").val();
                var password = $("#password").val();
                var password2 = $("#password2").val();
                if(username==""){
                    alert("请输入用户名");return false;
                }
                if(!(/1[3|5|7|8|9]\d{9}/.test(tel))){
                    alert("请输入正确的手机号码");return false;
                }
                if(password ==""){
                    alert("请输入密码");return false;
                }
                if(password2 ==""){
                    alert("请输入确认密码");return false;
                }
                if(password != password2){
                    alert("密码不一致");return false;
                }
            },  //提交前的回调函数
            success: function(res){
                console.log(res)
                alert(res.msg);
                if(res.status==0){
                    location.href="index.php";
                }
            },
            error:function(res){
                console.log(res)
                alert("注册失败,正在开发")
            },
            dataType:"json"
        };

        $("#form").submit(function(){
            $(this).ajaxSubmit(options);
            return false;
        });

//        bgImg.css('left',left+'px');
    })
</script>
</body>
</html>
