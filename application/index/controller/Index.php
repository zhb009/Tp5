<?php
namespace app\index\controller;
use think\Db;
use app\index\controller\CommonController;


class Index extends CommonController
{
    public function index()
    {
		echo '<script type="text/javascript" src="./plugins/uaredirect.js"></script>';
		echo '<script type="text/javascript">uaredirect("?s=/index/Index/mobile");</script>';
        return $this->fetch('index/Index');
    }

	public function mobile(){
		echo '<div style="margin-top:100px;text-align:center;font-size:30px;">手机网站建设中，请用PC端访问！</div>';
	}
	
	public function login1(){
		return $this->fetch('index/login1');
	}
	
	public function register1(){
		return $this -> fetch('index/register1');
	}

	public function validate1(){
		return $this -> fetch('index/validate1');
	}

	public function regusernameajax(){
		$username = $_POST['username'];

		if(empty($username)){
			echo false;
		} else {
			$result = Db::query('select id from user where binary `username` = ?', array($username));
			if(empty($result)){
				echo false;
			} else {
				echo true;
			}
		}
	}

	public function login_submit_ajax(){
		if(isset($_POST['username']) and isset($_POST['password']) and empty($_COOKIE['pageusername'])){
    		
    		$username = empty($_POST['username']) ? '' : addslashes($_POST['username']);
    		$password = empty($_POST['password']) ? '' : addslashes($_POST['password']);
			
			$result = Db::query('select * from user where binary `username` = ? and binary `password` = ?', array($username, $password));
			
			if(empty($result)){
				echo -111;
			} else {
				setcookie('pageusername', $username, time() + 60 * 60, '/');
				echo 111;
			}
		}
	}
	
	public function is_user_login_ajax(){
		if(empty($_COOKIE['pageusername'])){
			echo -1;
		} else {
			echo 1;
		}
	}
	
	public function userexit(){  // 用户退出登录
    	
    	setcookie('pageusername', '', time() - 365 * 24 * 60 * 60, '/');
    	
    	unset($_COOKIE['pageusername']);
		
		$this -> success();
    }
	
}
