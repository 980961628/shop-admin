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
    $id = $_GET['id'];
    $sql = "SELECT * FROM shop WHERE id={$id}";
    $res = $mysqli->query($sql);
    $shopData=$res->fetch_assoc();
//    var_dump($shopData);
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
            <input type="hidden" name="act" value="edit">
            <div class="form-group">
                <label for="name" class="col-sm-1 col-md-1 col-lg-1 control-label">商品名称</label>
                <div class="col-sm-3 col-md-3 col-lg-3">
                    <input type="text" class="form-control" id="name" name="name" placeholder="请输入商品名称" value="<?php echo $shopData['name'];?>">
                </div>
            </div>
            <div class="form-group">
                <label for="pic" class="col-sm-1 col-md-1 col-lg-1 control-label">商品图片</label>
                <div class="col-sm-3 col-md-3 col-lg-3">
                    <img src="../../public/upload/<?php echo $shopData['pic'];?>" alt="" width="100">
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
                                if($cate['id'] == $shopData['cid']){
                                    echo "<option value='{$cate['id']}' selected>{$cate['name']}</option>";
                                }else{
                                    echo "<option value='{$cate['id']}'>{$cate['name']}</option>";
                                }
                            }
                       ?>
                   </select>
                </div>
            </div>
            <div class="form-group">
                <label for="repertory" class="col-sm-1 col-md-1 col-lg-1 control-label">商品库存</label>
                <div class="col-sm-3 col-md-3 col-lg-3">
                    <input type="number" class="form-control" id="repertory" name="repertory" placeholder="请输入商品库存"  value="<?php echo $shopData['repertory'];?>">
                </div>
            </div>
            <div class="form-group">
                <label for="repertory" class="col-sm-1 col-md-1 col-lg-1 control-label">商品描述</label>
                <div class="col-sm-3 col-md-3 col-lg-3">
                    <textarea class="form-control" placeholder="请输入商品描述" name="desc"><?php echo $shopData['des'];?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-1 col-md-1 col-lg-1 control-label">是否上架</label>
                <div class="col-sm-3 col-md-3 col-lg-3 radio">
                    <label><input type="radio" name="is_show" value="1" <?php if( $shopData['des']==1){echo 'checked';} ?>> 是</label>
                    <label><input type="radio" name="is_show" value="0" <?php if( $shopData['des']==0){echo 'checked';} ?>> 否</label>
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
            error:function(res){
                console.log(res)
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
