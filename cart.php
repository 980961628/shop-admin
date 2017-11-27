<?php
    include 'config.php';
    include 'public/function.php';
    $cartList = [];
    if(count($_SESSION['cart'])>0){
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
    <title>订单列表</title>
    <link rel="stylesheet" href="public/plugins/Swiper3/css/swiper.min.css">
    <link rel="stylesheet" href="public/css/cart.css">
    <link rel="stylesheet" href="public/plugins/frozen.1.3.0/css/frozen.css">
</head>
<body>
    <header class="ui-header ui-header-positive ui-border-b">
        <i class="ui-icon-return" onclick="history.back()"></i>
        <h1>订单列表</h1>
        <i class="ui-icon-home" onclick="location.href='index.php'"></i>
    </header>
   <div class="ui-container">
       <ul class="ui-list ui-border-tb cart-list-wrapper">
           <?php
           if(count($cartList)>0){
               foreach($cartList as $cart){
                   ?>
                   <li class="ui-border-t">
                       <label class="ui-switch">
                           <input type="checkbox" checked>
                       </label>
                       <div class="ui-list-img">
                           <img src="public/upload/<?php echo $cart['pic'];?>" alt="">
                       </div>
                       <div class="ui-list-info">
                           <h4 class="ui-nowrap"><?php echo $cart['name'];?></h4>
                           <p>单价:<?php echo $cart['price'];?></p>
                           <p class="btns">
                               <span class="ui-btn ui-btn-s">-</span><span class="ui-btn ui-btn-s">1</span><span class="ui-btn ui-btn-s">+</span>
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
    <script src="public/plugins/jquery-3.2.1/jquery.min.js"></script>

    <script src="public/plugins/zepto/zepto.min.js"></script>
<!--    <script src="public/plugins/zepto/touch.js"></script>-->
    <script src="public/plugins/frozen.1.3.0/js/frozen.js"></script>
<!--    <script src="public/plugins/Swiper3/js/swiper.min.js"></script>-->
    <script>
        $(function(){


        })
    </script>
</body>
</html>
