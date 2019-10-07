<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController {
	
	public function index(){
        $Data = M('goods');
       
        $result= $Data->select();

        if(!empty($result)){
            foreach($result as &$v){
                $v['imgs'] = json_decode($v['imgs']);
            }
        }
        $this->assign('result',$result);
        $this->display();
        
	}
    
    function car(){
        $this->display();
    }

    function admin(){
        $this->display();
    }


    function addGoods(){
        $g_name = I("g_name");
        $g_price = I("g_price");
        $g_text = I("g_text");
        $path="./picture";
        $allowExt = array('png','jpg','jpeg','gif');
        $maxSize=1048576;
        $imgFlag=true;
         //创建文件夹 设立权限
        if (! file_exists($path)) {
            mkdir($path,0777,true);
        }

        $i = i;
        foreach ($_FILES as $v){//三维数组转换成2维数组
            if(is_string($v['name'])){ //单文件上传
                $info[$i] = $v;
                $i++;
            }else{ // 多文件上传

                foreach ($v['name'] as $key=>$val){//2维数组转换成1维数组
                    //取出一维数组的值，然后形成另一个数组
                    //新的数组的结构为：info=>i=>('name','size'.....)
                    $info[$i]['name'] = $v['name'][$key];
                    $info[$i]['size'] = $v['size'][$key];
                    $info[$i]['type'] = $v['type'][$key];
                    $info[$i]['tmp_name'] = $v['tmp_name'][$key];
                    $info[$i]['error'] = $v['error'][$key];
                    $i++;
                }
            }
        }
        
        $infoArr =   $info;
        
        $imggesurlStr=array();

        foreach ($infoArr as $val){
            if($val['error'] === UPLOAD_ERR_OK){
                $tmp_name= $val["tmp_name"];
                $a= explode(".",$val["name"]);
                $name = date('YmdHis').mt_rand(100,999).".".$a[1];
                $destination = $path."/".$name;
                move_uploaded_file($tmp_name, $destination);
                $imggesurlStr[] = $name;
            }else{
            }

        }

        $imggesurlStr = json_encode($imggesurlStr);
        
        if(!empty($g_name) && !empty($g_text) && !empty($g_price) && !empty($imggesurlStr)){    
              //add
              $data['name'] = $g_name;
              $data['Introduction'] = $g_text;
              $data['price'] = $g_price;
              $data['imgs'] = $imggesurlStr;
              $m_goods = M('goods');
              if(!$m_goods -> add($data)){
                    $this->error('添加失败');
                    exit();
              }
              $this->success('添加成功');
        }else{
            $this->success('商品信息不能为空!');
        }
        exit();
    }


    function Allcar(){

        $redis = new \Redis();
        $redis->connect('127.0.0.1',6379);
        $hasredis = $redis->get('car');

        if(!empty($hasredis)){

            // echo $hasredis; 
            // 遍历xx

            $hasredis = json_decode($hasredis,true);

            $number = 0;
            $price=0;
            
            $goodsinfos  = array();
            foreach($hasredis as $k=>$v){

                $goods = M("goods"); 
                $condition['id'] = $k;
                $result = $goods->where($condition)->find(); 
                if($result){

                    $number += intval($v);
                $imgs = $result[imgs];
                $imgs = json_decode($imgs);
                $goodsinfos[info][] = array(
                        "num" => intval($v),
                        "id" => $result[id],
                        "price" => $result[price],
                        "imgs" => $imgs,
                        "name" => $result[name],
                        "total" => $v*$result[price]
                );
                $price += $v*$result[price];

                }
                
            }
            $goodsinfos += array(
                "alltotal" => $price,
                "allnumber" => $number
            );

            print_r(json_encode($goodsinfos));
            
        }else{
            $arr = array(); 
            $arr = json_encode($arr);
            $hasredis = $redis->set('car',$arr);
        }
    }

    function addCar(){
        $id = I("id");
        $num = I("num");
        $redis = new \Redis();
        $redis->connect('127.0.0.1',6379);
        $car = $redis->get('car');
        if($car){
            $car = json_decode($car,true);
            if($car[$id]){
                $carnum = $car[$id];
                $num = $carnum + $num; 
            }
        }else{
            $car = array();
        }

        $car[$id] = $num;
        $car = json_encode($car);
        $redis->set("car", $car);
        echo '添加成功' ;

    }

    function goods(){
        $id =  I('id'); 
        $goods = M("goods"); 
        $condition['id'] = $id;
        $result = $goods->where($condition)->find(); 
        $imgs = $result[imgs];
        $imgs = json_decode($imgs);

        $this->assign('result',$result);
        $this->assign('imgs',$imgs);
        $this->display();

    }

    function getOrder(){
        $Data = M('order');
        $result= $Data->select();
        
        print_r(json_encode($result));
    }

    function order(){
        $this->display();
    }



    //添加商品数量
    function addnumber(){
        $id = I("id");
        $redis = new \Redis();
        $redis->connect('127.0.0.1',6379);
        $car = $redis->get('car');
        if($car){
            $car = json_decode($car,true);
            if($car[$id]){
                $carnum = $car[$id];
                $num = $carnum + 1; 
            }
        }else{
           echo '未获取到rides数据';
        }
        $car[$id] = $num;
        $car = json_encode($car);
        $redis->set("car", $car);
        echo '添加成功' ;
    }

    //减商品数量
    function delnumber(){
        $id = I("id");
        $redis = new \Redis();
        $redis->connect('127.0.0.1',6379);
        $car = $redis->get('car');
        if($car){
            $car = json_decode($car,true);
            if($car[$id]){
                $carnum = $car[$id];
                $num = $carnum - 1; 
            }
        }else{
           echo '未获取到数据';
        }
        $car[$id] = $num;
        $car = json_encode($car);
        $redis->set("car", $car);
        echo '减去成功';
    }

    //删除商品
    function delgroods(){
        $id = I("id");
        $redis = new \Redis();
        $redis->connect('127.0.0.1',6379);
        $car = $redis->get('car');

        if($car){
            $car = json_decode($car,true);
            unset($car[$id]);
        }else{
           echo '未获取到rides数据';
        }
        $car = json_encode($car);
        $redis->set("car", $car);
        echo '删除成功';

    }

    function addOrder(){
        $total=0; //记录总金额
        $address = I("address");
        $goodInfo = '';
        $time = date('Y-m-d H:i:s', time());

        $redis = new \Redis();
        $redis->connect('127.0.0.1',6379);
        $car = $redis->get('car');
        $car = json_decode($car);
        $goodsinfos = array();
        if($car){
            foreach($car as $k=>$v){ 
                $goods = M("goods"); 
                $condition['id'] = $k;
                $result = $goods->where($condition)->find(); 
                if($result){
                    $total += $v*$result[price];
                    $goodInfo .= $result[name]. "X".intval($v). "," ;
                }
            }
             $total;
             $goodInfo;

            $User = M("order"); // 实例化User对象
            $data['total'] = $total;
            $data['details'] = $goodInfo;
            $data['address'] = $address;
            $data['datatime'] = $time;
            $result= $User->add($data);
            if($result){
                echo 'success';

                $redis = new \Redis();
                $redis->connect('127.0.0.1',6379);                
                $arr = array(); 
                $arr = json_encode($arr);
                $hasredis = $redis->set('car',$arr);


            }else{
                echo '输入失败';
            }
        }else{
            echo "购物车为空";
        }
    }


    public function excel(){
		//获取你要导出的数据，你要获取的到数据库的数据
		$data = M("order")->select();
		//设置要导出excel的表头 
		$fileheader= array('订单编号', '时间', '收货信息', '购买清单', '总金额'); 
		$this->exportExcel($data,'测试',$fileheader,'Sheet1');
	}
	
    public function exportExcel($data, $savefile, $fileheader, $sheetname){
		//引入phpexcel核心文件，不是tp，你也可以用include（‘文件路径’）来引入
		import("Org.Util.PHPExcel");
		import("Org.Util.PHPExcel.Reader.Excel2007");
        
        if(empty($data)){
            exit("数据为空，导出错误");
        }
        /*设置文件信息*/
        import("Org.Util.PHPExcel");
        import("Org.Util.PHPExcel.Reader.Excel2007");   
        $savefile=str_replace('.xls', '', $savefile).'.xls';
        $phpexcel = new \PHPExcel();
        $phpexcel->getProperties()
            ->setCreator("Maarten Balliauw")
            ->setLastModifiedBy("Maarten Balliauw")
            ->setTitle("Office 2007 XLSX Test Document")
            ->setSubject("Office 2007 XLSX Test Document")
            ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Test result file");
        $phpexcel->getActiveSheet()->fromArray($data);
        $phpexcel->getActiveSheet()->setTitle($sheetname);
        $phpexcel->getActiveSheet()->getStyle("A1:Z1")->getFont()->setName("微软雅黑")->setSize(10)->setBold(true);//设置单元格范围的字体、字体大小、加粗
        $phpexcel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=$savefile");
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0
        $objwriter = \PHPExcel_IOFactory::createWriter($phpexcel, 'Excel5');
        $objwriter->save('php://output');
        exit;

	}


}
