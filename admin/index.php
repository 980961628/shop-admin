<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="后台管理系统">
    <meta name="author" content="zhugege">
    <title>后台管理系统</title>
    <?php include "public.php" ?>

</head>

<body>
    <!--  header start  -->
    <?php include('header.php');?>
    <!--  header end  -->
    <div class="container-fluid">
        <div class="row">
            <div  style="max-width: 180px" class="col-sm-2 col-md-2 col-lg-2 slider-left">
                <ul class="list-group">
                    <li class="list-group-item ">
                        <h4>商品管理</h4>
                        <ul>
                            <li><a href="shop/shop-list.php" target="page">商品列表</a></li>
                            <li><a href="shop/shop-add.php" target="page">添加商品</a></li>
                        </ul>
                    </li>
                    <li class="list-group-item">
                        <h4>分类管理</h4>
                        <ul>
                            <li><a href="category/category-list.php" target="page">分类列表</a></li>
                            <li><a href="category/category-add.php" target="page">添加分类</a></li>
                        </ul>
                    </li>
                    <li class="list-group-item">
                        <h4>用户管理</h4>
                        <ul>
                            <li><a href="user/user-list.php" target="page">用户列表</a></li>
                            <li><a href="user/user-add.php" target="page">添加用户</a></li>
                        </ul>
                    </li>
                    <li class="list-group-item">
                        <h4>订单管理</h4>
                        <ul>
                            <li><a href="orders/order-list.php" target="page">订单列表</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="col-sm-10 col-md-10 col-lg-10 main">
                <iframe src="welcome.php" class="container" name="page" id="page"></iframe>
            </div>
        </div>
    </div>
    <!--  footer start  -->
    <?php include('footer.php');?>
    <!--  footer end  -->

    <script>
        $(function(){

        })
    </script>
</body>
</html>
