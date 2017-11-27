<?php
    include 'config.php';
    include 'public/function.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
    <title>我的订单</title>
    <link rel="stylesheet" href="public/plugins/Swiper3/css/swiper.min.css">
    <link rel="stylesheet" href="public/css/center.css">
    <link rel="stylesheet" href="public/plugins/frozen.1.3.0/css/frozen.css">
</head>
<body>
    <header class="ui-header ui-header-positive ui-border-b">
        <i class="ui-icon-return" onclick="history.back()"></i>
        <h1>个人中心</h1>
        <i class="ui-icon-home" onclick="location.href='index.php'"></i>
    </header>
    <div class="ui-container ui-border-b">
        <div class="ui-center">
            <p><?php echo $_SESSION['username'];?></p>
            <p><?php echo $_SESSION['tel'];?></p>
        </div>
    </div>
    <ul class="ui-list ui-border-tb ui-list-link">
        <li class="ui-border-t" onclick="location.href='cart.php'">
            <div class="ui-list-thumb-s">
                <span style="background-image:url(http://placeholder.qiniudn.com/56x56)"></span>
            </div>
            <div class="ui-list-info">
                <h4 class="ui-nowrap">购物车</h4>
            </div>
        </li>
        <li class="ui-border-t" onclick="location.href='order-list.php'">
            <div class="ui-list-thumb-s">
                <span style="background-image:url(http://placeholder.qiniudn.com/56x56)"></span>
            </div>
            <div class="ui-list-info">
                <h4 class="ui-nowrap">我的订单</h4>
            </div>
        </li>
        <li class="ui-border-t">
            <div class="ui-list-thumb-s">
                <span style="background-image:url(http://placeholder.qiniudn.com/56x56)"></span>
            </div>
            <div class="ui-list-info">
                <h4 class="ui-nowrap">地址管理</h4>
            </div>
        </li>
        <li class="ui-border-t">
            <div class="ui-list-thumb-s">
                <span style="background-image:url(http://placeholder.qiniudn.com/56x56)"></span>
            </div>
            <div class="ui-list-info">
                <h4 class="ui-nowrap">个人资料设置</h4>
            </div>
        </li>

    </ul>
    <footer>
        <ul class="ui-tiled ui-border-t">
            <li class="ui-border-r"><a href="index.php"><div>店铺</div></a></li>
            <li><a href="center.php"><div>我的</div></a></li>
        </ul>
    </footer>

    <script src="public/plugins/jquery-3.2.1/jquery.min.js"></script>
<!--    <script src="public/plugins/zepto/zepto.min.js"></script>-->
<!--    <script src="public/plugins/frozen.1.3.0/js/frozen.js"></script>-->
    <script src="public/plugins/Swiper3/js/swiper.min.js"></script>
    <script type="text/javascript">
        var mySwiper = new Swiper('.swiper-container',{
            loop: true,
            autoplay: 3000,
            pagination: '.swiper-pagination'
        });
    </script>
</body>
</html>
