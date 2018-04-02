
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8"/>
    <title>H5获取陀螺仪/重力感应(参考网上资源)</title>
    <meta name="viewport"
          content="width=device-width,initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no,target-densitydpi=device-dpi"/>
    <style  type="text/css">
        body{font-size: 24px;}
        span{color:#f00;}
        a{text-decoration: none;color:#f00;}
        a:hover{color:#000;}
    </style>
</head>

<body  ontouchstart="PostMobileShot();">
<!--
    DeviceOrientationEvent是获取方向，得到device静止时的绝对值；
    DeviceMotionEvent是获取移动速度，得到device移动时相对之前某个时间的差值比
    设备定位API，该API允许你收集设备的方向和移动信息。此外，该API只在具备陀螺仪功能的设备上使用。
-->
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
<p>上次收到通知的间隔：<span id="interval">0</span>毫秒</p>
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript">
var varAlpha;
var varBeta;
var mobileId = 1;
var Settings = {};
Settings.FirstShot = false;
    //init();
    function init(){
        if (window && window.DeviceMotionEvent)
			window.addEventListener("devicemotion", motionHandler, false);
        if (window && window.DeviceOrientationEvent)
			window.addEventListener("deviceorientation", orientationHandler, false);
    }

    function orientationHandler(event) {
console.log(event);
        document.getElementById("alpha").innerHTML = event.alpha||0;
        document.getElementById("beta").innerHTML = event.beta||0;
        document.getElementById("gamma").innerHTML = event.gamma||0;
        document.getElementById("heading").innerHTML = event.webkitCompassHeading||0;
        document.getElementById("accuracy").innerHTML = event.webkitCompassAccuracy||0;
		varAlpha = event.alpha||0;
		varBeta = event.beta||0;
    }

    function motionHandler(event) {
console.log(event);
        document.getElementById("interval").innerHTML = event.interval||0;
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
        document.getElementById("Rgamma").innerHTML = rotationRate.gamma||0;
    }
	
	function PostMobilePosition(){
		$.get("ajax.php?mode=setmobileposition&mobileid="+mobileId+"&alpha="+varAlpha+"&beta="+varBeta,function(json){
			console.log(json);
		})
	}
	
	function PostMobileShot(){
		//alert("shot");
		if(!Settings.FirstShot)
			init();
		$.get("ajax.php?mode=shot&mobileid="+mobileId+"&alpha="+varAlpha+"&beta="+varBeta,function(json){
			console.log(json);
		})
	}
	
	setInterval(PostMobilePosition , 100);

</script>
</body>
</html>