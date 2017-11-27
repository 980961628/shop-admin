<?php
include '../../config.php';
$sql = 'SELECT * FROM user ';
$res = $mysqli->query($sql);
$total = $res->num_rows; //总条数
$pageSize = 3;  //每页显示多少
$page = empty($_GET['p']) ? 1 : $_GET['p']; //当前页
$totalPage = ceil($total/$pageSize);    //总页数
$offset = $pageSize*($page-1);
$sql = "SELECT * FROM user ORDER BY id DESC limit {$offset},{$pageSize}";
$res = $mysqli->query($sql);

$data=[];

while($row = $res->fetch_assoc()){
    $data[]=$row;
//    echo $row['name'];
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <?php include "public.php" ?>
    <style>
        th{
            text-align: center;
        }
        td{
            vertical-align: middle!important;
        }
    </style>
</head>
<body>
<div class="panel">
    <div class="panel-body">
        <table class="table  table-bordered table-striped table-condensed text-center">
            <tr>
                <th width="100">id</th>
                <th >用户名</th>
                <th >联系电话</th>
                <th >openid</th>
                <th >操作</th>
            </tr>
            <?php
            if(count($data)<1){
                ?>
                <tr>
                    <td colspan="9">暂无数据 <a class="btn btn-sm" href="shop-add.php">添加商品</a></td>
                </tr>
                <?php
            }else{
                foreach($data as $item){
                    ?>
                    <tr>
                        <td><?php echo $item['id'];?></td>
                        <td><?php echo $item['name'];?></td>
                        <td><?php echo $item['tel'];?></td>
                        <td><?php echo $item['open_id'];?></td>
                        <td>
<!--                            <a href="user-edit.php?id=--><?php //echo $item['id'];?><!--" class="btn btn-sm btn-default btn-edit" data-id="--><?php //echo $item['id'];?><!--">编辑</a>-->
                            <button class="btn btn-sm btn-warning btn-del" data-id="<?php echo $item['id'];?>">删除</button>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
            <tr>
                <td colspan="9" >
                    <?php
                    $pageBar="";
                    echo $page.'/'.$totalPage;
                    if(count($data)>1){
                        $pageBar.= '页数'.$page.'/'.$totalPage.' ';
                    }
                    $prev = $page-1;
                    $next = $page+1;
                    if($totalPage>=$page){
                        if($page == 1){
                            $pageBar.="<a href='shop-list.php?p={$next}'>下一页</a> ";
                            $pageBar.="<a href='shop-list.php?p={$totalPage}'>尾页</a> ";
                        }else if($page == $totalPage){
                            $pageBar.="<a href='shop-list.php?p=1'>首页</a> ";
                            $pageBar.="<a href='shop-list.php?p={$prev}'>上一页</a> ";
                        }else{
                            $pageBar.="<a href='shop-list.php?p=1'>首页</a> ";
                            $pageBar.="<a href='shop-list.php?p={$prev}'>上一页</a> <a href='shop-list.php?p={$next}'>下一页</a> ";
                            $pageBar.="<a href='shop-list.php?p={$totalPage}'>尾页</a>";
                        }
                    }

                    echo $pageBar;
                    ?>
                </td>
            </tr>
        </table>
    </div>
</div>
</body>
<script>
    $(function(){
        setRem();
        $(window).resize(function(){
            setRem();
        });

        function setRem(){
            var rem = $(window).width/20;
            $("html").css("fontSize",rem+'px')
        }

        //删除
        $(".btn-del").click(function(){
            var id = $(this).attr("data-id");
            if(confirm('确认删除')){
                $.when(
                    $.ajax({
                        url:"act.php",
                        data:{
                            act:"del",
                            id:id
                        },
                        type:"post",
                        dataType:"json"
                    })
                ).then(function(res){
                    alert(res.msg);
                    if(!res.status){
                        location.href="shop-list.php";
                    }
                })
            }
        })
    })
</script>
</html>
