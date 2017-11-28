<?php
    include 'config.php';
    include 'public/function.php';
    $cartList = [];
    if(isset($_SESSION['cart']) && count($_SESSION['cart'])>0){
        foreach($_SESSION['cart'] as $shop){
            $sql = "SELECT * FROM shop WHERE id=".$shop;
            $res = $mysqli->query($sql);
            $data = $res->fetch_assoc();
            array_push($cartList,$data);
        }
    }

//var_dump($cartList);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
    <title>购物车</title>
    <link rel="stylesheet" href="public/plugins/Swiper3/css/swiper.min.css">
    <link rel="stylesheet" href="public/css/cart.css">
    <link rel="stylesheet" href="public/plugins/frozen.1.3.0/css/frozen.css">
</head>
<body>
    <header class="ui-header ui-header-positive ui-border-b">
        <i class="ui-icon-return" onclick="history.back()"></i>
        <h1>购物车</h1>
        <i class="ui-icon-home" onclick="location.href='index.php'"></i>
    </header>
   <div class="ui-container">
       <ul class="ui-list ui-border-tb cart-list-wrapper">
           <?php
           if(count($cartList)>0){
               foreach($cartList as $cart){
                   ?>
                   <li class="ui-border-t shop-item" data-id="<?php echo $cart['id'];?>">
                       <label class="ui-switch">
                           <input type="checkbox" checked class="checkbox" data-id="<?php echo $cart['id'];?>">
                       </label>
                       <div class="ui-list-img">
                           <img src="public/upload/<?php echo $cart['pic'];?>" alt="">
                       </div>
                       <div class="ui-list-info">
                           <h4 class="ui-nowrap"><?php echo $cart['name'];?></h4>
                           <p>单价: <span class="price"><?php echo $cart['price'];?></span></p>
                           <p class="btns">
                               <span class="ui-btn ui-btn-s btn-reduce">-</span><span class="ui-btn ui-btn-s shop-num">1</span><span class="ui-btn ui-btn-s btn-add">+</span>
                           </p>
                       </div>
                   </li>
                   <?php
               }
           }else{
               echo '<li ><div class="ui-flex ui-flex-pack-center" style="padding:10px;"><div><a href="index.php">空空如也,去逛逛</a></div></span>';
           }
           ?>
       </ul>
   </div>
    <footer>
        <ul class="ui-tiled ui-border-t">
            <li class="ui-border-r btn-add-cart"><div>总价: ￥<span class="totalPrice">0</span></div></li>
            <li class="btn-buy" style="background: #18b4ed;color:#fff;"><div>立即下单</div></li>
        </ul>
    </footer>
    <script src="public/plugins/jquery-3.2.1/jquery.min.js"></script>
    <script src="public/plugins/zepto/zepto.min.js"></script>
<!--    <script src="public/plugins/zepto/touch.js"></script>-->
    <script src="public/plugins/frozen.1.3.0/js/frozen.js"></script>
<!--    <script src="public/plugins/Swiper3/js/swiper.min.js"></script>-->
    <script>
        $(function(){
            // +
            $(".btn-add").click(function(){
                var shopNum = $(this).siblings('.shop-num');
                var num = shopNum.text();
                num++;
                shopNum.text(num);
                totalPrice();
            });
            //-
            $(".btn-reduce").click(function(){
                var shopNum = $(this).siblings('.shop-num');
                var num = shopNum.text();
                if(num>=2){
                    num--;
                }
                shopNum.text(num);
                totalPrice();
            });
            //立即购买
            $(".btn-buy").click(function(){
                var checkedGoods = $(".checkbox:checked").length;
                if(checkedGoods.length==0){
                    alert("您好没有选择商品哦!");
                }else{
                    var query="";
                    $(".checkbox:checked").each(function(){
                        var shopItem = $(this).parents('.shop-item');
                        var id = $(this).attr("data-id");
                        var num = shopItem.find('.shop-num').text();
                        query+=id+"||"+num+","
                    });
                    var u = query.substring(0,query.length-1)
                    console.log(u);
                    location.href="order-sure.php?params="+u;
                }
            });
            $(".ui-switch").click(function(){
                totalPrice();
            });
            totalPrice();
            function totalPrice(){
//                var checkedGoods = $(".checkbox:checked").length;
//                console.log(checkedGoods);
                var total = 0;
                $(".checkbox:checked").each(function(){
                    var shopItem = $(this).parents('.shop-item');
                    var price = shopItem.find('.price').text();
                    var num = shopItem.find('.shop-num').text();
                    total += price*num;
                });
                $(".totalPrice").text(total);
                console.log(total);
            }
        })
    </script>
</body>
</html>
