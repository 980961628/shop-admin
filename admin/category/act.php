<?php
    include '../../config.php';
    $act = $_REQUEST['act'];
    switch($act){
        case "add":
            //添加
                $name = $_POST['name'];
                $create_time = time();
                $sql = "INSERT INTO category(name,create_time) VALUES ('{$name}','{$create_time}')";
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


?>