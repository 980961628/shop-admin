<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/25
 * Time: 18:48
 */
//$data['result']=1;
//echo json_encode($data);exit();
//
include '../config.php';
$module = $_REQUEST['module'];
switch($module){
    case "orders":
        $time=time();
        $no=date('Y-m-d')."_".$time;
        $uid = $_POST['uid'];
        $shop_id = $_POST['shop_id'];
        $price = $_POST['price'];
        $num = $_POST['num'];
        $address_id = $_POST['address_id'];
        $price_type = $_POST['price_type'];
        $sql ="INSERT INTO orders(uid,shop_id,price_type,created_time,price,no,num,address_id) VALUES ({$uid},{$shop_id},{$price_type},{$time},'{$price}','{$no}','{$num}','{$address_id}')";
        $res = $mysqli->query($sql);
        if($res){
            $data['status']=0;
            $data['msg']='下单成功';
        }else{
            $data['status']=1;
            $data['msg']='下单失败';
        }
        echo json_encode($data);
        break;
    case "cart-orders":
        $time=time();
        $no=date('Y-m-d')."_".$time;
        $uid = $_POST['uid'];
        $params =explode(',',$_POST['params']);
        $price_type=1;
        foreach($params as $param){
            $tmp = explode('||',$param);
            $shop_id = $tmp[0];

            $num=$tmp[1];
            $sql ="INSERT INTO orders(uid,shop_id,price_type,created_time,price,no,num,address_id) VALUES ({$uid},{$shop_id},{$price_type},{$time},'{$price}','{$no}','{$num}','{$address_id}')";

            $res =$mysqli->query($sql);
            $shopData = $res->fetch_assoc();
            $shopList[]=$shopData;
        };
        echo json_encode($shop_arr);
        exit();

        $shop_id = $_POST['shop_ids'];

        $price = $_POST['price'];
        $num = $_POST['num'];
        $address_id = $_POST['address_id'];
        $price_type = $_POST['price_type'];
        $sql ="INSERT INTO orders(uid,shop_id,price_type,created_time,price,no,num,address_id) VALUES ({$uid},{$shop_id},{$price_type},{$time},'{$price}','{$no}','{$num}','{$address_id}')";
        $res = $mysqli->query($sql);
        if($res){
            $data['status']=0;
            $data['msg']='下单成功';
        }else{
            $data['status']=1;
            $data['msg']='下单失败';
        }
        echo json_encode($data);
        break;
    case "cart":
//        $no=date('Y-m-d')."_".$time;
        $shop_id = $_POST['shop_id'];
//        $num = $_POST['num'];
//        $sql ="INSERT INTO orders(uid,shop_id,price_type,created_time,price,no,num,address_id) VALUES ({$uid},{$shop_id},{$price_type},{$time},'{$price}','{$no}','{$num}','{$address_id}')";
//        $res = $mysqli->query($sql);
        $_SESSION['cart'][$shop_id]=$shop_id;
        if( $_SESSION['cart'][$shop_id]){
            $data['status']=0;
            $data['msg']='加入购物车成功';
        }else{
            $data['status']=1;
            $data['msg']='加入购物车失败';
        }
        echo json_encode($data);
        break;
    case "login":
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM user WHERE name='{$username}' AND password='{$password}'";
        $res = $mysqli->query($sql);
        $data = $res->fetch_assoc();
        if($data){
            $_SESSION['uid'] = $data['id'];
            $_SESSION['username'] = $data['name'];
            $_SESSION['tel'] = $data['tel'];
            $result['status']=0;
            $result['msg']='登录成功';
//            echo "<script>location.href='../index.php'</script>";
        }else{
            $result['status']=1;
            $result['msg']='用户名或密码错误';
        }
        echo json_encode($result);
//        echo $username;
//        echo $password;
        break;
    case "register":
        $username = $_POST['username'];
        $tel = $_POST['tel'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
//        var_dump($_POST);

        $sql = 'SELECT * FROM user WHERE tel='.$tel;
        $res = $mysqli->query($sql);
        $num = $res->num_rows;
        if($num>0){
            // 看数据库是否存在该手机号
            $result['status']='1';
            $result['msg']= '该手机号已注册';
            echo json_encode($result);
        }else{
            //手机号不存在，可注册
            $sql = "INSERT INTO user(name,tel,password,open_id) VALUES ('{$username}','{$tel}','{$password}',1111111)";
            $res = $mysqli->query($sql);
//            echo $sql;
//            exit();
            if(mysqli_affected_rows($mysqli)){
                $result['status']=0;
                $result['msg']= '注册成功';
                //获取uid保存本地，免登录
                $sql = "SELECT * FROM user WHERE tel='{$tel}'";
                $res = $mysqli->query($sql);
                $userData = $res->fetch_assoc();
//                echo $sql;
                $_SESSION['uid'] = $userData['id'];
                $_SESSION['username'] = $userData['name'];
                $_SESSION['tel'] = $userData['tel'];
            }else{
                $result['status']=1;
                $result['msg']= '注册失败';
            }
            echo json_encode($result);
        }
//        echo $num;
//        echo json_encode($_POST);
        break;
    default:
        echo 1;
//

}
//
