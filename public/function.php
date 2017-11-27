<?php

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
        $response['name'][] =$new_file_name;
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

//图像等比例缩放函数
/**
 *等比例缩放函数（以保存新图片的方式实现）
 *@param string $picname  被缩放的处理图片源
 *@param int $maxx 缩放后图片的最大宽度
 *@param int $maxy 缩放后图片的最大高度
 *@param string $pre 缩放后图片的前缀名
 *@return $string 返回后的图片名称（） 如a.jpg->s.jpg
 *
 **/
     function imageUpdatesize($picname,$maxx=100,$maxy=100,$pre="s_"){
         $info=getimageSize($picname);//获取图片的基本信息
         $w=$info[0];//获取宽度
         $h=$info[1];//获取高度
         //获取图片的类型并为此创建对应图片资源
         switch($info[2]){
             case 1://gif
                 $im=imagecreatefromgif($picname);
                 break;
             case 2://jpg
                 $im=imagecreatefromjpeg($picname);
                 break;
             case 3://png
                 $im=imagecreatefrompng($picname);
                 break;
             default:
                 die("图像类型错误");
         }
         //计算缩放比例
         if(($maxx/$w)>($maxy/$h)){
             $b=$maxy/$h;
         }else{
             $b=$maxx/$w;
         }
         //计算出缩放后的尺寸
         $nw=floor($w*$b);
         $nh=floor($h*$b);
         //创建一个新的图像源（目标图像）
         $nim=imagecreatetruecolor($nw,$nh);
         //执行等比缩放
         imagecopyresampled($nim,$im,0,0,0,0,$nw,$nh,$w,$h);
         //输出图像（根据源图像的类型，输出为对应的类型）
         $picinfo=pathinfo($picname);//解析源图像的名字和路径信息
         $newpicname=$picinfo["dirname"]."/".$pre.$picinfo["basename"];
         switch($info[2]){
             case 1:
                 imagegif($nim,$newpicname);
                 break;
             case 2:
                 imagejpeg($nim,$newpicname);
                 break;
             case 3:
                 imagepng($nim,$newpicname);
                 break;
         }
         //释放图片资源
         imagedestroy($im);
         imagedestroy($nim);
         //返回结果
         return $newpicname;
     }
    // 测试成功
//     echo    imageUpdatesize("images/qie.jpg",150,150,ss_); // 返回的结果为 images/ss_qie.jpg
    function checkLogin(){
        if(empty($_SESSION['uid'])){
            echo "<script>location.href='login.php'</script>";
        }
    }
    checkLogin();

?>