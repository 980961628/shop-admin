<?php
    include '../../config.php';
    $act = $_REQUEST['act'];
    switch($act){
        case "add":
            //添加
            //上传图片
            // 允许上传的图片后缀
            $allowedExts = array("gif", "jpeg", "jpg", "png");
            $temp = explode(".", $_FILES["pic"]["name"]);
            $extension = end($temp);     // 获取文件后缀名
            if ((($_FILES["pic"]["type"] == "image/gif")
                    || ($_FILES["pic"]["type"] == "image/jpeg")
                    || ($_FILES["pic"]["type"] == "image/jpg")
                    || ($_FILES["pic"]["type"] == "image/pjpeg")
                    || ($_FILES["pic"]["type"] == "image/x-png")
                    || ($_FILES["pic"]["type"] == "image/png"))
                && ($_FILES["pic"]["size"] < 204800)   // 小于 200 kb
                && in_array($extension, $allowedExts))
            {
                if ($_FILES["pic"]["error"] > 0)
                {
                    echo "错误：: " . $_FILES["pic"]["error"] . "<br>";
                }
                else
                {
                    // 判断当期目录下的 upload 目录是否存在该文件
                    // 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
                    if (file_exists("upload/" . $_FILES["pic"]["name"]))
                    {
                        echo $_FILES["pic"]["name"] . " 文件已经存在。 ";
                    }
                    else
                    {
                        // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
                        move_uploaded_file($_FILES["pic"]["tmp_name"], "upload/" . $_FILES["pic"]["name"]);
                        echo "文件存储在: " . "upload/" . $_FILES["pic"]["name"];
                    }
                }
            }
            else
            {
                echo "非法的文件格式";
            }
//                $name = $_POST['name'];
//                $cid = $_POST['cid'];
//                $repertory = $_POST['repertory'];
//                $create_time = time();
//                $sql = "INSERT INTO category(name,create_time) VALUES ('{$name}','{$create_time}')";
//                $res = $mysqli->query($sql);
//                if($res){
//                    $result['msg'] = '插入成功';
//                    $result['status'] = 0;
//                }else{
//                    $result['msg'] = '插入失败';
//                    $result['status'] = 10000;
//                }
//                echo json_encode( $result );exit();
            break;
        case "del":
            $id = $_POST['id'];
            $sql = "DELETE FROM category WHERE id ={$id}";
            $mysqli->query($sql);
            if(mysqli_affected_rows($mysqli)){
                $result['msg'] = '删除成功';
                $result['status'] = 0;
            }else{
                $result['msg'] = '删除失败';
                $result['status'] = 10000;
            }
            echo json_encode( $result );exit();
            break;
        default :
            echo 0;
            break;
    }

/**
 * [file_upload 文件上传函数，支持单文件，多文件]
 * Author: 程威明
 * @param  string $name         input表单中的name
 * @param  string $save_dir         文件保存路径，相对于当前目录
 * @param  array  $allow_suffix 允许上传的文件后缀
 * @return array                array() {
 *                                         ["status"]=> 全部上传成功为true，全部上传失败为false，部分成功为成功数量
 *                                         ["path"]=>array() {已成功的文件路径}
 *                                         ["error"]=>array() {失败信息}
 *                                      }
 */
function files_upload($name="photo",$save_dir="images",$allow_suffix=array('jpg','jpeg','gif','png'))
{
    //如果是单文件上传，改变数组结构
    if(!is_array($_FILES[$name]['name'])){
        $list = array();
        foreach($_FILES[$name] as $k=>$v){
            $list[$k] = array($v);
        }
        $_FILES[$name] = $list;
    }

    $response = array();
    $response['status'] = array();
    $response['path'] = array();
    $response['error'] = array();

    //拼接保存目录
    $save_dir = './'.trim(trim($save_dir,'.'),'/').'/';

    //判断保存目录是否存在
    if(!file_exists($save_dir))
    {
        //不存在则创建
        if(false==mkdir($save_dir,0777,true))
        {
            $response['status'] = false;
            $response['error'][] = '文件保存路径错误,路径 "'.$save_dir.'" 创建失败';
        }
    }

    $num = count($_FILES[$name]['tmp_name']);

    $success = 0;

    //循环处理上传
    for($i=0;$i <$num;$i++)
    {
        //判断是不是post上传
        if(!is_uploaded_file($_FILES[$name]['tmp_name'][$i]))
        {
            $response['error'][] = '非法上传，文件 "'.$_FILES[$name]['name'][$i].'" 不是post获得的';
            continue;
        }

        //判断错误
        if($_FILES[$name]['error'][$i]>0)
        {
            $response['error'][] = '文件 "'.$_FILES[$name]['name'][$i].'" 上传错误,error下标为 "'.$_FILES[$name]['error'][$i].'"';
            continue;
        }

        //获取文件后缀
        $suffix = ltrim(strrchr($_FILES[$name]['name'][$i],'.'),'.');

        //判断后缀是否是允许上传的格式
        if(!in_array($suffix,$allow_suffix))
        {
            $response['error'][] = '文件 "'.$_FILES[$name]['name'][$i].'" 为不允许上传的文件类型';
            continue;
        }

        //得到上传后文件名
        $new_file_name =date('ymdHis',time()).'_'.uniqid().'.'.$suffix;

        //拼接完整路径
        $new_path = $save_dir.$new_file_name;

        //上传文件 把tmp文件移动到保存目录中
        if(!move_uploaded_file($_FILES[$name]['tmp_name'][$i],$new_path))
        {
            $response['error'][] = '文件 "'.$_FILES[$name]['name'][$i].'" 从临时文件夹移动到保存目录时发送错误';
            continue;
        }

        //返回由图片文件路径组成的数组
        $response['path'][] =$save_dir.$new_file_name;

        $success++;
    }

    if(0==$success){
        $success = false;
    }elseif($success==$num){
        $success = true;
    }

    $response['status'] = $success;

    return $response;
}

?>