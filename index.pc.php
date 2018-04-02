<?php
	function php_self(){
		$php_self=substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'],'/')+1);
		$php_self=substr($php_self,0,strrpos($php_self,'.'));
		return $php_self;
	}
    $phpself=php_self();
	
	$memcache = new Memcache;  
	$memcache->pconnect('localhost', 11211);
	memcache_flush($memcache);
?>

<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
		<meta name="description" content="">
		<meta name="author" content="">
		<title><?=$TITLE?></title>
		<style>
			body{
				background : url(image/f1.gif) repeat;
				/*font-size:150% !important;*/
				font-family: "Microsoft YaHei" ! important;
			}
			
			.pagination{
				margin:0px;
			}


			.navbar-nav>li>a{
				color:white !important;
			}

			.navbar-nav>.active>a{
				color:#777 !important;
			}

			.navbar-nav>li>a:hover{
				background:rgba(14,89,167,0.5) !important;
				color:white !important;
			}
			
			@media screen and (max-width: 480px) {
				.navbar-header{
					display:none;
				}
			}
		</style>
	</head>
	<body style="overflow: hidden;padding:0px;margin:0px;">
		<div id="pageBarcode" class="float fullScreen" style="border:1px solid red;">
		</div>
		<div id="divAimContainer" class="float fullScreen" style="border:1px solod yellow">
			<div id="divAimTopLeft" class="float hidden AimBox" style="border:2px solid black"></div>
			<div id="divAimTopRight" class="float hidden AimBox" style="border:2px solid black"></div>
			<div id="divAimBottomLeft" class="float hidden AimBox" style="border:2px solid black"></div>
			<div id="divAimBottomRight" class="float hidden AimBox" style="border:2px solid black"></div>
		</div>
		<div id="divGame" class="float fullScreen hidden" style="border:1px solid green">
			<div id="divTarget" class="float" style="border:1px solid red;border-radius:10px;width:10px;height:10px;"></div>
		</div>
	</body>

    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="style/style.css" type="text/css">
	

    <script src="js/ie10-viewport-bug-workaround.js"></script>
	<script src="js/jquery-confirm.js"></script>
	<script src="js/jquery.dataTables.min.js" charset="utf-8"></script>
	<script src="js/md5.min.js" charset="utf-8"></script>
	<script src="/common/script.js" charset="utf-8"></script>	

	<script type="text/javascript">
		var Settings = {};
		var mobileId = 1;
		window.onload = function(){
			InitSize();
			BindEvents();
			$(document).unbind("ajaxStart");
			$(document).ajaxComplete(function(){
			});
		}
		function InitSize(){
			PageSize.oriHeight =$(window).height();
			PageSize.oriWidth = $(window).width();
			//PageSize.oriHeight = document.body.clientHeight;
			//PageSize.oriWidth = document.body.clientWidth;
			
			Settings.WindowWidth = $(window).width();
			Settings.WindowHeight = $(window).height();

			PageSize.SetSizeFullScreen($("#pageBarcode"),0,0,$(window).width(),$(window).height());
			PageSize.SetSizeFullScreen($("#divAimContainer"),0,0,$(window).width(),$(window).height());
			
			PageSize.SetSizeFullScreen($("#divAimTopLeft"),0,0,$(window).width()/100,$(window).height()/100);
			PageSize.SetSizeFullScreen($("#divAimTopRight"),0,$(window).width() - $(window).width()/100,$(window).width()/100,$(window).height()/100);
			PageSize.SetSizeFullScreen($("#divAimBottomLeft"),$(window).height()-$(window).height()/100,0,$(window).width()/100,$(window).height()/100);
			PageSize.SetSizeFullScreen($("#divAimBottomRight"),$(window).height()-$(window).height()/100,$(window).width() - $(window).width()/100,$(window).width()/100,$(window).height()/100);
console.log(PageSize.oriWidth);
console.log(PageSize.oriHeight);
		}
		function BindEvents(){
			//setInterval(CheckMobilePosition,100);
			beginAim();
		}
		function CheckMobilePosition(){
			$.get("ajax.php?mode=getmobileposition&mobileid=1",function(json){
				console.log(json);
			});
		}
		
		function beginAim(){
			$("#divAimContainer").removeClass("hidden");
			Settings.AimId = 1;
			Settings.AimPosition = new Array();
			Aim();
		}
		
		function Aim(){
			p = Settings.AimId;
			if(p>4){
				AimOver();
				return;
			}
			$(".AimBox").addClass("hidden");
			switch(p){
				case 1:
					$("#divAimTopLeft").removeClass("hidden");
					break;
				case 2:
					$("#divAimTopRight").removeClass("hidden");
					break;
				case 3:
					$("#divAimBottomLeft").removeClass("hidden");
					break;
				case 4:
					$("#divAimBottomRight").removeClass("hidden");
					break;
			}
			$.get("ajax.php?mode=getaimposition&mobileid="+mobileId+"&aimid="+p,function(json){
console.log(p + " , " + json);
				if(json == -1){

				} else {
					data = $.parseJSON(json)
					Settings.AimPosition[Settings.AimId] = {};
					Settings.AimPosition[Settings.AimId].alpha = data.alpha;
					Settings.AimPosition[Settings.AimId].beta = data.beta;
					Settings.AimId += 1;
				}
				setTimeout(Aim,100);
			})
		}
		
		function AimOver(){
			Settings.AlphaTotal = 360 - Settings.AimPosition[2].alpha;
			Settings.BetaTotal = Settings.AimPosition[4].beta - Settings.AimPosition[2].beta;
			Settings.AlphaBegin = 0;
			Settings.BetaBegin = Settings.AimPosition[2].beta
			Settings.AlphaWidth = Settings.WindowWidth / Settings.AlphaTotal;
			Settings.BetaHeight = Settings.WindowHeight / Settings.BetaTotal;
			console.log(Settings.AimPosition);
			$("#divAimContainer").addClass("hidden");
			BeginGame();
		}
		
		function BeginGame(){
			$("#divGame").removeClass("hidden");
			setTimeout(GetMobilePosition,100);
		}
		
		function GetMobilePosition(){
			$.get("ajax.php?mode=getmobileposition&mobileid=1",function(json){
console.log(json);
				setTimeout(GetMobilePosition,100);
				if(json == -1)
					return;
				
				p = $.parseJSON(json);
				
				l = (360 - p.alpha) * Settings.AlphaWidth;
				t = (p.beta - Settings.BetaBegin) * Settings.BetaHeight;
console.log("left : " + l + " , top : " + t);
				$("#divTarget").css({top : t , left : l});
			});
		}
	</script>
  </body>
</html>
