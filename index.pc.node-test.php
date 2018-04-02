<?php
	include 'paras.php';

	function php_self(){
		$php_self=substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'],'/')+1);
		$php_self=substr($php_self,0,strrpos($php_self,'.'));
		return $php_self;
	}
    $phpself=php_self();
	
	// $memcache = new Memcache;  
	// $memcache->pconnect('localhost', 11211);
	// memcache_flush($memcache);
	
	$imgPath = "img/";
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
		<link rel="stylesheet" href="style/style.css" type="text/css">
		<style>
		</style>
	</head>
	<body style="overflow: hidden;padding:0px;margin:0px;">
		<div id="pageBgAll" class="float hidden fullScreen">
			<img id="Bgall" class="float fullScreen" src="<?=$imgPath?>Bgall.jpg">
			<img id="smileSun" class="float" src="<?=$imgPath?>smileSun.png">
			<img id="leftCloud" class="float" src="<?=$imgPath?>leftCloud.png">
			<img id="rightCloud" class="float" src="<?=$imgPath?>rightCloud.png">
			<img id="bgstars1" class="float" src="<?=$imgPath?>bgstars1.png">
			<img id="bgstars2" class="float" src="<?=$imgPath?>bgstars2.png">
			<img id="bgstars3" class="float" src="<?=$imgPath?>bgstars3.png">
			<img id="bgstars4" class="float" src="<?=$imgPath?>bgstars4.png">
			<img id="bgstars5" class="float" src="<?=$imgPath?>bgstars5.png">
			<img id="bgstars6" class="float" src="<?=$imgPath?>bgstars6.png">
		</div>
		<div id="pageBarcode" class="float hidden fullScreen">
			<img id="startBalloon1" class="float" src="<?=$imgPath?>startBalloon1.png">
			<img id="startBalloon2" class="float" src="<?=$imgPath?>startBalloon2.png">
			<img id="startBalloon3" class="float" src="<?=$imgPath?>startBalloon3.png">
			<img id="startTitle" class="float" src="<?=$imgPath?>startTitle.png">
			<img id="startBgBalloon" class="float" src="<?=$imgPath?>startBgBalloon.png">
			<img id="startBalloon4" class="float" src="<?=$imgPath?>startBalloon4.png">
			<img id="startBalloon5" class="float" src="<?=$imgPath?>startBalloon5.png">
			<img id="startHint" class="float" src="<?=$imgPath?>startHint.png">
			<img id="startCodeBg" class="float" src="<?=$imgPath?>startCodeBg.png">
			<img id="startCode" class="float" src="<?=$imgPath?>startCode.png">
		</div>
		<div id="pageAimContainer" class="float hidden fullScreen" style="border:1px solod yellow">			
			<img id="aimBalloon1" class="float hidden AimBox" src="<?=$imgPath?>aimBalloon1.png">
			<img id="aimBalloon2" class="float hidden AimBox" src="<?=$imgPath?>aimBalloon2.png">
			<img id="aimBalloon3" class="float hidden AimBox" src="<?=$imgPath?>aimBalloon3.png">
			<img id="aimBalloon4" class="float hidden AimBox" src="<?=$imgPath?>aimBalloon4.png">
			<img id="aimCursor" class="float" src="<?=$imgPath?>aimCursor.png">
			<img id="aimTitle" class="float" src="<?=$imgPath?>aimTitle.png">
		</div>
		<div id="pageGameGo" class="float fullScreen hidden">
			<img id="readyTitle" class="float hidden" src="<?=$imgPath?>readyTitle.png">
			<img id="balloonCursor" class="float" style="z-index:9999" src="<?=$imgPath?>balloonCursor2.png">
			<img class="float hidden BalloonImg" src="<?=$imgPath?>balloon1.png">
			<img class="float hidden BalloonImg" src="<?=$imgPath?>balloon2.png">
			<img class="float hidden BalloonImg" src="<?=$imgPath?>balloon3.png">
			<img class="float hidden BalloonImg" src="<?=$imgPath?>balloon4.png">
			<img class="float hidden BalloonImg" src="<?=$imgPath?>balloon5.png">
			<img class="float hidden BalloonImg" src="<?=$imgPath?>balloon6.png">
			<img class="float hidden BalloonImg" src="<?=$imgPath?>balloon6.png">
			<img id="balloonBlow0" class="float hidden balloonBlow" src="<?=$imgPath?>balloonBlow.png">
			<img id="balloonBlow1" class="float hidden balloonBlow" src="<?=$imgPath?>balloon1_1.png">
			<img id="balloonBlow2" class="float hidden balloonBlow" src="<?=$imgPath?>balloon1_2.png">
			<img id="balloonBlow3" class="float hidden balloonBlow" src="<?=$imgPath?>balloon1_3.png">
		</div>
		<div id="pageGameOver" class="float fullScreen hidden">
			<img id="endBalloonBg" class="float" src="<?=$imgPath?>endBalloonBg.png">
			<img id="endTitle" class="float" src="<?=$imgPath?>endTitle.png">
			<img id="endText" class="float" src="<?=$imgPath?>endText.png">
			<div id="endHitNumber" class="float" style="color:#EA1D66;"></div>
			<img id="endContent" class="float" src="<?=$imgPath?>endContent.png">
			<img id="endFontStars" class="float" src="<?=$imgPath?>endFontStars.png">
			<img id="endFontBalloon1" class="float" src="<?=$imgPath?>endFontBalloon1.png">
			<img id="endFontBalloon2" class="float" src="<?=$imgPath?>endFontBalloon2.png">
			<img id="endFontBalloon3" class="float" src="<?=$imgPath?>endFontBalloon3.png">
			<img id="endFontBalloon4" class="float" src="<?=$imgPath?>endFontBalloon4.png">
		</div>
	</body>

    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="node_modules/socket.io-client/socket.io.js"></script>

    <script src="js/ie10-viewport-bug-workaround.js"></script>
	<script src="js/jquery-confirm.js"></script>
	<script src="js/jquery.dataTables.min.js" charset="utf-8"></script>
	<script src="js/md5.min.js" charset="utf-8"></script>
	<!--<script src="js/script.js" charset="utf-8"></script>-->
	<script src="js/jquery.common.js" charset="utf-8"></script>	

	<script type="text/javascript">
		var Settings = {};
		Settings.Balloonnumber = 50;
		Settings.GameOver = false;
		Settings.HitNumber = 0;
		Settings.CursorWidth = 50;
		Settings.CursorHeight = 50;
		// Settings.BlowWidth = 530;
		Settings.BlowWidth = 200-200/10;
		// Settings.BlowHeight = 609;
		Settings.BlowHeight = 300-300/10;
		
		var BalloonWinning = new Array();
		// BalloonWinning[1] = 1;
		// BalloonWinning[2] = 3;
		// BalloonWinning[3] = 4;
		 for(var i=1;i<=Settings.Balloonnumber;i++){
			BalloonWinning.push(i);
		}
		
		// setInterval(AnimateStars,10000);
		
		PageSize.oriHeight = 1080;
		PageSize.oriWidth = 1920;
		// PageSize.oriHeight = 900;
		// PageSize.oriWidth = 1440;
		PageSize.windowHeight = $(window).height();
		PageSize.windowWidth = $(window).width();
		
		
		var mobileId = 1;
		var socket;
		window.onload = function(){
			InitSize();
			BindEvents();
			$(document).unbind("ajaxStart");
			$(document).ajaxComplete(function(){
			});
			InitSocoet();
		}
		
		function Sigh(data){
			return data;
		}
		
		function InitSocoet(){
			sign = "123";
			socket = io('<?=SOCKET_SERVER_URL?>');
			
			socket.emit('SignServer',{"sign":"123","windowWidth":$(window).width(),"windowHeight":$(window).height()});
			
			socket.on('AccessSign', function (data) {
console.log(data);
console.log(sign);
				ShowBarcode(sign);
			});
			
			socket.on('MobileJoin',function(data){
console.log('MobileJoin');
console.log(data);
				beginAim();
			});
			
			socket.on('MobileAim',function(data){
console.log('MobileAim');
console.log(data);
				Aim(data);
			});
			
			// socket.on('AimOver',function(data){
				// AimOver();
			// });
			
			socket.on('MobilePosition',function(data){
				p = data;
// console.log("left : " + p.l + " , top : " + p.t);
				// $("#balloonCursor").css({top : p.t , left : p.l , background : "transparent"});
				$("#balloonCursor").css({top : OffsetLeftFullScreen(p.t-Settings.CursorHeight/2) , left : OffsetLeftFullScreen(p.l-Settings.CursorWidth/2)});
				$("#balloonCursor").css("opacity","1");
			});

			socket.on('MobileShot',function(data){
				p = data;
console.log(data);
console.log("left : " + p.l + " , top : " + p.t);
				// $("#balloonCursor").css({top : p.t , left : p.l , background : "red"});
				$("#balloonCursor").css({top : OffsetLeftFullScreen(p.t-Settings.CursorHeight/2) , left : OffsetLeftFullScreen(p.l-Settings.CursorWidth/2)});
				// $(".balloonBlow").css({top : OffsetLeftFullScreen(p.t-Settings.BlowHeight/2) , left : OffsetLeftFullScreen(p.l-Settings.BlowWidth/2)});
				$("#balloonCursor").css("opacity","0.1");
				GetBalloonPosition(p);
			});
		}
		
		function ShowBarcode(){
			ShowPageBgAll("animate");
			$("#pageBarcode").removeClass("hidden");
		}
		
		function InitSize(){
			$("#leftCloud").SetSizeFullScreen(836,-168,1189,531);
			$("#rightCloud").SetSizeFullScreen(832,960,1252,704);
			$("#smileSun").SetSizeFullScreen(572,324,1294,1294);
			$("#bgstars1").SetSizeFullScreen(356,160,79,78);
			$("#bgstars2").SetSizeFullScreen(158,350,50,49);
			$("#bgstars3").SetSizeFullScreen(188,570,29,28);
			$("#bgstars4").SetSizeFullScreen(50,1390,207,207);
			$("#bgstars5").SetSizeFullScreen(194,1752,23,24);
			$("#bgstars6").SetSizeFullScreen(226,1764,105,108);
			
			$("#startTitle").SetSizeFullScreen(224,244,1392,562);
			$("#startBgBalloon").SetSizeFullScreen(90,278,324,346);
			$("#startBalloon1").SetSizeFullScreen(176,928,235,401);
			$("#startBalloon2").SetSizeFullScreen(240,1052,219,274);
			$("#startBalloon3").SetSizeFullScreen(82,1106,131,226);
			$("#startBalloon4").SetSizeFullScreen(580,1234,141,144);
			$("#startBalloon5").SetSizeFullScreen(544,1418,166,225);
			$("#startHint").SetSizeFullScreen(818,618,404,163);
			$("#startCodeBg").SetSizeFullScreen(786,1072,232,232);
			// $("#startCode").SetSizeFullScreen(796,1082,195,195);
			$("#startCode").SetSizeFullScreen(796,1082,212,212);
			
			$("#aimBalloon1").SetSizeFullScreen(41,44,165,321);
			$("#aimBalloon2").SetSizeFullScreen(41,1706,169,319);
			$("#aimBalloon3").SetSizeFullScreen(791,48,271,249);
			$("#aimBalloon4").SetSizeFullScreen(780,1607,270,251);
			$("#aimCursor").SetSizeFullScreen(42,453,1012,996);
			$("#aimTitle").SetSizeFullScreen(342,305,1294,397);
			$("#balloonCursor").OffsetFullScreen({width:Settings.CursorWidth,height:Settings.CursorHeight});
			$(".balloonBlow").OffsetFullScreen({width:Settings.BlowWidth,height:Settings.BlowHeight});
			
			$("#readyTitle").SetSizeFullScreen(318,224,1456,397); 
			
			$("#endBalloonBg").SetSizeFullScreen(45,443,986,1009); 
			$("#endTitle").SetSizeFullScreen(341,789,336,104); 
			$("#endText").SetSizeFullScreen(468,749,244,77); 
			$("#endContent").SetSizeFullScreen(602,725,469,79); 
			$("#endFontStars").SetSizeFullScreen(167,585,731,753); 
			$("#endFontBalloon1").SetSizeFullScreen(177,654,97,193); 
			$("#endFontBalloon2").SetSizeFullScreen(86,671,202,312); 
			$("#endFontBalloon3").SetSizeFullScreen(407,450,334,480); 
			$("#endFontBalloon4").SetSizeFullScreen(314,1154,288,423); 
			// $("#endHitNumber").SetSizeFullScreen(473,1023,156,73); 
			$("#endHitNumber").SetSizeFullScreen(463,1023,156,73); 
			$("#endHitNumber").css("font-size",OffsetLeftFullScreen(100)+"px");
		}
		function BindEvents(){
			//setInterval(CheckMobilePosition,100);
			//beginAim();
		}
		function CheckMobilePosition(){
			$.get("ajax.php?mode=getmobileposition&mobileid=1",function(json){
				console.log(json);
			});
		}
		
		function beginAim(){
			$("#pageAimContainer").removeClass("hidden");
			$("#pageBarcode").addClass("hidden");
			Settings.AimId = 1;
			Settings.AimPosition = new Array();
			Aim(1);
		}
		
		function Aim(p){
			//p = Settings.AimId;
			if(p>4){
				AimOver();
				return;
			}
			$(".AimBox").addClass("hidden");
			switch(p){
				case 1:
					$("#aimBalloon1").removeClass("hidden");
					break;
				case 2:
					$("#aimBalloon2").removeClass("hidden");
					break;
				case 3:
					$("#aimBalloon3").removeClass("hidden");
					break;
				case 4:
					$("#aimBalloon4").removeClass("hidden");
					break;
			}
			/*$.get("ajax.php?mode=getaimposition&mobileid="+mobileId+"&aimid="+p,function(json){
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
			})*/
		}
		
		function AimOver(){
			$("#pageAimContainer").addClass("hidden");
			$("#pageGameGo").removeClass("hidden");
			$("#readyTitle").removeClass("hidden");
			setTimeout(function(){
				$("#readyTitle").addClass("hidden");
			},2000);
			setTimeout(function(){
				BeginGame();
			},2000);
		}
		
		function BeginGame(){
			for(i=1;i<=Settings.Balloonnumber;i++){
				(function(i){
					var balloonAnima = Math.floor(Math.random()*(5-1+1)+1); //Math.floor(Math.random()*(max-min+1)+min);
					var balloonid = Math.floor(Math.random()*(6-1+1)+1);
					var intervaltime = Math.floor(Math.random()*(1000-500+1)+500);
					var animatime = Math.floor(Math.random()*(9000-6000+1)+6000);
					var initialLeft = Math.floor(Math.random()*(Math.floor((PageSize.windowWidth-100)/100)-1+1)+1)*100;
					setTimeout(function(){
						if(Settings.GameOver){
							return;
						}
						strBalloon = "<img id='BalloonImg"+i+"' class='float BalloonImg' src='<?=$imgPath?>balloon"+balloonid+".png'>";	
						$("#pageGameGo").append(strBalloon);
						$("#BalloonImg"+i).css("left",OffsetLeftFullScreen(initialLeft));
						$("#BalloonImg"+i).css({bottom:OffsetTopFullScreen(-500)}).animate({bottom:OffsetTopFullScreen(PageSize.windowHeight+500)},animatime,"linear");
						if(i == Settings.Balloonnumber){
							setTimeout(function(){
								socket.emit('GameOver',{"result":"no"});
								$("#pageGameOver").removeClass("hidden");
								$("#endHitNumber").html(Settings.HitNumber);
							},animatime)
						}
					},500*i)
				})(i)
			}
		}
		function GetBalloonPosition(p){
			var pLeft = OffsetLeftFullScreen(p.l-Settings.CursorWidth/2);
			var pTop =  OffsetLeftFullScreen(p.t-Settings.CursorHeight/2);
			for(i=0;i<BalloonWinning.length;i++){
				var bLeft = $("#BalloonImg"+BalloonWinning[i]).offset().left;
				var bTop = $("#BalloonImg"+BalloonWinning[i]).offset().top;
				var bLArea = bLeft + 100;
				var bTArea = bTop + 220/2;
// console.log("pLeft:"+pLeft+",pTop:"+pTop);
// console.log("bLeft:"+bLeft+",bTop:"+bTop);
				if(pLeft >= bLeft && pLeft <= bLArea && pTop >= bTop && pTop <= bTArea && !Settings.GameOver){
					var BalloonId = $("#BalloonImg"+BalloonWinning[i]).attr("src").slice(11,12);
					var BalloonTop = $("#BalloonImg"+BalloonWinning[i]).offset().top;
					var BalloonLeft = $("#BalloonImg"+BalloonWinning[i]).offset().left;
					var balloonimg1 = "<?=$imgPath?>balloon"+BalloonId+"_1.png";
					var balloonimg2 = "<?=$imgPath?>balloon"+BalloonId+"_2.png";
					var balloonimg3 = "<?=$imgPath?>balloon"+BalloonId+"_3.png";
					$("#balloonBlow1").attr("src",balloonimg1);
					$("#balloonBlow2").attr("src",balloonimg2);
					$("#balloonBlow3").attr("src",balloonimg3);
					// $(".balloonBlow").css({top : BalloonTop, left : BalloonLeft});
					$(".balloonBlow").css({top : BalloonTop-Settings.BlowHeight/2 , left : BalloonLeft-Settings.BlowWidth/5});
					setTimeout(function(){
						$("#balloonBlow0").removeClass("hidden");
					},100)
					setTimeout(function(){
						$("#BalloonImg"+BalloonWinning[i]).addClass("hidden");
						$("#balloonBlow0").addClass("hidden");
						$("#balloonBlow1").removeClass("hidden");
					},300)
					setTimeout(function(){
						$("#balloonBlow1").addClass("hidden");
						$("#balloonBlow2").removeClass("hidden");
					},400)
					setTimeout(function(){
						$("#balloonBlow2").addClass("hidden");
						$("#balloonBlow3").removeClass("hidden");
					},500)
					setTimeout(function(){
						$("#balloonBlow3").addClass("hidden");
					},700)
					Settings.HitNumber++;
					
					// Settings.GameOver = true;
					// $(".BalloonImg").stop(true);
					// $("#pageGameOver").removeClass("hidden");
					// socket.emit('GameOver',{"result":"yes"});
					break;
				}
			}
		}
		function ShowPageBgAll(type){
			$("#pageBgAll").removeClass("hidden");
			switch(type){
				case "show":
					$("#pageBgAll img").removeClass("hidden");
					break;
				case "animate":
					$("#pageBgAll img").removeClass("hidden");
					break;
			}
			
			// <img id="Bgall" class="float fullScreen" src="<?=$imgPath?>Bgall.jpg">
			// <img id="smileSun" class="float" src="<?=$imgPath?>smileSun.png">
			// <img id="leftCloud" class="float" src="<?=$imgPath?>leftCloud.png">
			// <img id="rightCloud" class="float" src="<?=$imgPath?>rightCloud.png">
			// <img id="bgstars1" class="float" src="<?=$imgPath?>bgstars1.png">
			// <img id="bgstars2" class="float" src="<?=$imgPath?>bgstars2.png">
			// <img id="bgstars3" class="float" src="<?=$imgPath?>bgstars3.png">
			// <img id="bgstars4" class="float" src="<?=$imgPath?>bgstars4.png">
			// <img id="bgstars5" class="float" src="<?=$imgPath?>bgstars5.png">
			// <img id="bgstars6" class="float" src="<?=$imgPath?>bgstars6.png">
		}
		function AnimateStars(){
			setTimeout(function(){
				// $("#endSmoke1").css({top:OffsetTopFullScreen(418),left:OffsetLeftFullScreen(214)});
			},0);
			setTimeout(function(){
				// $("#endSmoke1").css({top:OffsetTopFullScreen(418),left:OffsetLeftFullScreen(214)});
			},500);
		}
	</script>
  </body>
</html>
