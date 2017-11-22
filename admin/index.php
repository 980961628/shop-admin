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
    <link href="./public/plugins/bootstrap-3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./public/css/index.css">
</head>

<body>
    <!--  header start  -->
    <?php include('header.php');?>
    <!--  header end  -->
    <div class="container-fluid">
        <div class="row">
            <div  style="max-width: 180px" class="col-sm-2 col-md-2 col-lg-2 slider-left">
                <ul class="list-group">
                    <a class="list-group-item active" href="shop-list.php" target="page">商品列表</a>
                    <li class="list-group-item">分类管理</li>
                    <li class="list-group-item">属性管理</li>
                    <li class="list-group-item">聚合商品</li>
                </ul>
            </div>
            <div class="col-sm-10 col-md-10 col-lg-10 ">
                <iframe src="welcome.php" class="container" name="page"></iframe>
            </div>
        </div>
    </div>
    <!--  footer start  -->
    <?php include('footer.php');?>
    <!--  footer end  -->
<script src="./public/plugins/jquery-3.2.1/jquery.min.js"></script>
<script src="./public/plugins/bootstrap-3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
