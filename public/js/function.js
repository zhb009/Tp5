//字符串为空
function isNull(str) {
    if (str == null || str == "" || str.length < 1)
        return true;
    else
        return false;
}

function userLoginWindow(divid, windowName){
	$('#' + divid).css("display", "block");
	$('#' + divid).dialog({
	    title: 'User Login',
	    iconCls:'icon-man',
	    width: 450,
	    height: 350,
	    closed: false,
	    cache: false,
	    modal: true,
	    href: "?s=/index/Index/windowShow/&w=" + windowName,
	    onClose: function(){
	    	top.location="?s=/index/Index/index";
            self.location="?s=/index/Index/index"; 
            window.location.href="?s=/index/Index/index";
            window.navigate("?s=/index/Index/index"); 
	    }
	});
}

function openWindow(divid, moduleVal, actionVal, titleVal, loadFunc) {
	$('#' + divid).css("display", "block");
	$('#' + divid).window({
		collapsible: false, //定义是否显示可折叠按钮。
		minimizable: false, //定义是否显示最小化按钮。
		maximizable: false, //定义是否显示最大化按钮。
		noheader: false, //如果设置为true，控制面板头部将不被创建。
		border: false, //定义是否显示控制面板边框。
		//top: 20, //设置面版的顶边距。
		href: "?s=" + moduleVal + "/windowShow/&w=" + actionVal,
		resizable: false, //定义窗口是否可以被缩放。
		shadow: false, //如果设置为true，显示窗口的时候将显示阴影。
		modal: true, //定义窗口是否带有遮罩效果。
		cache: false, //如果设置为true，从超链接载入的数据将被缓存。
		title: '&nbsp;&nbsp;' + titleVal,
		style: {
			borderWidth: 0,
			padding: 5
		},
		onLoad: function() {
			$('#' + divid).window('center');
			if(loadFunc){
				loadFunc();
			}
		}
	});
}

//关闭easyui-window控件
function closeWindow(divid)
{
    $('#' + divid).window("close");
}

//验证
$(function() {
	$.extend($.fn.validatebox.defaults.rules, {
		phone: { // 验证电话号码
			validator: function(value) {
				return /^((\(\d{2,3}\))|(\d{3}\-))?(\(0\d{2,3}\)|0\d{2,3}-)?[1-9]\d{6,7}(\-\d{1,4})?$/i.test(value);
			},
			message: '格式不正确,请使用下面格式:020-88888888'
		},
		mobile: { // 验证手机号码
			validator: function(value) {
				return /^(13|15|18|17)\d{9}$/i.test(value);
			},
			message: '手机号码格式不正确'
		},
		intOrFloat: { // 验证整数或小数
			validator: function(value) {
				return /^\d+(\.\d+)?$/i.test(value);
			},
			message: '请输入数字，并确保格式正确'
		},
		integer: { // 验证整数
			validator: function(value) {
				return /^[+]?[-]?[1-9]+\d*$/i.test(value);
			},
			message: '请输入整数'
		},
		notInt: { // 验证整数
			validator: function(value) {
				return !/^[+]?[-]?[0-9]+\d*$/i.test(value);
			},
			message: '输入不能全部为数字'
		},
		notChinese: { // 验证中文
			validator: function(value) {
				return !/[\Α-\￥]+/i.test(value);
			},
			message: '不能输入中文'
		},
		english: { // 验证英语
			validator: function(value) {
				return /^[A-Za-z]+$/i.test(value);
			},
			message: '请输入英文'
		},
		unnormal: { // 验证是否包含空格和非法字符
			validator: function(value) {
				return /^[a-zA-Z0-9\u4E00-\u9FA5]+$/.test(value);
			},
			message: '输入值不能为空和包含其他非法字符'
		},
		eSymbols: { // 验证是否包含非法字符
			validator: function(value) {
				return !/[`~!@#$%^&*()+<>?:"{},.\/\\;'[\]]/im.test(value);
			},
			message: '输入值不能为英文半角非法字符'
		},
		addrName: { // 验证是否包含非法字符
			validator: function(value) {
				return !/[`~!@#$%^&*()+<>?"{},\\;'[\]]/im.test(value);
			},
			message: '输入值非法'
		},
		disableQuot: { // 验证是否包含非法字符
			validator: function(value) {
				return !/["']/im.test(value);
			},
			message: '输入值不能为英文半角引号'
		},
		nospace: { // 验证是否包含空格和非法字符
			validator: function(value) {
				return !/\s/.test(value);
			},
			message: '输入值不能包含空格'
		},
		checkStr: { // 验证用户名
			validator: function(value) {
				return /^[a-zA-Z][a-zA-Z0-9_]{5,15}$/i.test(value);
			},
			message: '输入不合法（字母开头，允许6-16字节，允许字母数字下划线）'
		},
		faxno: { // 验证传真
			validator: function(value) {
				//            return /^[+]{0,1}(\d){1,3}[ ]?([-]?((\d)|[ ]){1,12})+$/i.test(value);
				return /^((\(\d{2,3}\))|(\d{3}\-))?(\(0\d{2,3}\)|0\d{2,3}-)?[1-9]\d{6,7}(\-\d{1,4})?$/i.test(value);
			},
			message: '传真号码不正确'
		},
		ipFour: { // 验证IP地址
			validator: function(value) {
				return ipvFour(value);
			},
			message: 'IP地址格式不正确'
		},
		ipSix: { // 验证IPv6地址
			validator: function(value) {
				return ipvSix(value);
			},
			message: 'IPv6地址格式不正确'
		},
		ipSixPrefix: { // ipv6地址/网络前缀
			validator: function(value) {
				if(!/:/.test(value)) {
					return false;
				}
				return value.match(/:/g).length <= 7 &&
					/::/.test(value) ?
					/^([\da-f]{1,4}(:|::)){1,6}[\da-f]{0,4}(\/(?:[0-9]|[1-9][0-9]|[1][0-2][0-8]|[1][0-1][0-9])){1}$/i.test(value) :
					/^([\da-f]{1,4}:){7}[\da-f]{1,4}(\/(?:[0-9]|[1-9][0-9]|[1][0-2][0-8]|[1][0-1][0-9])){1}$/i.test(value);
			},
			message: 'IPv6地址格:IPv6地址/网络前缀'
		},
		ipFourOripSix: { // 验证IPv4/IPv6地址
			validator: function(value) {
				return ipvFour(value) || ipvSix(value);
			},
			message: 'IP地址格式不正确'
		},
		ipSixPre: { // 网关地址
			validator: function(value) {
				return Preip(value) || PreSix(value);
			},
			message: '输入不合法'
		},
		mac: {
			validator: function(value) {
				return /^[A-Fa-f0-9]{2}:[A-Fa-f0-9]{2}:[A-Fa-f0-9]{2}:[A-Fa-f0-9]{2}:[A-Fa-f0-9]{2}:[A-Fa-f0-9]{2}$/.test(value);
			},
			message: 'MAC地址格式不正确'
		},
		ipRangeStr: { // 验证IPv4/IPv6地址,需要和IP格式验证
			validator: function(value, param) {
				var ipArr1 = [];
				var ipArr2 = [];
				var res = false;
				if(ipvFour(value)) {
					res = true;
					if(ipvFour(param[0])) {
						ipArr1 = value.split('.');
						ipArr2 = param[0].split('.');
						for(var i = 0; i < 4; i++) {
							if(parseInt(ipArr1[i]) > parseInt(ipArr2[i])) {
								return false;
							} else if(parseInt(ipArr1[i]) < parseInt(ipArr2[i])) {
								return true;
							}
						}
					}
				}
				if(ipvSix(value)) {
					res = true;
					if(ipvSix(param[0])) {
						ipArr1 = value.split(':');
						ipArr2 = param[0].split(':');
						for(var i = 0; i < 4; i++) {
							if(htoi(ipArr1[i]) > htoi(ipArr2[i])) {
								return false;
							} else if(htoi(ipArr1[i]) < htoi(ipArr2[i])) {
								return true;
							}
						}
					}
				}
				return res;
			},
			message: '开始IP应该小于结束IP'
		},
		ipRangeEnd: { // 验证IPv4/IPv6地址
			validator: function(value, param) {
				var ipArr1 = [];
				var ipArr2 = [];
				var res = false;
				if(ipvFour(value)) {
					res = true;
					if(ipvFour(param[0])) {
						ipArr1 = value.split('.');
						ipArr2 = param[0].split('.');
						for(var i = 0; i < 4; i++) {
							if(parseInt(ipArr1[i]) < parseInt(ipArr2[i])) {
								return false;
							} else if(parseInt(ipArr1[i]) > parseInt(ipArr2[i])) {
								return true;
							}
						}
					}
				}
				if(ipvSix(value)) {
					res = true;
					if(ipvSix(param[0])) {
						ipArr1 = value.split(':');
						ipArr2 = param[0].split(':');
						for(var i = 0; i < 4; i++) {
							if(htoi(ipArr1[i]) < htoi(ipArr2[i])) {
								return false;
							} else if(htoi(ipArr1[i]) > htoi(ipArr2[i])) {
								return true;
							}
						}
					}
				}
				return res;
			},
			message: '结束IP应该大于开始IP'
		},
		date: {
			validator: function(value) {
				//格式yyyy-MM-dd或yyyy-M-d
				return /^(?:(?!0000)[0-9]{4}([-]?)(?:(?:0?[1-9]|1[0-2])\1(?:0?[1-9]|1[0-9]|2[0-8])|(?:0?[13-9]|1[0-2])\1(?:29|30)|(?:0?[13578]|1[02])\1(?:31))|(?:[0-9]{2}(?:0[48]|[2468][048]|[13579][26])|(?:0[48]|[2468][048]|[13579][26])00)([-]?)0?2\2(?:29))$/i.test(value);
			},
			message: '请输入合适的日期格式'
		},
		time: {
			validator: function(value) {
				//格式yyyy-MM-dd或yyyy-M-d
				return /^((20|21|22|23|[0-1]\d)\:[0-5][0-9])(\:[0-5][0-9])?$/.test(value);
			},
			message: '请输入合适的时间格式'
		},
		less: {
			validator: function(value, param) { //param需传入页面元素ID
				return value < $(param[0]).val();
			},
			message: '需要小于0'
		},
		greater: {
			validator: function(value, param) { //param需传入页面元素ID
				return value > $(param[0]).val();
			},
			message: '需要大于0'
		},
		lessEquals: {
			validator: function(value, param) { //param需传入页面元素ID
				if(param[0]) {
					return parseInt(value) <= parseInt(param[0]);
				} else {
					return true;
				}
			},
			message: '需要小于等于0'
		}
	});
});