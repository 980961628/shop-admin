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
        <i class="ui-icon-return" onclick="history.back()"></i>
        <h1><?php echo $shop['name'];?></h1>
        <button class="ui-btn" onclick="location.href='cart.php'" style="display: none">购物车</button>
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
        <div class="price" style="font-size: 13px;">
            ￥ <strong  style="color:red;font-size:22px;"><?php echo $shop['price'];?></strong>
            <span class="sell_count" style="margin-left: 20px;">销量: <?php echo $shop['sell_count'];?></span>
        </div>
        <div class="desc"><?php echo $shop['des'];?></div>
    </div>
    <div class="cart"><i>0</i></div>
    <div class="checked-box ui-border-t">
        <h3 style="padding: 10px 0;">请选择地区</h3>
        <div>
            <button class="ui-btn address_type on" data-address-type="1" data-price="<?php echo $shop['price'];?>">省内包邮 ￥<?php echo $shop['price'];?></button>
            <button class="ui-btn address_type" data-address-type="2" data-price="<?php echo $shop['price2'];?>">省外包邮 ￥<?php echo $shop['price2'];?></button>
        </div>
        <h3 style="padding: 10px 0;">数量</h3>
        <div>
            <button class="ui-btn btn-reduce">-</button>
            <button class="ui-btn num">1</button>
            <button class="ui-btn btn-add">+</button>
        </div>
        <h3 style="line-height: 40px;">总价: ￥<span class="totalPrice" style="color: red;font-size: 20px;">0</span></h3>
        <i class="ui-icon-close-page"></i>
    </div>
    <footer>

        <ul class="ui-tiled ui-border-t">
            <li class="ui-border-r btn-add-cart" style="display: none"><div>加入购物车</div></li>
            <li class="btn-buy"><div>立即下单</div></li>
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
    <script>
        $(function(){
            var uid = '<?php echo $_SESSION['uid'];?>';
            var shop_id = '<?php echo $_GET['id'];?>';
            totalPrice();
            $('.address_type').click(function(){
                $(this).addClass('on').siblings().removeClass('on');
                totalPrice();
            });
            //
            $(".btn-buy").click(function(){
                if($(".checked-box").hasClass('on')){
//                    $(".checked-box").removeClass('on')
                    //下单方式
                    var price_type=$(".address_type.on").attr("data-address-type");
                    var num=$(".num").text();
                    if(!uid){
                        alert('请先登录哦亲!');
                        location.href='login.php';
                    }
                    var price =$(".address_type.on").attr("data-price");
                    console.log(price_type);
                    console.log(num);
                    $.ajax({
                        url:"api/api.php",
                        type:"post",
                        dataType:"json",
                        data:{
                            module:"orders",
                            uid:uid,
                            num:num,
                            shop_id:shop_id,
                            price:price,
                            price_type:price_type,
                            address_id:1
                        },
                        success:function(res){
                            console.log(res)
                            alert(res.msg)
                            if(res.status==0){
                                location.href="order-list.php";
                            }
                        },
                        error:function(err){
                            console.log(err)
                        }
                    })
                }else{
                    $(".checked-box").addClass('on');
                    $(this).text("确认")
                }
            });
            $(".ui-icon-close-page").click(function(){
                $(".checked-box").removeClass('on')
                $(".btn-buy").text("立即下单")
            });
            $(".btn-add").click(function(){
                var num=$(".num").text();
                num++;
                $(".num").text(num);
                totalPrice();
            });
            $(".btn-reduce").click(function(){
                var num=$(".num").text();
                if(num>1){
                    num--;
                    $(".num").text(num);
                    totalPrice();
                }
            });

            function totalPrice(){
                var price = $(".address_type.on").attr("data-price");
                var num = $(".num").text();
                var total = price*num;
                $(".totalPrice").text(total);
                return total;
            };

            //加入购物车
            $(".btn-add-cart").click(function(){
                if($(".checked-box").hasClass('on')){
//                    $(".checked-box").removeClass('on')
                    //下单方式
//                    var price_type=$(".address_type.on").attr("data-address-type");
//                    var num=$(".num").text();
//                    console.log(addressType)
//                    console.log(num)
                    $.ajax({
                        url:"api/api.php",
                        type:"post",
                        dataType:"json",
                        data:{
                            module:"cart",
                            uid:uid,
                            shop_id:shop_id
                        },
                        success:function(res){
                            console.log(res)
                            alert(res.msg)
                            if(res.status==0){
//                                location.href="order-list.php";
                            }
                        },
                        error:function(err){
                            console.log(err)
                        }
                    })
                }else{
                    $(".checked-box").addClass('on')
                }
            });

        })
    </script>
</body>
</html>
