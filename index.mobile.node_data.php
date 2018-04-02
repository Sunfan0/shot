<?php
	include 'paras.php';
	
	$openid = Get("wang");
	$publisher = Get("publish");
	$ua = $_SERVER['HTTP_USER_AGENT'];
	$userInfo=null;
	$inviter=Get("inviter");
	if($inviter==''){
		$inviter=0;
	}
	if($openid == ""){
		$arrInfo = InitCustInfoV3();
		$openid = $arrInfo["openid"];
		$nickname=$arrInfo["nickname"];
		$headimgurl=$arrInfo["headimgurl"];
	} else {
		$userInfo = DBGetDataRowByField("custinfo" , "openid" , $openid);
		$nickname = $userInfo["nickname"];
		$headimgurl = $userInfo["imgurl"];
	}
	$_SESSION["stropenid"]=$openid;
	if($userInfo==null){//没有进行查找
		$userInfo = DBGetDataRowByField("custinfo" , "openid" , $openid);
	}
	$targetTime =  date("Y-m-d 00:00:00" , time());
	if($userInfo==null){//没有找到数据
		$userId = DBInsertTableField("custinfo",array("openid","nickname","imgurl"), array($openid,$nickname,$headimgurl));
	}else{
		$userId=$userInfo["id"];
	}
	 
//微信身份判定是否已经领取过优惠券
	//$visitid = InitVisitidV3();
	$visitid = -1;
	$visitid = VisitHistoryV4($openid,$visitid,"index.php",$inviter,$ua,$publisher);//在visithistory表中插入访问数据

	$stropenid = substr($openid, 0, 10);
	$token = md5($stropenid.$userId); 
	
	$stropenid = substr($openid, 0, 10);
	$strdate = date("YmdHi", time());
	$BarCodePara = md5($userId.$stropenid.$strdate);//二维码参数
	$BarCodePara = substr($BarCodePara, 0, 10);
	
	
	// $giftRates = array(//设置百分比
		// "2016-11-30 00:00:00" => 9,
		// "2016-12-01 00:00:00" => 15,
		// "2016-12-02 00:00:00" => 15,
		// "2016-12-03 00:00:00" => 14,
		// "2016-12-04 00:00:00" => 9,
		// "2016-12-05 00:00:00" => 9,
		// "2016-12-06 00:00:00" => 9,
		// "2016-12-07 00:00:00" => 9,
		// "2016-12-08 00:00:00" => 9,
		// "2016-12-09 00:00:00" => 9,
	// );
	// $giftdate=$giftRates[$targetTime];//判断活动是否开始或者结束
	
	
	$isgot=0;
	$isgotinfo = DBGetDataRowByField("gifthistory" ,array("userid","gotdate","isgot"), array($userId,date('Y-m-d'),1));
	if($isgotinfo!=null){
		$isgot=1;
	} 

	
//关于页面抽奖逻辑调用，
	//1是所有人进入之后不管今天又没有中奖，都可以玩，然后结果告诉他今天已经中过奖，明天再试	
	//2一进入游戏就判断当天有没有中过奖，如果当天已经中过奖，提示明天再来玩
	
//关于核销二维码的前台页面生成以及参数设置（在原来的基础上加入giftid,核销是针对giftid有没有领取或者使用）


//用户信息提交（核销奖品时，需提交电话和姓名？？、）

	// $BarCodePara = "1";
	// $userId = "1";
	// $token = "a";
	
	$imgPath = "img/";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8"/>
    <title>击球夺金</title>
	<link rel="stylesheet" href="style/style.css" type="text/css">
    <meta name="viewport" content="width=device-width,initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no,target-densitydpi=device-dpi"/>
    <style  type="text/css">
    </style>
</head>

<!--<body onmousedown="PostMobileShot();" ontouchstart="PostMobileShot();">-->
<body>
	<div id="maincontainer" class="float hidden fullScreen" style="overflow:hidden;">
		<div id="pageMobile" class="float hidden fullScreen">
			<img id="mobileBgall" class="float fullScreen" src="<?=$imgPath?>mobileBgall.jpg">
			<img id="mobileTitle" class="float hidden" src="<?=$imgPath?>mobileTitle.png">
			<img id="mobilesmileSun" class="float hidden" src="<?=$imgPath?>mobilesmileSun.png">
			<img id="mobileleftCloud" class="float hidden" src="<?=$imgPath?>mobileleftCloud.png">
			<img id="mobilerightCloud" class="float hidden" src="<?=$imgPath?>mobilerightCloud.png">
			<img id="mobileText" class="float hidden" src="<?=$imgPath?>mobileText.png">
			<img id="mobilebgstars1" class="float" src="<?=$imgPath?>mobilebgstars1.png">
			<img id="mobilebgstars2" class="float" src="<?=$imgPath?>mobilebgstars2.png">
			<img id="mobilebgstars3" class="float" src="<?=$imgPath?>mobilebgstars3.png">
			<div id="mobileAdjustBtn" class="float"  ontouchstart="PostMobileShot();"></div>
		</div>
		<div id="pageLimit" class="hidden image0" style="z-index: 250; top: 0px; left: 0px; width: 375px; height: 627px;">
			<div id="LimitContainer" class="float" style="border-radius: 15px; top: 248.81px; left: 87.8906px; width: 199.219px; height: 129.381px; background: rgba(255, 255, 255, 0.8);">
				<table width="80%" height="100%" align="center" valign="middle">
					<tbody>
						<tr>
							<td id="LimitText" align="center" valign="middle" style="color:black;">已经有用户进入，请稍等！</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div id="pageOverContent" class="hidden image0 float fullScreen">
			<table width="80%" height="100%" align="center" valign="middle">
				<tbody>
					<tr>
						<td id="OvermessageText" class="float" align="center" valign="middle" style="border-radius: 15px;background: rgba(255, 255, 255, 0.8);">
							<div>
								<div id="overTitle" style="font-size:28px;color:#EA1D66;padding-bottom:5px;"></div>
								<div id="overNumber" style="font-size:22px;color:#EA1D66;padding-bottom:5px;"></div>
								<div id="overgoods" style="font-size:22px;color:#01AAFF;padding-bottom:5px;"></div>
								<div id="overCode" ></div>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	
	<h3>请用手机浏览器访问</h3>
	<p>左右：<span id="alpha">0</span></p>
	<p>前后：<span id="beta">0</span></p>
	<!--<p>扭转：<span id="gamma">0</span></p>
	<p>指北针指向：<span id="heading">0</span>度</p>
	<p>指北针精度：<span id="accuracy">0</span>度</p>
	<hr/>
	<p>x轴加速度：<span id="x">0</span>米每二次方秒</p>
	<p>y轴加速度：<span id="y">0</span>米每二次方秒</p>
	<p>z轴加速度：<span id="z">0</span>米每二次方秒</p>
	<hr/>
	<p>x轴加速度(考虑重力加速度)：<span id="xg">0</span>米每二次方秒</p>
	<p>y轴加速度(考虑重力加速度)：<span id="yg">0</span>米每二次方秒</p>
	<p>z轴加速度(考虑重力加速度)：<span id="zg">0</span>米每二次方秒</p>
	<hr/>
	<p>左右旋转速度：<span id="Ralpha">0</span>度每秒</p>
	<p>前后旋转速度：<span id="Rbeta">0</span>度每秒</p>
	<p>扭转速度：<span id="Rgamma">0</span>度每秒</p>
	<hr/>
	<p>上次收到通知的间隔：<span id="interval">0</span>毫秒</p>-->
<body>
<!--
    DeviceOrientationEvent是获取方向，得到device静止时的绝对值；
    DeviceMotionEvent是获取移动速度，得到device移动时相对之前某个时间的差值比
    设备定位API，该API允许你收集设备的方向和移动信息。此外，该API只在具备陀螺仪功能的设备上使用。
-->

<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="node_modules/socket.io-client/socket.io.js"></script>
<script src="js/jquery.common.js" charset="utf-8"></script>
<script type="text/javascript" src="http://cdn.staticfile.org/jquery.qrcode/1.0/jquery.qrcode.min.js"></script>
<script type="text/javascript">
	var openid = "<?php echo $openid; ?>";
	var userid = "<?php echo $userId; ?>";
	var token = "<?php echo $token; ?>";
	var BarCodePara = "<?php echo $BarCodePara; ?>";
	// var giftdate = "<?php// echo $giftdate; ?>";		//判断活动是否开始或者结束
	var isgot = "<?php echo $isgot; ?>";		//当天是否获奖

	var Settings = {};
	var varAlpha = 0;
	var varBeta = 0;
	var mobileId = 1;
	var socket;

	// PageSize.oriHeight = 1130;
	// PageSize.oriWidth = 720;
	PageSize.oriHeight = 1008;
	PageSize.oriWidth = 640;
	PageSize.windowHeight = $(window).height();
	PageSize.windowWidth = $(window).width();		

	Settings.FirstShot = false;
	
	
	// window.onbeforeunload = ClosePage;
	function ClosePage(){ 
		// alert("我要关闭了");
		// event.returnValue="确定离开当前页面吗？";
		
		// socket.emit('GameOver',{"result":"close"});//关闭页面
		
		var a_n = window.event.screenX - window.screenLeft;        
        var a_b = a_n > document.documentElement.scrollWidth-20;        
        if(a_b && window.event.clientY< 0 || window.event.altKey){         
			socket.emit('GameOver',{"result":"close"});//关闭页面
        }else{
			socket.emit('GameOver',{"result":"reload"});//刷新页面
		}
	}
	
	
    //init();
    function init(){
		InitSize();
        if (window && window.DeviceMotionEvent)
			window.addEventListener("devicemotion", motionHandler, false);
        if (window && window.DeviceOrientationEvent)
			window.addEventListener("deviceorientation", orientationHandler, false);
		ShowPageBgAll();
		
		// if(isgot == "1"){
			// $("#LimitText").html("您今天已经中过奖，明天再来吧。");
			// $("#pageLimit").removeClass("hidden");
		// }else
			InitSocoet();
    }
	
	function GetGift(e){
		url = "giftajax.php?mode=GetGift";
		$.get(url ,{
			userid : userid,
			token : token,
			clickcount : e
		},function(json){
console.log(json);
			if(json == "-9"){
				$("#LimitText").html("您今天已经中过奖，明天再来吧。");
				$("#pageLimit").removeClass("hidden");
			}else if(json == "-99"){
				$("#LimitText").html("很抱歉，您未中奖");
				$("#pageLimit").removeClass("hidden");
			}else{
				$("#overgoods").html("获得"+json+"奖品");
				// strCodeImg = 'http://www.wsestar.com/test/shot/index.mobile.node_1.php';
				strCodeImg = 'http://www.wsestar.com/test/shot/checkout.php?id='+userid+'&p='+BarCodePara+'';
				$("#overCode").qrcode({
					render:"canvas",
					width:OffsetLeftFullScreen(200),
					height:OffsetTopFullScreen(200),
					text: strCodeImg
				});
				$("#pageOverContent").removeClass("hidden");
			}
			socket.emit('GetGift',{"giftname":json});
		});
	}
	
	function InitSocoet(){
		$("#pageLimit").removeClass("hidden");
		sign = "123";
		socket = io('<?=SOCKET_SERVER_URL?>');
		
		socket.emit('SignMobile',{"sign":sign});
		
		socket.on('AccessSign',function(data){
console.log(data);
			if(data.Access == "0"){
				$("#pageLimit").addClass("hidden");
				//window.onbeforeunload = ClosePage;
			}
		});
		
		socket.on('GameOvermobile',function(data){
console.log("GameOvermobile");
console.log(data);
			// clearInterval(Settings.setIntervalPosition);
			if(data.result == "no"){
				$("#LimitText").html("校准数据有误，无法继续游戏。");
				$("#pageLimit").removeClass("hidden");
			}else
				GetGift(data.result);
				$("#overTitle").html("恭喜你");
				$("#overNumber").html("共打了"+data.result+"个");
				
		});
		
		Settings.setIntervalPosition = setInterval(PostMobilePosition , 10);
	}
	
    function orientationHandler(event) {
// console.log(event);
        document.getElementById("alpha").innerHTML = event.alpha||0;
        document.getElementById("beta").innerHTML = event.beta||0;
        /*  document.getElementById("gamma").innerHTML = event.gamma||0;
		document.getElementById("heading").innerHTML = event.webkitCompassHeading||0;
        document.getElementById("accuracy").innerHTML = event.webkitCompassAccuracy||0;*/
		varAlpha = event.alpha||0;
		varBeta = event.beta||0;
    }

    function motionHandler(event) {
//console.log(event);
        /*document.getElementById("interval").innerHTML = event.interval||0;
        var acc = event.acceleration;
        document.getElementById("x").innerHTML = acc.x||0;
        document.getElementById("y").innerHTML = acc.y||0;
        document.getElementById("z").innerHTML = acc.z||0;
        var accGravity = event.accelerationIncludingGravity;
        document.getElementById("xg").innerHTML = accGravity.x||0;
        document.getElementById("yg").innerHTML = accGravity.y||0;
        document.getElementById("zg").innerHTML = accGravity.z||0;
        var rotationRate = event.rotationRate;
        document.getElementById("Ralpha").innerHTML = rotationRate.alpha||0;
        document.getElementById("Rbeta").innerHTML = rotationRate.beta||0;
        document.getElementById("Rgamma").innerHTML = rotationRate.gamma||0;*/
    }
	
	function InitSize(){
		$("#mobileTitle").SetSizeFullScreen(236,74,504,84);
		$("#mobilesmileSun").SetSizeFullScreen(344,-3,649,656);
		$("#mobileleftCloud").SetSizeFullScreen(808,-616,972,437);
		$("#mobilerightCloud").SetSizeFullScreen(804,320,1018,578);
		$("#mobileText").SetSizeFullScreen(726,162,321,103);
		$("#mobilebgstars1").SetSizeFullScreen(134,291,42,40);
		$("#mobilebgstars2").SetSizeFullScreen(71,452,24,24);
		$("#mobilebgstars3").SetSizeFullScreen(89,485,65,62);
		$("#mobileAdjustBtn").SetSizeFullScreen(380,48,543,564);
		
		$("#OvermessageText").SetSizeFullScreen(413,158,333,400);
		
		// $("#maincontainer").removeClass("hidden");
	}
	function ShowPageBgAll(){
		$("#pageMobile").removeClass("hidden");
		AnimateStars();
		setInterval(AnimateStars,1000);
		$("#mobileleftCloud").addClass("CloudfadeInLeft").show();
		$("#mobilerightCloud").addClass("CloudfadeInRight").show();
		$("#mobilesmileSun").addClass("SunfadeInUp").show();
		$("#mobileTitle").addClass("SmallTobig").show();
		setTimeout(function(){
			$("#mobileText").css("opacity","0").animate({opacity:1},1000).show();
		},500)
	}
	function AnimateStars(){
		setTimeout(function(){
			$("#mobilebgstars1").css({top:OffsetTopFullScreen(134),left:OffsetLeftFullScreen(291)});
			$("#mobilebgstars2").css({top:OffsetTopFullScreen(71),left:OffsetLeftFullScreen(452)});
			$("#mobilebgstars3").css({top:OffsetTopFullScreen(89),left:OffsetLeftFullScreen(485)});
		},0);
		setTimeout(function(){
			$("#mobilebgstars1").css({top:OffsetTopFullScreen(134-15),left:OffsetLeftFullScreen(291-10)});
			$("#mobilebgstars2").css({top:OffsetTopFullScreen(71+5),left:OffsetLeftFullScreen(452-15)});
			$("#mobilebgstars3").css({top:OffsetTopFullScreen(89+10),left:OffsetLeftFullScreen(485+10)});
		},500);
	}
	function PostMobilePosition(){
		p = {};
		p.mobileId = mobileId;
		p.alpha = varAlpha;
		p.beta = varBeta;
		socket.emit("MobilePosition",p);
	}
	
	function PostMobileShot(){
		$("#mobilesmileSun").css("opacity","0.5");
		setTimeout(function(){
			$("#mobilesmileSun").css("opacity","1");
		},100)
		
		p = {};
		p.mobileId = mobileId;
		p.alpha = varAlpha;
		p.beta = varBeta;
		socket.emit("MobileShot",p);
console.log("shot");
console.log(p);
	}
	
	//InitSocoet();
	init();	
	
</script>
</body>
</html>