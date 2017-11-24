<?php
    include 'config.php';
    $id = $_GET['id'];
    $sql = "SELECT * FROM shop WHERE id={$id}";
    $res = $mysqli->query($sql);
    $shop = $res->fetch_assoc();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
    <title>商品详情</title>
    <link rel="stylesheet" href="public/plugins/Swiper3/css/swiper.min.css">
    <link rel="stylesheet" href="public/css/shop-detail.css">
    <link rel="stylesheet" href="public/plugins/frozen.1.3.0/css/frozen.css">
</head>
<body>
    <header class="ui-header ui-header-positive ui-border-b">
        <i class="ui-icon-return" onclick="history.back()"></i><h1><?php echo $shop['name'];?></h1>
    </header>
    <div style="height: 45px;"></div>
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="public/upload/<?php echo $shop['pic'];?>" alt="">
            </div>
        </div>
        <!-- 如果需要分页器 -->
        <div class="swiper-pagination"></div>
    </div>
    <div class="container">
        <h2 class="name"><?php echo $shop['name'];?></h2>
        <div class="price">￥<?php echo $shop['price'];?>/元</div>
    </div>

    <div class="cart"><i>0</i></div>
    <footer>
        <ul class="ui-tiled ui-border-t">
            <li class="ui-border-r"><div>加入购物车</div></li>
            <li><div>立即下单</div></li>
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
