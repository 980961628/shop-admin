<?php
    include 'config.php';
    include 'public/function.php';
    $sql = "SELECT * FROM shop ";
    $res = $mysqli->query($sql);
    $shopList=[];
    while($row = $res->fetch_assoc()){
        $shopList[]=$row;
    }
//    var_dump($_SESSION);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
    <title>Document</title>
    <link rel="stylesheet" href="public/plugins/Swiper3/css/swiper.min.css">
    <link rel="stylesheet" href="public/css/index.css">
    <link rel="stylesheet" href="public/plugins/frozen.1.3.0/css/frozen.css">
</head>
<body>
<!--    <header class="ui-header ui-header-positive ui-border-b">-->
<!--        <i class="ui-icon-return" onclick="history.back()"></i><h1>选项卡 tab</h1><button class="ui-btn">回首页</button>-->
<!--    </header>-->
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="https://ss1.bdstatic.com/70cFuXSh_Q1YnxGkpoWK1HF6hhy/it/u=764589726,4128176499&fm=27&gp=0.jpg" alt="">
            </div>
            <div class="swiper-slide">
                <img src="https://ss1.bdstatic.com/70cFuXSh_Q1YnxGkpoWK1HF6hhy/it/u=764589726,4128176499&fm=27&gp=0.jpg" alt="">
            </div>
            <div class="swiper-slide">
                <img src="https://ss1.bdstatic.com/70cFuXSh_Q1YnxGkpoWK1HF6hhy/it/u=764589726,4128176499&fm=27&gp=0.jpg" alt="">
            </div>
        </div>
        <!-- 如果需要分页器 -->
        <div class="swiper-pagination"></div>
    </div>
    <div class="shop-list-wrapper">
        <ul class="ui-row shop-list">
            <?php
                foreach($shopList as $shop){
            ?>
            <li class="ui-col ui-col-50 shop-list-item" onclick="location.href='shop-detail.php?id=<?php echo $shop['id'];?>'">
                <img src="public/upload/<?php echo $shop['pic'];?>" alt="">
                <span class="price">￥<?php echo $shop['price'];?></span>
                <div class="name">
                    <?php echo $shop['name'];?>
                </div>
            </li>
            <?php
                }
            ?>
        </ul>
    </div>
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
