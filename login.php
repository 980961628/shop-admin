<?php

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
    <title>用户登录</title>
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
        <div class="login-box">
            <form action="api/api.php" method="post" id="form">
                <input type="hidden" value="login" name="module">
                <ul>
                    <li><input type="text" name="username" placeholder="请输入用户名" id="username"></li>
                    <li><input type="password" name="password" placeholder="请输入密码" id="password"></li>
                    <li><input type="submit" value="登录"></li>
                    <li><a href="register.php">没有账号,去注册</a></li>
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
                    if($("#username").val()==""){
                        alert("请输入用户名");return false;
                    }
                    if($("#password").val()==""){
                        alert("请输入密码");return false;
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
                    alert("登录失败,正在开发")
                },
                dataType:"json"
            };

            $("#form").submit(function(){
                $(this).ajaxSubmit(options);
                return false;
            });
        })
    </script>
</body>
</html>
