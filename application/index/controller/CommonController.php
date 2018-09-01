<?php
	namespace app\index\controller;
	
	class CommonController extends \think\Controller 
	{
	    // 弹出窗口
	    public function windowShow() {
		      require './application/index/view/windows/' . $_GET['w'] . '.html';
	    }
	}
?>