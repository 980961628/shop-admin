<?php
    include '../../config.php';
    $act = $_REQUEST['act'];
    switch($act){
        case "add":
            //添加
            //上传图片
            include '../../public/function.php';
            //图片上传
            $res = files_upload('pic','../../../public/upload');
            if(count($res['error'])!=0){
                $result['msg'] = '图片上传失败';
                $result['status'] = 10001;
                echo json_encode($result);
                exit();
            }
            $pic = implode($res['name']);
//            echo json_encode($pic);exit();

            $name = $_POST['name'];
            $cid = $_POST['cid'];
            $is_show = $_POST['is_show'];
            $repertory = $_POST['repertory'];
            $create_time = time();

            $sql = "INSERT INTO shop(name,cid,is_show,repertory,create_time,pic) VALUES ('{$name}','{$cid}','{$is_show}','{$repertory}','{$create_time}','{$pic}')";
//            echo json_encode($sql);exit();
            $res = $mysqli->query($sql);
            if($res){
                $result['msg'] = '插入成功';
                $result['status'] = 0;
            }else{
                $result['msg'] = '插入失败';
                $result['status'] = 10000;
            }
            echo json_encode( $result );exit();
            break;
        case "del":
            $id = $_POST['id'];
            $sql = "DELETE FROM shop WHERE id ={$id}";
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
            echo "参数错误";
            break;
    }


?>