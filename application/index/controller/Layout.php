<?php
namespace app\index\controller;
use think\Db;
use app\index\controller\CommonController;

function recursion_build_tree($rows, $father_group_name) {
		
    $childs = tree_find_child($rows, $father_group_name);
    if (empty($childs)) {
        return null;
    }
    foreach ($childs as $key => $val) {
        $rescurTree = recursion_build_tree($rows, $val['text']);
        if (null != $rescurTree) {
            $childs[$key]['state'] = 'open';
            $childs[$key]['children'] = $rescurTree;
        }
    }
    return $childs;
}

function tree_find_child(&$rows, $father_group_name) {
	
    $childs = array();
    foreach ($rows as $key => $val) {
    	
		$father_group = explode('^', $val['groupfather']);
        if ($father_group[0] == $father_group_name) {
        	$childs[] = array('text' => $val['groupname'], 'foldType' => '1');	
        }
    }

    return $childs;
}

class Layout extends CommonController
{
		
	public function Layout1(){
		return $this -> fetch('index/layout1');
	}
	
	public function groupJsondata(){
		if(empty($_COOKIE['pageusername'])){
			$treeStruct = array();
            $treeStruct[0]['text'] = 'root';
            $treeStruct[0]['state'] = 'open';
            $treeStruct[0]['iconCls'] = 'tree-empty';
            echo json_encode($treeStruct);
		} else {
			$result = Db::query('select `groupname`,`groupfather` from tree_group where `loginuser` = ?', array($_COOKIE['pageusername']));
			
			if ($result) {
				$tree = recursion_build_tree($result, 'root');
	
	            $treeStruct = array();
	            $treeStruct[0]['text'] = 'root';
	            $treeStruct[0]['state'] = 'open';
	            $treeStruct[0]['children'] = $tree;
	            echo json_encode($treeStruct);
	        } else {
	            $treeStruct = array();
	            $treeStruct[0]['text'] = 'root';
	            $treeStruct[0]['state'] = 'open';
	            $treeStruct[0]['iconCls'] = 'tree-empty';
	            echo json_encode($treeStruct);
			}	
		}
	}
	
	public function groupJsonDataText(){
		$result = Db::query('select `groupname`,`groupfather` from tree_group where `loginuser` = ?', array($_COOKIE['pageusername']));
		
		if(empty($result)){
			$data = array();
			$data[0]['value'] = '';
			$data[0]['text'] = '-请选择所属组-';
			$data[0]['selected'] = 'true';
			
			$data[1]['value'] = 'root';
			$data[1]['text'] = 'root';
			
			echo json_encode($data);
		} else {
			$data = array();
			$data[0]['value'] = '';
			$data[0]['text'] = '-请选择所属组-';
			$data[0]['selected'] = 'true';
			
			$data[1]['value'] = 'root';
			$data[1]['text'] = 'root';
			
			foreach($result as $key => $value){
				$data[] = array(
								'value' => $value['groupname'] . '^' . $value['groupfather'],
								'text' => $value['groupname'] . '^' . $value['groupfather']
								);
			}
					
			echo json_encode($data);	
		}
	}
	
	public function groupAdd_ajax(){
		$group_name = empty($_POST['group_name']) ? '' : addslashes($_POST['group_name']);
    	$group_group = empty($_POST['group_group']) ? '' : addslashes($_POST['group_group']);
		
		if(!empty($group_group) and !empty($_COOKIE['pageusername'])){
			$result = Db::query('select id from tree_group where groupname = ?', array($group_name));
			if(empty($result[0]['id'])){
				$father_group = $group_group == 'root' ? 'root' : $group_group;
				if(strstr($father_group, 'root') == false){
					$father_group = $father_group . '^root';
				}
				Db::query('insert into `tree_group` values(NULL,?,?,?)', array($_COOKIE['pageusername'], $group_name, $father_group));
				echo 0;
			} else {
				echo -11;
			}
		}
	}
	
	public function groupEdit_ajax(){
		$group_id = empty($_POST['group_id']) ? '' : addslashes($_POST['group_id']);
		$group_name = empty($_POST['group_name']) ? '' : addslashes($_POST['group_name']);
		$group_group = empty($_POST['group_group']) ? '' : addslashes($_POST['group_group']);
		
		if(!empty($group_id) and !empty($_COOKIE['pageusername'])){
			Db::query('update `tree_group` set `groupname` = ?, `groupfather` = ? where `id` = ? and `loginuser` = ?', array($group_name, $group_group, $group_id, $_COOKIE['pageusername']));
			echo 0;
		}
	}
	
	public function groupDel_ajax(){
		$group_name = empty($_POST['group_name']) ? '' : addslashes($_POST['group_name']);
		
		if(!empty($group_name) and !empty($_COOKIE['pageusername'])){
			$arr_del = array();
			$result = Db::query('select `id`,`groupname`,`groupfather` from tree_group where `loginuser` = ?', array($_COOKIE['pageusername']));
			foreach($result as $value){
				if(strstr($value['groupfather'], $group_name) != false){
					$arr_del[] = $value['id'];	
				} else if($value['groupname'] == $group_name){
					$arr_del[] = $value['id'];	
				}
			}
			
			foreach($arr_del as $gid){
				Db::query('delete from tree_group where `id` = ?',array($gid));
			}
			
			echo 0;
		}
	}
	
	public function get_group_ajax(){
		if(isset($_GET['node'])){
			$result = Db::query('select `groupname`,`groupfather` from tree_group where `loginuser` = ?', array($_COOKIE['pageusername']));
		
			if(empty($result)){
				$data = array();
				$data[0]['value'] = '';
				$data[0]['text'] = '-请选择所属组-';
				$data[0]['selected'] = 'true';
				
				$data[1]['value'] = 'root';
				$data[1]['text'] = 'root';
				
				echo json_encode($data);
			} else {
				$data = array();
				
				foreach($result as $key => $value){
					
					if($value['groupname'] == $_GET['node']){
						$data[0]['value'] = $value['groupfather'];
						$data[0]['text'] = $value['groupfather'];
						$data[0]['selected'] = 'true';
						
						$data[1]['value'] = 'root';
						$data[1]['text'] = 'root';
					} else {
						$data[] = array(
									'value' => $value['groupname'] . '^' . $value['groupfather'],
									'text' => $value['groupname'] . '^' . $value['groupfather']
									);	
					}
				}
						
				echo json_encode($data);	
			}
		}
	}

	public function getgroupinfo(){
		if(input('post.groupname')){
			$result = Db::query('select `id` from tree_group where `loginuser` = ? and `groupname` = ?', array($_COOKIE['pageusername'],input('post.groupname')));
			echo json_encode($result[0]);
		}
	}

	public function userinfoJsondata(){
		if(empty($_COOKIE['pageusername'])){
			echo '{"rows":[]}';
		} else if(input('get.groupname')){
			
			$data = array();
			
			$result = Db::query('select * from tree_user where `loginuser` = ? and `groupfather` = ?', array($_COOKIE['pageusername'], input('get.groupname')));

			if(empty($result)){
				echo '{"rows":[]}';
			} else {
				foreach($result as $val){
					$data[] = array(
						'userName' => $val['username'],
						'userGroup' => $val['groupfather'],
						'userDescription' => $val['desc'],
						'ip' => $val['ip'],
						'hwid' => $val['hwid']
					);
				}
				
				echo json_encode($data);	
			}

		} else {
			$data = array();
			
			$result = Db::query('select * from tree_user where `loginuser` = ?', array($_COOKIE['pageusername']));
			
			foreach($result as $val){
				$data[] = array(
					'userName' => $val['username'],
					'userGroup' => $val['groupfather'],
					'userDescription' => $val['desc'],
					'ip' => $val['ip'],
					'hwid' => $val['hwid']
				);
			}
			
			echo json_encode($data);
		}
	}
	
	function usergroupJsondata(){
		
		$result = Db::query('select `groupname`,`groupfather` from tree_group where `loginuser` = ?', array($_COOKIE['pageusername']));
		
		if(empty($result)){
			$data = array();
			$data[0]['value'] = '';
			$data[0]['text'] = '-请选择所属组-';
			$data[0]['selected'] = 'true';
			
			$data[1]['value'] = 'root';
			$data[1]['text'] = 'root';
			
		} else if(input('post.groupname') || input('get.groupname')){
			$groupname = input('post.groupname') ? input('post.groupname') : input('get.groupname');
			
			foreach($result as $value){
				if($value['groupname'] == $groupname){
					$data[0] = array(
						'value' => $value['groupname'],
						'text' => $value['groupname'] . '^' . $value['groupfather'],
						'selected' => 'true'
					);
				}
			}
			
			$data[1]['value'] = 'root';
			$data[1]['text'] = 'root';
			
			foreach($result as $value){
				$data[] = array(
								'value' => $value['groupname'],
								'text' => $value['groupname'] . '^' . $value['groupfather']
								);
			}
		} else {
			$data = array();
			$data[0]['value'] = '';
			$data[0]['text'] = '-请选择所属组-';
			$data[0]['selected'] = 'true';
			
			$data[1]['value'] = 'root';
			$data[1]['text'] = 'root';
			
			foreach($result as $value){
				$data[] = array(
								'value' => $value['groupname'],
								'text' => $value['groupname'] . '^' . $value['groupfather']
								);
			}
		}
				
		echo json_encode($data);
    }

	public function userAdd_ajax(){
		$username = empty($_POST['username']) ? '' : addslashes($_POST['username']);
    	$usergroup = empty($_POST['usergroup']) ? '' : addslashes($_POST['usergroup']);
		$password = empty($_POST['password']) ? '' : addslashes($_POST['password']);
		$description = empty($_POST['description']) ? '' : addslashes($_POST['description']);
		$email = empty($_POST['email']) ? '' : addslashes($_POST['email']);
		$phone = empty($_POST['phone']) ? '' : addslashes($_POST['phone']);
		$hwidlist = empty($_POST['hwidlist']) ? '' : addslashes($_POST['hwidlist']);
		$ip = empty($_POST['ip']) ? '' : addslashes($_POST['ip']);
		
		if(empty($username) || empty($usergroup) || empty($password)){
			echo -1;
		} else {
			$result = Db::query('select `id` from tree_user where `username` = ? and `loginuser` = ?', array($username, $_COOKIE['pageusername']));
			
			if(empty($result)){
				Db::query('insert into `tree_user` values(NULL,?,?,?,?,?,?,?)', array($username,$usergroup,$password,$description,$ip,$hwidlist,$_COOKIE['pageusername']));
				echo 1;	
			} else {
				echo -2;
			}
			
		}
	}

	public function is_user_exist(){
		$username = empty($_POST['username']) ? '' : addslashes($_POST['username']);
		
		if(empty($_COOKIE['pageusername'])){
			echo -11;  // 用户没有登录
		}else{
			
			if(empty($username)){
				echo -2;
			} else {
				$result = Db::query('select `id` from tree_user where `username` = ?', array($username));
				
				if(empty($result)){
					echo 1;  // 用户不存在
				} else {
					echo -1;  // 用户已存在
				}	
			}
		}
	}
}

?>