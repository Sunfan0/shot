function GetTime(str){
	var d = str.split(" ")[0].split("-");
	var t = str.split(" ")[1].split(":");
    d = new Date(d[0], d[1]-1, d[2], t[0], t[1], t[2] );
//console.log(d);
	return d;
}

var MessageSettings = {};
MessageSettings.ContainerTop = 400;
MessageSettings.ContainerLeft = 150;
MessageSettings.ContainerWidth = 340;
MessageSettings.ContainerHeight = 208;

function MessageFix(t){
	CheckMessageContainer();
	$("#messageText").html(t);
	$("#divMessage").removeClass("hidden");
	$("#divMessage").unbind("click");
}

function Message(t){
	CheckMessageContainer();
	$("#messageText").html(t);
	$("#divMessage").removeClass("hidden");
}

function MessageHide(){
	CheckMessageContainer();
	$("#divMessage").addClass("hidden");
}

function CheckMessageContainer(){
	if($("#divMessage").length != 0)
		return;
	
	strHtml  = '		<div id="divMessage" class="hidden image0" style="z-index:1900;">' + "\n";
	strHtml += '			<div id="messageContainer" class="float" style="background:rgba(255,255,255,0.8);border-radius:15px;">' + "\n";
	strHtml += '				<table width="80%" height="100%" align="center" valign="middle"><tr>' + "\n";
	strHtml += '					<td id="messageText" align="center" valign="middle" style="color:black;"></td>' + "\n";
	strHtml += '				</tr></table>' + "\n";
	strHtml += '			</div>' + "\n";
	strHtml += '		</div>' + "\n";

	$(document.body).append(strHtml);

	PageSize.SetSizeFullScreen($("#divMessage"),0,0,PageSize.oriWidth,PageSize.oriHeight);
	PageSize.SetSizeFullScreen($("#messageContainer"),MessageSettings.ContainerTop,MessageSettings.ContainerLeft,MessageSettings.ContainerWidth,MessageSettings.ContainerHeight);
	
	$("#divMessage").click(function(){
		$("#divMessage").addClass("hidden");
	});
}

function Wait(){
	CheckWaitContainer();
	$("#divWait").removeClass("hidden");
}
function WaitFinish(){
	$("#divWait").addClass("hidden");
}

function CheckWaitContainer(){
	if($("#divWait").length != 0)
		return;
	
	strHtml  = '		<div id="divWait" class="hidden float" style="position:fixed;z-index:2000;background:rgba(0,0,0,0.8)">' + "\n";
	strHtml += '			<img id="imgWait" class="float" src="image/load.gif" style="position:absolute;">' + "\n";
	strHtml += '		</div>' + "\n";
	
	$(document.body).append(strHtml);

	PageSize.SetSizeFullScreen($("#divWait"),0,0,PageSize.oriWidth,PageSize.oriHeight);
	PageSize.SetSizeFullScreen($("#imgWait"),450,280,64,64);
	$("#imgWait").css("width",64);
	$("#imgWait").css("height",64);
}

$(document).ajaxStart(function(){
	Wait();
});
$(document).ajaxComplete(function(){
	WaitFinish();
});


var PageSize = {};

PageSize.windowHeight = -1;
PageSize.windowWidth = -1;
PageSize.min_size = -1;

PageSize.oriHeight = 1134;
PageSize.oriWidth = 720;


PageSize.SetSizeZoom = function(obj,top,left,width,height){
	if(top == null){
		obj.css("display","none");
		return;
	}

	obj.top = top / PageSize.oriHeight * PageSize.windowHeight;
	obj.left = left / PageSize.oriWidth * PageSize.windowWidth;
	
	if(height != null){
		obj.width = width / PageSize.oriWidth * PageSize.windowWidth;
		obj.height = height / PageSize.oriHeight * PageSize.windowHeight;
	}
	if(height == null && width !=null){
		obj.width = width / PageSize.oriWidth * min_size;
		obj.height = width / PageSize.oriWidth * min_size;
	}
		
	obj.css("top" , top * PageSize.windowWidth / PageSize.oriWidth);
	obj.css("left" , left * PageSize.windowWidth / PageSize.oriWidth);
	obj.css("width" , width * PageSize.windowWidth / PageSize.oriWidth);
	obj.css("height" , height * PageSize.windowWidth / PageSize.oriWidth);
}

PageSize.SetSizeFullScreen = function(obj,top,left,width,height){
	if(top == null){
		obj.css("display","none");
		return;
	}

	obj.top = top / PageSize.oriHeight * PageSize.windowHeight;
	obj.left = left / PageSize.oriWidth * PageSize.windowWidth;
	
	if(height != null){
		obj.width = width / PageSize.oriWidth * PageSize.windowWidth;
		obj.height = height / PageSize.oriHeight * PageSize.windowHeight;
	}
	if(height == null && width !=null){
		obj.width = width / PageSize.oriWidth * min_size;
		obj.height = width / PageSize.oriWidth * min_size;
	}
		
	obj.css("top" , top * PageSize.windowHeight / PageSize.oriHeight);
	obj.css("left" , left * PageSize.windowWidth / PageSize.oriWidth);
	obj.css("width" , width * PageSize.windowWidth / PageSize.oriWidth);
	obj.css("height" , height * PageSize.windowHeight / PageSize.oriHeight);
}

PageSize.OffsetTopFullScreen = function(top){
	return top * PageSize.windowHeight / PageSize.oriHeight;
}
PageSize.OffsetLeftFullScreen = function(left){
	return left * PageSize.windowWidth / PageSize.oriWidth;
}
PageSize.OffsetwidthFullScreen = function(width){
	return width * PageSize.windowWidth / PageSize.oriWidth;
}
PageSize.OffsetheightFullScreen = function(height){
	return height * PageSize.windowWidth / PageSize.oriHeight;
}

/*window.onresize = function(){
	if($(window).width() < PageSize.windowHeight)
	{
		if(PageSize.windowHeight == -1)
		{
			PageSize.windowHeight = $(window).height();
			PageSize.windowWidth = $(window).width();
		}
	}生活和生活上计算机很多很多都都很少见呼呼呼的睡大觉，茫茫露露的一天其实挺愉快的，干完该干事情，
}*/


PageSize.oriHeight =1008;
PageSize.oriWidth = 640;
PageSize.windowHeight = $(window).height();
PageSize.windowWidth = $(window).width();


// 对Date的扩展，将 Date 转化为指定格式的String
// 月(M)、日(d)、小时(h)、分(m)、秒(s)、季度(q) 可以用 1-2 个占位符， 
// 年(y)可以用 1-4 个占位符，毫秒(S)只能用 1 个占位符(是 1-3 位的数字) 
// 例子： 
// (new Date()).Format("yyyy-MM-dd hh:mm:ss.S") ==> 2006-07-02 08:09:04.423 
// (new Date()).Format("yyyy-M-d h:m:s.S")      ==> 2006-7-2 8:9:4.18 
Date.prototype.Format = function (fmt) { //author: meizz 
    var o = {
        "M+": this.getMonth() + 1, //月份 
        "d+": this.getDate(), //日 
        "h+": this.getHours(), //小时 
        "m+": this.getMinutes(), //分 
        "s+": this.getSeconds(), //秒 
        "q+": Math.floor((this.getMonth() + 3) / 3), //季度 
        "S": this.getMilliseconds() //毫秒 
    };
    if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
    for (var k in o)
    if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
    return fmt;
}

function Error(content , confirmFunction){
	$.alert({
		icon: 'glyphicon glyphicon-info-sign',
		title: "错误",
		content: content,
		confirmButtonClass: 'btn-info',
		theme: 'bootstrap',
		confirmButton: '确定',
		confirm: confirmFunction,
	});
}
function Success(content , confirmFunction){
	$.alert({
		icon: 'glyphicon glyphicon-ok-sign',
		title: "完成",
		content: content,
		confirmButtonClass: 'btn-info',
		theme: 'bootstrap',
		confirmButton: '确定',
		confirm: confirmFunction,
	});
}

function Confirm(content , confirmFunction , cancelFunction){
	$.confirm({
		icon: 'glyphicon glyphicon-question-sign',
		title: "请确认",
		content: content,
		confirmButtonClass: 'btn-info',
		theme: 'bootstrap',
		confirmButton: '确定',
		cancelButton: '取消',
		confirm: confirmFunction,
		cancel: cancelFunction
	});
}

function Reload(){
	console.log("reload");
	window.location.reload();
}

function CheckJsonResult(json){
	if(json == "" || json == null)
		return false;
	
	return JSON.parse(json);
}

function ShowUpdateResult(json){
	switch(json){
		case "-999":
			window.location.href = "manage.login.php";
			break;
		case "1":
			Success('更新成功。');
			$("#divDetailContainer").modal("hide");
			ShowMainList();
			break;
		case "-1":
			Error('更新失败，请稍候重试。如果问题反复出现，请联系管理员。');
			break;
	}
}