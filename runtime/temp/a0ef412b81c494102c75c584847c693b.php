<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:41:"./application/index/view/index\Index.html";i:1487770892;s:43:"./application/index/view/index\include.html";i:1486745250;s:42:"./application/index/view/index\header.html";i:1487598393;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>HTML、CSS、JavaScript、PHP、MySql</title>
    	<link rel="stylesheet" type="text/css" href="./plugins/jquery-easyui-1.5/themes/metro-blue/easyui.css" />
	<link rel="stylesheet" type="text/css" href="./plugins/jquery-easyui-1.5/themes/color.css" />
	<link rel="stylesheet" type="text/css" href="./plugins/jquery-easyui-1.5/themes/icon.css" />
			
	<script type="text/javascript" src="./plugins/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="./plugins/jquery-easyui-1.5/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="./plugins/jquery-easyui-1.5/locale/easyui-lang-zh_CN.js"></script>
	<script type="text/javascript" src="./plugins/jquery.cookie.js"></script>
	<script type="text/javascript" src="./public/js/function.js"></script>
    <link rel="stylesheet" type="text/css" href="./public/css/Index.css" />

    <script type="text/javascript" src="./plugins/Highmaps-5.0.7/highcharts.js"></script>
    <script type="text/javascript" src="./plugins/Highmaps-5.0.7/highcharts-3d.js"></script>
    <script type="text/javascript" src="./plugins/Highmaps-5.0.7/modules/data.js"></script>
    <script type="text/javascript" src="./plugins/Highmaps-5.0.7/modules/drilldown.js"></script>
    <script type="text/javascript" src="./public/js/index_pie.js"></script>
    <script type="text/javascript" src="./public/js/index_bar.js"></script>

    <style type="text/css">
        .qslider {
            width: 1000px;
            height: 500px;
            margin-left: auto;
            margin-right: auto;
            position: relative;
        }
        
        #qslider {
            list-style-type: none;
            padding: 0;
            margin: 0;
            width: 1000px;
            height: 500px;
        }
        
        #qslider>li {
            display: none;
        }
        
        #arrowleft {
            top: 40%;
            position: absolute;
            left: 0;
            display: none;
        }
        
        #arrowright {
            top: 40%;
            position: absolute;
            right: 0;
            display: none;
        }
        
        #qselect {
            width: 200px;
            height: 20px;
            left: 45%;
            bottom: 50px;
            cursor: hand;
            position: absolute;
        }
    </style>
</head>

<body>
    <style type="text/css">
    #usermenu .l-btn-text {
        font-size: 17px;
    }
</style>
<div id="header" style="width:100%;height:35px;background-color: #DADADA;padding:0;margin:0;">
    <div id="header_left" style="width:300px;height:35px;line-height:35px;padding-left:50px;margin:0;float:left;">
        <a href="?s=/index/Index/index" style="text-decoration:none;"><span class="icon-signout icon-large" style="color:red;">&nbsp;首&nbsp;页</span></a>
    </div>
    <div id="header_right" style="width:300px;height:35px;line-height:35px;background-color:#088EF0;padding:0;margin:0;float:right;">
        <span id="usershow" style="color:#FFFFFF;display:none;">&nbsp;&nbsp;登录用户：</span>
        <a id="usermenu" href="javascript:void(0);" style="color:green;"></a>
    </div>
</div>
<div id="menumenu" style="width:50px;display:none;">
    <div id="login_user_name">退出</div>
</div>
<script type="text/javascript">
    //字符串为空
    function isNull(str) {
        if (str == null || str == "" || str.length < 1)
            return true;
        else
            return false;
    }

    $(document).ready(function() {
        if (!isNull($.cookie('pageusername'))) {
            $('#usershow').css('display', 'inline');
            $('#usermenu').prepend('&nbsp;&nbsp;' + $.cookie('pageusername'));
            document.getElementById('login_user_name').onclick = function() {
                if (confirm('是否退出登录？')) {
                    top.location = "?s=/index/Index/userexit";
                    self.location = "?s=/index/Index/userexit";
                    window.location.href = "?s=/index/Index/userexit";
                    window.navigate("?s=/index/Index/userexit");
                }
            }

            $('#usermenu').menubutton({
                menu: '#menumenu'
            });
        }
    });
</script>
    <div id="page_top"></div>
    <div id="page_head"></div>
    <div id="page_level1">
        <div id="page_level1_left">
            <div id="page_level1_left_left">
                <br/>
                <ul id="page_level1_left_ul">
                    <li id="li1"><a href="javascript:void(0);">布&nbsp;局</a></li><br/>
                    <li id="li2"><a href="javascript:void(0);">表&nbsp;单</a></li><br/>
                    <li id="li3"><a href="javascript:void(0);">登录&nbsp;/&nbsp;注册</a></li><br />
                    <li id="li4"><a href="javascript:void(0);">数&nbsp;据</a></li><br />
                    <li id="li5"><a href="javascript:void(0);">数据结构</a></li>
                </ul>
            </div>
            <div id="rightlist1" class="page_level1_left_right">
                <div style="width:80%;margin:20px auto;">
                    <a href="?s=/index/Layout/Layout1" style="color:#FFFFFF;width:120px;" class="easyui-linkbutton">Tree and DataGrid</a>&nbsp;&nbsp;
                    <a href="?s=/index/Tabs/tabs1" style="color:#FFFFFF;width:120px;" class="easyui-linkbutton">选&nbsp;项&nbsp;卡</a>
                </div>
            </div>
            <div id="rightlist2" class="page_level1_left_right">
                <div style="width:80%;margin:20px auto;">
                    <a href="?s=/index/Index/validate1" style="color:#FFFFFF;width:120px;" class="easyui-linkbutton">表单验证1</a>
                </div>
            </div>
            <div id="rightlist3" class="page_level1_left_right">
                <div style="width:80%;margin:20px auto;">
                    <a href="?s=/index/Index/login1" style="color:#FFFFFF;width:120px;" class="easyui-linkbutton" data-options="iconCls:'icon-man'">用户登录1</a>&nbsp;&nbsp;
                    <a href="?s=/index/Index/register1" style="color:#FFFFFF;width:120px;" class="easyui-linkbutton" data-options="iconCls:'icon-man'">用户注册1</a>
                </div>
            </div>
            <div id="rightlist4" class="page_level1_left_right">
                <div style="width:80%;margin:20px auto;">
                    <a href="?s=/index/DataGrid/paging" style="color:#FFFFFF;width:120px;" class="easyui-linkbutton">分页显示</a>
                </div>
            </div>
            <div id="rightlist5" class="page_level1_left_right"></div>
        </div>
        <div id="page_level1_right">
            <div id="main_qslider" class="qslider">
                <img id="arrowleft" src="./public/images/QSlider1/images/arrow_left.png" />
                <img id="arrowright" src="./public/images/QSlider1/images/arrow_right.png" />
                <div id="qselect">
                    <img src="./public/images/QSlider1/images/unselect.png" onClick="ShowImage(0);" />&nbsp;
                    <img src="./public/images/QSlider1/images/unselect.png" onClick="ShowImage(1);" />&nbsp;
                    <img src="./public/images/QSlider1/images/unselect.png" onClick="ShowImage(2);" />&nbsp;
                    <img src="./public/images/QSlider1/images/unselect.png" onClick="ShowImage(3);" />&nbsp;
                    <img src="./public/images/QSlider1/images/unselect.png" onClick="ShowImage(4);" />
                </div>
                <ul id="qslider">
                    <li><img src="./public/images/QSlider1/images2/monkey1.jpg" /></li>
                    <li><img src="./public/images/QSlider1/images2/monkey2.jpg" /></li>
                    <li><img src="./public/images/QSlider1/images2/monkey3.jpg" /></li>
                    <li><img src="./public/images/QSlider1/images2/monkey4.jpg" /></li>
                    <li><img src="./public/images/QSlider1/images2/monkey5.jpg" /></li>
                </ul>
            </div>
        </div>
    </div>
    <div id="page_level2">
        <div id="pie" style="width: 550px; height: 500px; float: left;"></div>
        <div id="bar" style="width: 550px; height: 500px; float: left; margin-left:50px;"></div>
    </div>
</body>

</html>

<script type="text/javascript">
    //字符串为空
    function isNull(str) {
        if (str == null || str == "" || str.length < 1 || str == "undefined")
            return true;
        else
            return false;
    }

    function right_list_show(state, list_id) {
        if (state == 'over') {
            var obj = $('#page_level1_left_left');
            var offset = obj.offset();
            $('#' + list_id).css({
                "top": offset.top,
                "left": offset.left + obj.width(),
                "display": "block",
                "z-index": "100"
            });
        } else if (state == 'out') {
            $('#' + list_id).css({
                "display": "none"
            });
        }
    }

    function right_list_close() {
        right_list_show('out', 'rightlist1');
        right_list_show('out', 'rightlist2');
        right_list_show('out', 'rightlist3');
        right_list_show('out', 'rightlist4');
        right_list_show('out', 'rightlist5');
    }

    $(document).ready(function() {

        document.body.onmousemove = function(theEvent) {
            var top = document.getElementById('page_level1_left').offsetTop;
            var left = document.getElementById('page_level1_left').offsetLeft;
            var right = document.getElementById('page_level1_left').offsetWidth + left + 500;
            var bottom = document.getElementById('page_level1_left').offsetHeight + top;

            var e = window.event || theEvent;

            // 鼠标移动相对文档的位置
            var scrollX = document.documentElement.scrollLeft || document.body.scrollLeft;
            var scrollY = document.documentElement.scrollTop || document.body.scrollTop;
            var X = e.pageX || e.clientX + scrollX;
            var Y = e.pageY || e.clientY + scrollY;

            if (X < left || X > right || Y < top || Y > bottom) {
                right_list_close();
            }
        };

        document.getElementById('li1').onclick = function() {
            right_list_close();
            right_list_show('over', 'rightlist1');
        };

        document.getElementById('li2').onclick = function() {
            right_list_close();
            right_list_show('over', 'rightlist2');
        };

        document.getElementById('li3').onclick = function() {
            right_list_close();
            right_list_show('over', 'rightlist3');
        };

        document.getElementById('li4').onclick = function() {
            right_list_close();
            right_list_show('over', 'rightlist4');
        };
        document.getElementById('li5').onclick = function() {
            right_list_close();
            right_list_show('over', 'rightlist5');
        };

        document.getElementById('li1').onmouseover = function() {
            right_list_close();
            right_list_show('over', 'rightlist1');
        };

        document.getElementById('li2').onmouseover = function() {
            right_list_close();
            right_list_show('over', 'rightlist2');
        };

        document.getElementById('li3').onmouseover = function() {
            right_list_close();
            right_list_show('over', 'rightlist3');
        };

        document.getElementById('li4').onmouseover = function() {
            right_list_close();
            right_list_show('over', 'rightlist4');
        };

        document.getElementById('li5').onmouseover = function() {
            right_list_close();
            right_list_show('over', 'rightlist5');
        };

        var num = 0;
        var count = 5; // 图片的总数
        var inter = 0;
        var slidertime = 3000; // 多长时间滚动一次，单位毫秒

        // 显示图片
        $("#qslider>li").css("display", "none");
        $("#qslider>li").eq(num).css("display", "list-item");
        // 显示选择按钮
        $('#qselect>img').attr('src', './public/images/QSlider1/images/unselect.png');
        $('#qselect>img').eq(num).attr('src', './public/images/QSlider1/images/select.png');

        function powerpoint() { // 幻灯片显示
            inter = setInterval(function() {
                // 显示图片
                $("#qslider>li").css("display", "none");
                $("#qslider>li").eq(num).css("display", "list-item");
                // 显示选择按钮
                $('#qselect>img').attr('src', './public/images/QSlider1/images/unselect.png');
                $('#qselect>img').eq(num).attr('src', './public/images/QSlider1/images/select.png');
                num++;
                if (num >= count) {
                    num = 0;
                }
            }, slidertime);
        }

        powerpoint(); // 幻灯片显示

        $('#main_qslider').mouseover(function() { // 鼠标放在幻灯片上
            $('#arrowleft').css('display', 'block');
            $('#arrowright').css('display', 'block');
            clearInterval(inter);
        });

        $('#main_qslider').mouseout(function() { // 鼠标离开幻灯片
            $('#arrowleft').css('display', 'none');
            $('#arrowright').css('display', 'none');
            powerpoint();
        });

        $('#arrowleft').click(function() { // 向前显示图片
            num = num == 0 ? count - 1 : num - 1;
            // 显示图片
            $("#qslider>li").css("display", "none");
            $("#qslider>li").eq(num).css("display", "list-item");
            // 显示选择按钮
            $('#qselect>img').attr('src', './public/images/QSlider1/images/unselect.png');
            $('#qselect>img').eq(num).attr('src', './public/images/QSlider1/images/select.png');
        });

        $('#arrowright').click(function() { // 向后显示图片
            num = num == count - 1 ? 0 : num + 1;
            // 显示图片
            $("#qslider>li").css("display", "none");
            $("#qslider>li").eq(num).css("display", "list-item");
            // 显示选择按钮
            $('#qselect>img').attr('src', './public/images/QSlider1/images/unselect.png');
            $('#qselect>img').eq(num).attr('src', './public/images/QSlider1/images/select.png');
        });
    });

    function ShowImage(num) {
        // 显示图片
        $("#qslider>li").css("display", "none");
        $("#qslider>li").eq(num).css("display", "list-item");
        // 显示选择按钮
        $('#qselect>img').attr('src', './public/images/QSlider1/images/unselect.png');
        $('#qselect>img').eq(num).attr('src', './public/images/QSlider1/images/select.png');
    }
</script>