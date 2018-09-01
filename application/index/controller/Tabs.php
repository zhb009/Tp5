<?php
namespace app\index\controller;
use think\Db;
use app\index\controller\CommonController;


class Tabs extends CommonController
{
    public function tabs1(){
        if(empty($_GET['tab'])){
            return $this -> fetch('index/tabs1');
        } else if ($_GET['tab'] == 'loadbalance') {  // 资源负载均衡管理
            return $this -> fetch('index/tabpage5');
        } else if ($_GET['tab'] == 'gres') {  // 资源组管理
            return $this -> fetch('index/tabpage6');
        } else if ($_GET['tab'] == 'Icon') {  // 图标管理
            return $this -> fetch('index/tabpage7');
        }
	}
}

?>