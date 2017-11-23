<?php
    include '../../config.php';
    //获取商品分类

    $cateList = getCatefory($mysqli);
    function getCatefory($link){
        $sql = 'SELECT * FROM category ';
        $res = $link->query($sql);
        $data=[];
        while($row = $res->fetch_assoc()){
            $data[]=$row;
        }
        return $data;
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <?php include "public.php" ?>
    <script src="../../public/plugins/jquery.form.min.js"></script>
</head>
<body>
<div class="panel">
    <div class="panel-body">
        <form class="form-horizontal" role="form" id="form" action="act.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="act" value="add">
            <div class="form-group">
                <label for="name" class="col-sm-1 col-md-1 col-lg-1 control-label">商品名称</label>
                <div class="col-sm-3 col-md-3 col-lg-3">
                    <input type="text" class="form-control" id="name" name="name" placeholder="请输入商品名称">
                </div>
            </div>
            <div class="form-group">
                <label for="pic" class="col-sm-1 col-md-1 col-lg-1 control-label">商品图片</label>
                <div class="col-sm-3 col-md-3 col-lg-3">
                    <input type="file" class="form-control" id="pic" name="pic" placeholder="请选择商品图片" >
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-1 col-md-1 col-lg-1 control-label">商品分类</label>
                <div class="col-sm-3 col-md-3 col-lg-3">
                   <select name="cid">
                       <option value="0">无</option>
                       <?php
                            foreach($cateList as $cate){
                                echo "<option value='{$cate['id']}'>{$cate['name']}</option>";
                            }
                       ?>
                   </select>
                </div>
            </div>
            <div class="form-group">
                <label for="repertory" class="col-sm-1 col-md-1 col-lg-1 control-label">商品库存</label>
                <div class="col-sm-3 col-md-3 col-lg-3">
                    <input type="number" class="form-control" id="repertory" name="repertory" placeholder="请输入商品库存" value="1">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-1 col-md-1 col-lg-1 control-label">是否上架</label>
                <div class="col-sm-3 col-md-3 col-lg-3 radio">
                    <label><input type="radio" name="is_show" value="1"> 是</label>
                    <label><input type="radio" name="is_show" value="0" checked> 否</label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" class="btn btn-default" value="添加">
                </div>
            </div>
        </form>
    </div>
</div>
</body>
<script>
    $(function(){
        var options={
            beforeSubmit: function(){
                if($("#name").val()==""){
                    alert("请输入分类名称");return false;
                }
                if($("#pic").val()==""){
                    alert("请选择图片");return false;
                }
                if($("#repertory").val()==""){
                    alert("请输入库存");return false;
                }
            },  //提交前的回调函数
            success: function(res){
                console.log(res)
                alert(res.msg);
                if(res.status==0){
                    location.href="shop-list.php";
                }
            },
            dataType:"json"
        };

        $("#form").submit(function(){
            $(this).ajaxSubmit(options);
            return false;
        });
    })
</script>
</html>
