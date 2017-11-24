<?php
    include '../../config.php';
    $id=$_GET['id'];
    $sql = "SELECT * from category WHERE id={$id}";
    $res = $mysqli->query($sql);
    $data = $res->fetch_assoc();
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
            <form class="form-horizontal" role="form" id="form" action="act.php" method="post">
                <input type="hidden" name="id" value="<?php echo $data['id'];?>">
                <input type="hidden" name="act" value="edit">
                <div class="form-group">
                    <label for="name" class="col-sm-1 col-md-1 col-lg-1 control-label">分类名称</label>
                    <div class="col-sm-3 col-md-3 col-lg-3">
                        <input type="text" class="form-control" id="name" name="name" placeholder="请输入名字" value="<?php echo $data['name'];?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">确认</button>
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
            },  //提交前的回调函数
            success: function(res){
                console.log(res)
                if(!res.status){
                    alert("添加成功");
                    location.href="category-list.php";
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
