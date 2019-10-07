<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {
	
	
	public function common(){
		header("content-type:text/html;charset=utf-8");
	
	}
	
	
	function mkdirs($dir, $mode = 0777){
		if (is_dir($dir) || @mkdir($dir, $mode)) return TRUE;
		if (!$this->mkdirs(dirname($dir), $mode)) return FALSE;
		return @mkdir($dir, $mode);
	} 

	
	public function logs($id,$log,$log_flag){
		$this->common();
		$memberid = session("memberid");
		$time = time();
		$articlename = M("article_article")->where("articleid=$id")->getField("articlename");
		
	
		M("log")->add(array(
			"articleid" => $id,
			"articlename" => $articlename,
			"log" => $log,
			"log_flag" => $log_flag,
			"userid" => $memberid,
			"editime" => $time
		));
	
	}
	
	
	
	
}