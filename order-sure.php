<?php
    include 'config.php';
    include 'public/function.php';
    $params =explode(',',$_GET['params']);
    $sql = "set names utf-8";
    $mysqli->query($sql);
    $shopList = [];
    $nums=[];
    $ids=[];
    foreach($params as $param){
        $tmp = explode('||',$param);
        $id = $tmp[0];
        $nums[]=$tmp[1];
        $ids[]=$tmp[0];
        $sql = "SELECT * FROM shop WHERE id=".$id;
        $res =$mysqli->query($sql);
        $shopData = $res->fetch_assoc();
        $shopList[]=$shopData;
    };

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
    <title>确认订单</title>
    <link rel="stylesheet" href="public/plugins/Swiper3/css/swiper.min.css">
    <link rel="stylesheet" href="public/css/cart.css">
    <link rel="stylesheet" href="public/plugins/frozen.1.3.0/css/frozen.css">
</head>
<body>
    <header class="ui-header ui-header-positive ui-border-b">
        <i class="ui-icon-return" onclick="history.back()"></i>
        <h1>确认订单</h1>
        <i class="ui-icon-home" onclick="location.href='index.php'"></i>
    </header>
   <div class="ui-container">
       <ul class="ui-list ui-border-tb cart-list-wrapper">
           <?php
           $totalPrice=0;
           if(count($shopList)>0){

               foreach($shopList as $key => $shop){
                   $totalPrice+= $nums[$key]*$shop['price'];
                   ?>
                   <li class="ui-border-t shop-item" data-id="<?php echo $shop['id'];?>" style="padding-left:0">
                       <div class="ui-list-img">
                           <img src="public/upload/<?php echo $shop['pic'];?>" alt="">
                       </div>
                       <div class="ui-list-info">
                           <h4 class="ui-nowrap"><?php echo $shop['name'];?></h4>
                           <p>
                               单价: <span class="price">￥<?php echo $shop['price'];?></span>&nbsp;&nbsp;&nbsp;
                               数量: <span class="num"><?php echo $nums[$key];?></span>
                           </p>
                           <p>总价: ￥<span class="num"><?php echo $nums[$key]*$shop['price'];?></span></p>
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
    <div class="checked-box ui-border-t">
        <h3 style="padding: 10px 0;">请选择地区</h3>
        <div>
            <button class="ui-btn address_type on" data-address-type="1" data-price="10.5">省内包邮 ￥10.5</button>
            <button class="ui-btn address_type" data-address-type="2" data-price="15">省外包邮 ￥15</button>
        </div>
        <h3 style="padding: 10px 0;">数量</h3>
        <div>
            <button class="ui-btn btn-reduce">-</button>
            <button class="ui-btn num">1</button>
            <button class="ui-btn btn-add">+</button>
        </div>
        <h3 style="line-height: 40px;">总价: ￥<span class="totalPrice" style="color: red;font-size: 20px;">10.5</span></h3>
        <i class="ui-icon-close-page"></i>
    </div>
    <footer>
        <ul class="ui-tiled ui-border-t">
            <li class="ui-border-r btn-add-cart"><div>总价: ￥<span class="totalPrice"><?php echo $totalPrice;?></span></div></li>
            <li class="btn-buy" style="background: #18b4ed;color:#fff;"><div>确认下单</div></li>
        </ul>
    </footer>
    <script src="public/plugins/jquery-3.2.1/jquery.min.js"></script>
<!--    <script src="public/plugins/zepto/zepto.min.js"></script>-->
<!--    <script src="public/plugins/zepto/touch.js"></script>-->
<!--    <script src="public/plugins/frozen.1.3.0/js/frozen.js"></script>-->
<!--    <script src="public/plugins/Swiper3/js/swiper.min.js"></script>-->
    <script>
        $(function(){
            var uid = "<?php echo $_SESSION['uid'];?>";

            //立即购买
            $(".btn-buy").click(function(){
                var query = "<?php echo $_GET['params'];?>";
                if( !uid){ alert("请先登录哦!");location.href='login.php' }
                if($(".checked-box").hasClass('on')){
                    $.ajax({
                        url:"api/api.php",
                        type:"post",
                        dataType:"json",
                        data:{
                            uid:uid,
                            module:'cart-orders',
                            params:query
                        },
                        success:function(res){
                            console.log(res)
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
