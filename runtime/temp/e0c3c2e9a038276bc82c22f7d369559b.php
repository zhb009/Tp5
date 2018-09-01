<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:46:"./application/index/view/index\pagination.html";i:1487079018;s:43:"./application/index/view/index\include.html";i:1486745250;s:42:"./application/index/view/index\header.html";i:1486745250;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>分页显示</title>
    	<link rel="stylesheet" type="text/css" href="./plugins/jquery-easyui-1.5/themes/metro-blue/easyui.css" />
	<link rel="stylesheet" type="text/css" href="./plugins/jquery-easyui-1.5/themes/color.css" />
	<link rel="stylesheet" type="text/css" href="./plugins/jquery-easyui-1.5/themes/icon.css" />
			
	<script type="text/javascript" src="./plugins/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="./plugins/jquery-easyui-1.5/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="./plugins/jquery-easyui-1.5/locale/easyui-lang-zh_CN.js"></script>
	<script type="text/javascript" src="./plugins/jquery.cookie.js"></script>
	<script type="text/javascript" src="./public/js/function.js"></script>
    <link rel="stylesheet" type="text/css" href="./plugins/Font-Awesome-3.2.1/css/font-awesome.min.css" />

    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>
    <div id="header" style="width:100%;height:35px;background-color: #DADADA;padding:0;margin:0;">
	<div id="header_left" style="width:300px;height:35px;line-height:35px;padding-left:50px;margin:0;float:left;">
		<a href="?s=/index/Index/index" style="text-decoration:none;"><span class="icon-signout icon-large" style="color:red;">&nbsp;首&nbsp;页</span></a>
	</div>
	<div id="header_right" style="width:300px;height:35px;line-height:35px;background-color:#088EF0;padding:0;margin:0;float:right;"></div>
</div>
<script type="text/javascript">
	//字符串为空
    function isNull(str) {
        if (str == null || str == "" || str.length < 1)
            return true;
        else
            return false;
    }

	$(document).ready(function(){
		if(!isNull($.cookie('pageusername'))){
        	document.getElementById('header_right').innerHTML = '&nbsp;&nbsp;<a id="login_user_name" href="javascript:void(0);" class="icon-user icon-large" style="color:green;">&nbsp;&nbsp;' + $.cookie('pageusername') + '</a>';
        	document.getElementById('login_user_name').onclick = function(){
        		if(confirm('是否退出登录？')){
					top.location="?s=/index/Index/userexit";
                    self.location="?s=/index/Index/userexit"; 
                    window.location.href="?s=/index/Index/userexit";
                    window.navigate("?s=/index/Index/userexit");
        		}
        	}
        }
	});
</script>
    <!-- 表格 -->
    <table id="access_table"></table>
</body>

</html>

<script type="text/javascript">
    $('#access_table').datagrid({
        fit: true,
        fitColumns: true,
        striped: true,
        nowrap: true,
        border: false,
        remoteSort: false,
        collapsible: true,
        url: "?c=Policy/SSLVPN&a=SVresmanageshow",
        frozenColumns: [
            [{
                field: 'ck',
                checkbox: true
            }]
        ],
        columns: [
            [{
                field: 'id',
                title: '行号',
                align: 'left',
                resizable: true,
                width: 100,
                editor: 'text'
            }, {
                field: 'node',
                title: '节点',
                align: 'left',
                resizable: true,
                width: 50,
                editor: 'text'
            }, {
                field: 'addr',
                title: '用户的IP',
                align: 'left',
                resizable: true,
                width: 100,
                editor: 'text'
            }, {
                field: 'post',
                title: '用户端口号',
                align: 'left',
                resizable: true,
                width: 50,
                editor: 'text'
            }, {
                field: 'referer',
                title: '访问来源',
                align: 'left',
                resizable: true,
                width: 100,
                editor: 'text'
            }, {
                field: 'agent',
                title: '浏览器信息',
                align: 'left',
                resizable: true,
                width: 300,
                editor: 'text'
            }, {
                field: 'time',
                title: '访问时间',
                align: 'left',
                resizable: true,
                width: 100,
                editor: 'text'
            }]
        ],
        loadMsg: '请等待，数据正在加载......'
    });
</script>