<?php
    include 'config.php';
    include 'public/function.php';
    $params =explode(',',$_GET['params']);
    $sql = "set names utf-8";
    $mysqli->query($sql);
    $shopList = [];
    foreach($params as $param){
        $tmp = explode('||',$param);
        $id = $tmp[0];
        $sql = "SELECT * FROM shop WHERE id=".$id;
        $res =$mysqli->query($sql);
        $shopData = $res->fetch_assoc();
        $shopList[]=$shopData;
    };

    var_dump($shopList);

    $sql = "SELECT orders.*,shop.name,shop.pic  FROM orders,shop WHERE orders.shop_id=shop.id AND uid=".$_SESSION['uid']." ORDER BY id DESC";
    $res = $mysqli->query($sql);
    $orderList = [];
    $orderList_ok=[];
    $orderList_no=[];
    while($row = $res->fetch_assoc()){
        $orderList[]=$row;
        if($row['status']==0){
            $orderList_ok[]=$row;
        }else{
            $orderList_no[]=$row;
        }
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
    <title>确认订单</title>
    <link rel="stylesheet" href="public/plugins/Swiper3/css/swiper.min.css">
    <link rel="stylesheet" href="public/css/order-list.css">
    <link rel="stylesheet" href="public/plugins/frozen.1.3.0/css/frozen.css">
</head>
<body>
    <header class="ui-header ui-header-positive ui-border-b">
        <i class="ui-icon-return" onclick="history.back()"></i>
        <h1>确认订单</h1>
        <i class="ui-icon-home" onclick="location.href='index.php'"></i>
    </header>
   <div class="ui-container">
       <div class="ui-tab">
           <ul class="ui-tab-nav ui-border-b">
               <li class="current">全部</li>
               <li>交易中</li>
               <li>已完成</li>
           </ul>
           <ul class="ui-tab-content order-list-wrapper" style="width:300%">
               <!--全部订单-->
               <li class="current">
                   <ul class="ui-list ui-border-tb">
                       <?php
                            if(count($orderList)>0){
                                foreach($orderList as $order){
                       ?>
                            <li class="ui-border-t">
                                <div class="ui-list-img">
                                    <img src="public/upload/<?php echo $order['pic'];?>" alt="">
                                </div>
                                <div class="ui-list-info">
                                    <h4 class="ui-nowrap"><?php echo $order['name'];?></h4>
                                    <p>数量:<?php echo $order['num'];?> 单价:<?php echo $order['price'];?> 总价:<?php echo $order['price']*$order['num'];?></p>
                                    <p class="btns">
                                        <?php
                                            if($order['status']==0){
                                        ?>
                                            <span class="ui-btn ui-btn-s">评价</span>
                                        <?php
                                            }else{
                                        ?>
                                            <span class="ui-btn ui-btn-s">收货</span>
                                        <?php
                                            }
                                        ?>

                                    </p>
                                </div>
                            </li>
                       <?php
                                }
                            }else{
                                echo '<li ><div class="ui-flex ui-flex-pack-center" style="padding: 10px;"><div>没有更多数据</div></span>';
                            }
                       ?>
                   </ul>
               </li>
               <!--交易中-->
               <li>
                   <ul class="ui-list ui-border-tb">
                       <?php
                       if(count($orderList_no)>0){
                           foreach($orderList_no as $order){
                               ?>
                               <li class="ui-border-t">
                                   <div class="ui-list-img">
                                       <img src="public/upload/<?php echo $order['pic'];?>" alt="">
                                   </div>
                                   <div class="ui-list-info">
                                       <h4 class="ui-nowrap"><?php echo $order['name'];?></h4>
                                       <p>数量:<?php echo $order['num'];?> 单价:<?php echo $order['price'];?> 总价:<?php echo $order['price']*$order['num'];?></p>
                                       <p class="btns"><span class="ui-btn ui-btn-s">收货</span></p>
                                   </div>
                               </li>
                               <?php
                           }
                       }else{
                           echo '<li ><div class="ui-flex ui-flex-pack-center" style="padding: 10px;"><div>没有更多数据</div></span>';
                       }
                       ?>
                   </ul>
               </li>
                <!--已完成-->
               <li>
                   <ul class="ui-list ui-border-tb">
                       <?php
                       if(count($orderList_ok)>0){
                           foreach($orderList_ok as $order){
                               ?>
                               <li class="ui-border-t">
                                   <div class="ui-list-img">
                                       <img src="public/upload/<?php echo $order['pic'];?>" alt="">
                                   </div>
                                   <div class="ui-list-info">
                                       <h4 class="ui-nowrap"><?php echo $order['name'];?></h4>
                                       <p>数量:<?php echo $order['num'];?> 单价:<?php echo $order['price'];?> 总价:<?php echo $order['price']*$order['num'];?></p>
                                       <p class="btns"><span class="ui-btn ui-btn-s">评价</span></p>
                                   </div>
                               </li>
                               <?php
                           }
                       }else{
                           echo '<li ><div class="ui-flex ui-flex-pack-center" style="padding: 10px;"><div>没有更多数据</div></span>';
                       }
                       ?>
                   </ul>
               </li>
           </ul>
       </div>
   </div>
    <script src="public/plugins/jquery-3.2.1/jquery.min.js"></script>

    <script src="public/plugins/zepto/zepto.min.js"></script>
    <script src="public/plugins/frozen.1.3.0/js/frozen.js"></script>
<!--    <script src="public/plugins/Swiper3/js/swiper.min.js"></script>-->
    <script>
        $(function(){
            var tab = new fz.Scroll('.ui-tab', {
                role: 'tab'
            });

            /* 滑动开始前 */
            tab.on('beforeScrollStart', function(from, to) {
                // from 为当前页，to 为下一页
            })

            /* 滑动结束 */
            tab.on('scrollEnd', function(curPage) {
                // curPage 当前页
            });

        })
    </script>
</body>
</html>
