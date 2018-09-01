<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
	</head>
	<body>
		<?php
			$id = $_GET['id'];
			if(!empty($id)){
				$db = new mysqli('101.201.223.38', 'root', 'zhb24379442');
				$db -> select_db('pagedb');
				$db -> query('set names utf8');
				$strsql = 'select agent from access_info where id=?';
				$stmt = $db -> prepare($strsql);
				$stmt -> bind_param('i', $id);
				$stmt -> execute();
				$stmt -> bind_result($agent);
				$stmt -> fetch();
				echo $agent;
				$stmt -> close();
				$db -> close();
			}
		?>
		<br />
		<div><a href="ra.php">返回</a></div>
	</body>
</html>
