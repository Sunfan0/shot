<?php

	include 'paras.php';
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
		<div id="MobileBgAll" class="float hidden fullScreen">
			<img id="mobileBgall" class="float fullScreen" src="<?=$imgPath?>mobileBgall.jpg">
			<img id="mobileTitle" class="float" src="<?=$imgPath?>mobileTitle.png">
			<img id="mobilesmileSun" class="float" src="<?=$imgPath?>mobilesmileSun.png">
			<img id="mobileleftCloud" class="float" src="<?=$imgPath?>mobileleftCloud.png">
			<img id="mobilerightCloud" class="float" src="<?=$imgPath?>mobilerightCloud.png">
			<img id="mobileText" class="float" src="<?=$imgPath?>mobileText.png">
			<img id="mobilebgstars1" class="float" src="<?=$imgPath?>mobilebgstars1.png">
			<img id="mobilebgstars2" class="float" src="<?=$imgPath?>mobilebgstars2.png">
			<img id="mobilebgstars3" class="float" src="<?=$imgPath?>mobilebgstars3.png">
			<div id="mobileAdjustBtn" class="float" ontouchstart="PostMobileShot();"></div>
		</div>
	</div>
	<!--
	<h3>请用手机浏览器访问</h3>
	<p>左右：<span id="alpha">0</span></p>
	<p>前后：<span id="beta">0</span></p>
	<p>扭转：<span id="gamma">0</span></p>
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
<script type="text/javascript">
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
    //init();
    function init(){
		InitSize();
        if (window && window.DeviceMotionEvent)
			window.addEventListener("devicemotion", motionHandler, false);
        if (window && window.DeviceOrientationEvent)
			window.addEventListener("deviceorientation", orientationHandler, false);
		InitSocoet();
    }
	
	function InitSocoet(){
		sign = "123";
		socket = io('<?=SOCKET_SERVER_URL?>');
		
		socket.emit('SignMobile',{"sign":"123"});
		
		socket.on('AccessSign',function(data){
console.log(data);
		});
		socket.on('GameOver',function(data){
console.log(data);
alert(data);
		// clearInterval(Settings.setIntervalPosition);
		});
		$("#MobileBgAll").removeClass("hidden");
		Settings.setIntervalPosition = setInterval(PostMobilePosition , 10);
	}

    function orientationHandler(event) {
console.log(event);
        /*  document.getElementById("alpha").innerHTML = event.alpha||0;
        document.getElementById("beta").innerHTML = event.beta||0;
        document.getElementById("gamma").innerHTML = event.gamma||0;
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
		
		$("#maincontainer").removeClass("hidden");
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