<?php
    namespace app\index\controller;
    use think\Db;
    use app\index\controller\CommonController;


    class Datagrid extends CommonController
    {
        public function paging(){
            return $this -> fetch('index/pagination');
        }

        public function get_data_ajax(){
            $page = input('post.page');
            $rows = input('post.rows');

            $pagesize = 20;  // 每页显示的行数
            $start = ($page - 1) * $pagesize;
            $end = $rows;

            if(empty($_GET['date'])){
				$total = Db::query('select count(*) as total from access_info');
                $result = Db::query("select * from access_info order by id desc limit {$start},{$end}");
			} else {
                $total = Db::query("select count(*) as total from access_info where instr(time, '{$_GET['date']}')");
                $result = Db::query("select * from access_info where instr(time, '{$_GET['date']}') order by id desc limit {$start},{$end}");
			}
            $total = $total[0]['total'];
            if(empty($result)){
                echo '{"":""}';
            } else {
                echo json_encode(array('total'=> $total, 'rows' => $result));
            }
        }

        public function get_ali_ip(){
            $url = "http://ip.taobao.com/service/getIpInfo.php?ip=" . $_GET['ip'];
            $ip = json_decode(file_get_contents($url)); 

            if($ip -> code == '0'){
                $data = $ip -> data;
                $str = '<table align="center" width="1150px" height="100px" border="1">';
                $str .= '<caption><h3>阿里巴巴IP地址库</h3></caption>';
                
                $str .= '<tr><th>国家/地区</th><th>国家编号</th><th>区&nbsp;&nbsp;域</th><th>区域编号</th><th>省&nbsp;&nbsp;份</th><th>省份编号</th><th>城&nbsp;&nbsp;市</th><th>城市编号</th><th>县</th><th>县编号</th><th>运营商</th><th>运营商编号</th><th>ip</th></tr>';
                
                $str .= '<tr>';
                foreach($data as $value){
                    if(empty($value)){
                        $str .= '<td>&nbsp;</td>';
                    }else{
                        $str .= '<td>' . $value . '</td>';
                    }	
                }
                
                $str .= '</tr></table>';
                echo $str;
            }
        }
    }
?>