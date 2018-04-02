<?php
	include 'paras_3.php';
	
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
	$TITLE = "击球夺金";
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
			<img id="smileSun" class="float hidden" src="<?=$imgPath?>smileSun.png">
			<img id="leftCloud" class="float hidden" src="<?=$imgPath?>leftCloud.png">
			<img id="rightCloud" class="float hidden" src="<?=$imgPath?>rightCloud.png">
			<img id="bgstars1" class="float" src="<?=$imgPath?>bgstars1.png">
			<img id="bgstars2" class="float" src="<?=$imgPath?>bgstars2.png">
			<img id="bgstars3" class="float" src="<?=$imgPath?>bgstars3.png">
			<img id="bgstars4" class="float" src="<?=$imgPath?>bgstars4.png">
			<img id="bgstars5" class="float" src="<?=$imgPath?>bgstars5.png">
			<img id="bgstars6" class="float" src="<?=$imgPath?>bgstars6.png">
		</div>
		<div id="pageBarcode" class="float hidden fullScreen">
			<img id="startBalloon3" class="float hidden startBalloonAll startBalloonShake" src="<?=$imgPath?>startBalloon3.png">
			<img id="startBalloon1" class="float hidden startBalloonAll startBalloonShake" src="<?=$imgPath?>startBalloon1.png">
			<img id="startBalloon2" class="float hidden startBalloonAll startBalloonShake" src="<?=$imgPath?>startBalloon2.png">
			<img id="startTitle" class="float hidden" src="<?=$imgPath?>startTitle.png">
			<img id="startBgBalloon" class="float hidden startBalloonAll startBalloonShake" src="<?=$imgPath?>startBgBalloon.png">
			<img id="startBalloon4" class="float hidden startBalloonAll startBalloonShake" src="<?=$imgPath?>startBalloon4.png">
			<img id="startBalloon5" class="float hidden startBalloonAll startBalloonShake" src="<?=$imgPath?>startBalloon5.png">
			<img id="startHint" class="float hidden" src="<?=$imgPath?>startHint.png">
			<img id="startCodeBg" class="float hidden" src="<?=$imgPath?>startCodeBg.png">
			<div id="startCode" class="float hidden"></div>
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
			<img id="endBalloonBg" class="float hidden" src="<?=$imgPath?>endBalloonBg.png">
			<img id="endTitle" class="float hidden" src="<?=$imgPath?>endTitle.png">
			<img id="endText" class="float hidden" src="<?=$imgPath?>endText.png">
			<div id="endHitNumber" class="float hidden" style="color:#EA1D66;"></div>
			<div id="endHitGift" class="float hidden" style="color:#01AAFF;"></div>
			<img id="endContent" class="float hidden" src="<?=$imgPath?>endContent.png">
			<img id="endFontStars" class="float hidden" src="<?=$imgPath?>endFontStars.png">
			<img id="endFontBalloon1" class="float hidden endBalloonAll startBalloonShake" src="<?=$imgPath?>endFontBalloon1.png">
			<img id="endFontBalloon2" class="float hidden endBalloonAll startBalloonShake" src="<?=$imgPath?>endFontBalloon2.png">
			<img id="endFontBalloon3" class="float hidden endBalloonAll startBalloonShake" src="<?=$imgPath?>endFontBalloon3.png">
			<img id="endFontBalloon4" class="float hidden endBalloonAll startBalloonShake" src="<?=$imgPath?>endFontBalloon4.png">
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
	<script type="text/javascript" src="http://cdn.staticfile.org/jquery.qrcode/1.0/jquery.qrcode.min.js"></script>

	<script type="text/javascript">
		var Settings = {};
		Settings.Balloonnumber = 50;
		Settings.GameOver = false;
		Settings.HitNumber = 0;
		Settings.CursorWidth = 50;
		Settings.CursorHeight = 50;
		Settings.BlowWidth = 200-200/10;
		Settings.BlowHeight = 300-300/10;
		Settings.OldTop = "";
		Settings.OldLeft = "";
		Settings.CurrentTop = "";
		Settings.CurrentLeft = "";
		
		var BalloonWinning = new Array();
		// BalloonWinning[1] = 1;
		// BalloonWinning[2] = 3;
		// BalloonWinning[3] = 4;
		 for(var i=1;i<=Settings.Balloonnumber;i++){
			BalloonWinning.push(i);
		}
		
		PageSize.oriHeight = 1080;
		PageSize.oriWidth = 1920;
		PageSize.windowHeight = $(window).height();
		PageSize.windowWidth = $(window).width();

		var mobileId = 1;
		var socket;
		var serverId;
		
		window.onload = function(){
			InitSize();
			$(document).unbind("ajaxStart");
			$(document).ajaxComplete(function(){
			});
			InitSocoet();
			

// setTimeout(function(){
	// beginAim();
// },5000)
		}
		function NoResponse(){
			Settings.OldTop = Settings.CurrentTop;
			Settings.OldLeft = Settings.CurrentLeft;
console.log("Settings.OldTop",Settings.OldTop);
console.log("Settings.OldLeft",Settings.OldLeft);
			setTimeout(function(){
console.log("Settings.CurrentTop",Settings.CurrentTop);
console.log("Settings.CurrentLeft",Settings.CurrentLeft);
				if(Settings.OldTop == Settings.CurrentTop && Settings.OldLeft == Settings.CurrentLeft && Settings.OldTop != "" && Settings.OldLeft != "" && Settings.CurrentTop != "" && Settings.CurrentLeft != ""){
					socket.emit('GameOver',{"result":"close","serverId":serverId});//关闭或刷新页面
					window.location.reload();
console.log("没有响应");
				}	
			},3000);
		}
		
		// window.onbeforeunload = function(event) { return confirm("确定离开此页面吗？"); }
		
		function ClosePage(){
// event.returnValue="确定离开当前页面吗？";
			
			socket.emit('GameOver',{"result":"close","serverId":serverId});//关闭或刷新页面
			
			/* var a_n = window.event.screenX - window.screenLeft;        
			var a_b = a_n > document.documentElement.scrollWidth-20;        
			if(a_b && window.event.clientY< 0 || window.event.altKey){         
				socket.emit('GameOver',{"result":"close","serverId":serverId});//关闭页面
			}else{
				socket.emit('GameOver',{"result":"close","serverId":serverId});//刷新页面
			} */
		}
		
		function InitSocoet(){
			sign = "123";
			socket = io('<?=SOCKET_SERVER_URL?>');
			
			socket.emit('SignServer',{"sign":"123","windowWidth":$(window).width(),"windowHeight":$(window).height()});

			socket.on('AccessSign', function (data) {
console.log(data);
console.log(data.serverId);
				serverId = data.serverId;
				ShowBarcode();
				window.onbeforeunload = ClosePage;
			});
			
			socket.on('MobileJoin',function(data){
console.log('MobileJoin');
console.log(data);
				if(data == "1"){
					return;
				}
				beginAim();
				setInterval(NoResponse , 5000);
				setTimeout(function(){
					if(Settings.OldTop == ""){
						socket.emit('GameOver',{"result":"close","serverId":serverId});//关闭或刷新页面
						window.location.reload();
					}
				},60000)
			});
			
			socket.on('MobileAim',function(data){
console.log('MobileAim');
console.log(data);
				Aim(data);
			});
			
			socket.on('AimOver',function(data){
console.log('AimOver');
console.log(data);
				if(data == "no"){
					MessageFix("校准数据有误，无法继续游戏。");
					$("#messageContainer").css("margin","0% 30%");
					$("#messageText").css("font-size",OffsetLeftFullScreen(35)+"px");
					socket.emit('GameOver',{"result":"no","serverId":serverId});
				}else
					AimOver();
			});
			
			socket.on('MobilePosition',function(data){
				p = data;
// console.log("left : " + p.l + " , top : " + p.t);
				// $("#balloonCursor").css({top : p.t , left : p.l , background : "transparent"});
				$("#balloonCursor").css({top : OffsetLeftFullScreen(p.t-Settings.CursorHeight/2) , left : OffsetLeftFullScreen(p.l-Settings.CursorWidth/2)});
				$("#balloonCursor").css("opacity","1");
				
				Settings.CurrentTop = p.t;
				Settings.CurrentLeft = p.l;
			});

			socket.on('MobileShot',function(data){
				p = data;
// console.log(data);
console.log("left : " + p.l + " , top : " + p.t);
				// $("#balloonCursor").css({top : p.t , left : p.l , background : "red"});
				$("#balloonCursor").css({top : OffsetLeftFullScreen(p.t-Settings.CursorHeight/2) , left : OffsetLeftFullScreen(p.l-Settings.CursorWidth/2)});
				$("#balloonCursor").css("opacity","0.1");
				GetBalloonPosition(p);
			});
			
			socket.on('GameOverpc',function(data){
console.log("GameOverpc");
console.log(data);
				window.location.reload();//刷新当前页面.
			});
			socket.on('GetGiftpc',function(data){
console.log("GetGiftpc");
console.log(data);
				// ShowResult();
			});
		}
		
		function ShowBarcode(){
			ShowPageBgAll();
			ShowPageBarcode();
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
			// $("#aimTitle").SetSizeFullScreen(342,305,1294,397);
			$("#aimTitle").SetSizeFullScreen(282,318,1348,493);
			$("#balloonCursor").OffsetFullScreen({width:Settings.CursorWidth,height:Settings.CursorHeight});
			$(".balloonBlow").OffsetFullScreen({width:Settings.BlowWidth,height:Settings.BlowHeight});
			
			$("#readyTitle").SetSizeFullScreen(318,224,1456,397); 
			
			$("#endBalloonBg").SetSizeFullScreen(45,443,986,1009); 
			$("#endTitle").SetSizeFullScreen(341,789,336,104); 
			$("#endText").SetSizeFullScreen(468,749,244,77); 
			$("#endContent").SetSizeFullScreen(615,710,503,68); 
			$("#endFontStars").SetSizeFullScreen(167,585,731,753); 
			$("#endFontBalloon1").SetSizeFullScreen(177,654,97,193); 
			$("#endFontBalloon2").SetSizeFullScreen(86,671,202,312); 
			$("#endFontBalloon3").SetSizeFullScreen(407,450,334,480); 
			$("#endFontBalloon4").SetSizeFullScreen(314,1154,288,423);
			$("#endHitNumber").SetSizeFullScreen(471-10,1023,156,73);
			$("#endHitGift").SetSizeFullScreen(605-10,891,132,78); 
			$("#endHitNumber").css("font-size",OffsetLeftFullScreen(100)+"px");
			$("#endHitGift").css("font-size",OffsetLeftFullScreen(100)+"px");
		}
		
		function beginAim(){
			Settings.AimId = 1;
			Settings.AimPosition = new Array();
			
			$("#pageBarcode").animate({opacity:0},1000);
			setTimeout(function(){
				$("#pageAimContainer").removeClass("hidden");
				$("#aimTitle").SetSizeFullScreen(342,305,1294,397);
				$("#aimTitle").ShowText("lefttoright",500);
				clearInterval(Settings.setIntervalStars);
			},500)
			setTimeout(function(){
				Aim(1);
// AimOver();
			},1000)
		}
		
		function Aim(p){
			//p = Settings.AimId;
			if(p>4){
				// AimOver();
				// return;
				$("#aimCursor").addClass("hidden");
			}
			$(".AimBox").addClass("hidden");
			$("#aimCursor").attr("src","<?=$imgPath?>balloonCursor.png");
			switch(p){
				case 1:
					$("#aimBalloon1").removeClass("hidden");
					$("#aimCursor").animate({top:OffsetTopFullScreen(41),left:OffsetLeftFullScreen(44),width:OffsetLeftFullScreen(170),height:OffsetTopFullScreen(170)});
					break;
				case 2:
					$("#aimBalloon2").removeClass("hidden");
					$("#aimCursor").animate({top:OffsetTopFullScreen(41),left:OffsetLeftFullScreen(1706),width:OffsetLeftFullScreen(170),height:OffsetTopFullScreen(170)});
					break;
				case 3:
					$("#aimBalloon3").removeClass("hidden");
					$("#aimCursor").animate({top:OffsetTopFullScreen(791+80),left:OffsetLeftFullScreen(48),width:OffsetLeftFullScreen(170),height:OffsetTopFullScreen(170)});
					break;
				case 4:
					$("#aimBalloon4").removeClass("hidden");
					$("#aimCursor").animate({top:OffsetTopFullScreen(780+80),left:OffsetLeftFullScreen(1607+100),width:OffsetLeftFullScreen(170),height:OffsetTopFullScreen(170)});
					break;
			}
		}
		
		function AimOver(){
			$("#pageAimContainer").animate({opacity:0},500);
			$("#pageGameGo").css("opacity","0").animate({opacity:1},500).show();
			$("#readyTitle").addClass("readyTitleFlash").show();
			setTimeout(function(){
				$("#readyTitle").animate({opacity:0},1000);
				BeginGame();
			},3000);
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
								socket.emit('GameOver',{"result":Settings.HitNumber,"serverId":serverId});
								ShowResult();
							},animatime)
						}
					},500*i)
				})(i)
			}
		}
		function GetBalloonPosition(p){
// console.log(BalloonWinning);
			var pLeft = OffsetLeftFullScreen(p.l-Settings.CursorWidth/2);
			var pTop =  OffsetLeftFullScreen(p.t-Settings.CursorHeight/2);
			for(i=0;i<BalloonWinning.length;i++){
			// for(i=BalloonWinning.length;i>=0;i--){
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
					
					// setTimeout(function(){
						$("#balloonBlow0").removeClass("hidden");
						$("#BalloonImg"+BalloonWinning[i]).addClass("hidden");
						BalloonWinning.splice(i,1); 
// console.log(BalloonWinning);
					// },0)
					
					setTimeout(function(){
						$("#balloonBlow0").addClass("hidden");
						$("#balloonBlow1").removeClass("hidden");
					},200)
					setTimeout(function(){
						$("#balloonBlow1").addClass("hidden");
						$("#balloonBlow2").removeClass("hidden");
					},300)
					setTimeout(function(){
						$("#balloonBlow2").addClass("hidden");
						$("#balloonBlow3").removeClass("hidden");
					},400)
					setTimeout(function(){
						$("#balloonBlow3").addClass("hidden");
					},600)
					Settings.HitNumber++;
					// BalloonWinning.splice(i,1); 
// console.log(BalloonWinning);


					// Settings.GameOver = true;
					// $(".BalloonImg").stop(true);
					// socket.emit('GameOver',{"result":Settings.HitNumber});
					// ShowResult();
					break;
				}
			}
		}
		function ShowPageBgAll(){
			$("#pageBgAll").removeClass("hidden");
			AnimateStars();
			Settings.setIntervalStars = setInterval(AnimateStars,1000);
			$("#leftCloud").addClass("CloudfadeInLeft").show();
			$("#rightCloud").addClass("CloudfadeInRight").show();
			$("#smileSun").addClass("SunfadeInUp").show();
		}
		function ShowPageBarcode(id){
			$("#pageBarcode").removeClass("hidden");
			setTimeout(function(){
				$("#startTitle").addClass("SmallTobig").show();
			},1000)
			setTimeout(function(){
				// $("#startHint").css("opacity","0").animate({opacity:1},1000).show();
				$("#startHint").SetSizeFullScreen(818,618,404,163);
				$("#startHint").ShowText("lefttoright",500);
				$(".startBalloonAll").css("opacity","0").animate({opacity:1},1000).show();
			},1500)
			setTimeout(function(){
				var strCode = 'http://www.wsestar.com/test/shot/mobile_3.php?serverId='+serverId;
				$("#startCode").qrcode({
					render:"canvas",
					width:OffsetLeftFullScreen(212),
					height:OffsetTopFullScreen(212),
					text: strCode
				});
				$("#startCodeBg,#startCode").addClass("Codebounce").show();
			},2000)
		}
		function ShowResult(){

			// if(Settings.HitNumber == 0){
				// MessageFix("很抱歉，您未中奖");
				// $("#messageContainer").css("margin","0% 30%");
				// $("#messageText").css("font-size",OffsetLeftFullScreen(35)+"px");
			// }else{
				ShowPageGameOver();
				$("#endHitNumber").html(Settings.HitNumber);
			// }
			
			/*
			if(data.giftname == "-9"){
				MessageFix("您今天已经中过奖，明天再来吧。");
				$("#messageContainer").css("margin","0% 30%");
				$("#messageText").css("font-size",OffsetLeftFullScreen(35)+"px");
			}else if(data.giftname == "-99"){
				MessageFix("很抱歉，您未中奖");
				$("#messageContainer").css("margin","0% 30%");
				$("#messageText").css("font-size",OffsetLeftFullScreen(35)+"px");
			}else{
				$("#endHitGift").html(data.giftname);
				ShowPageGameOver();
			} */
		}
		function ShowPageGameOver(){
			$("#pageGameOver").removeClass("hidden");
			$("#endBalloonBg").addClass("endBgTada").show();
			setTimeout(function(){
				$("#endTitle,#endHitNumber,#endHitGift,#endText").css("opacity","0").animate({opacity:1},500).show();
				$(".endBalloonAll").css("opacity","0").animate({opacity:1},500).show();
			},200)
			setTimeout(function(){
				$("#endContent").SetSizeFullScreen(602,725,469,79); 
				$("#endContent").ShowText("lefttoright",500);
				$("#endFontStars").addClass("starsfadeInDown").show();
			},600)
		}
		
		function AnimateStars(){
			setTimeout(function(){
				$("#bgstars1").css({top:OffsetTopFullScreen(356),left:OffsetLeftFullScreen(160)});
				$("#bgstars2").css({top:OffsetTopFullScreen(158),left:OffsetLeftFullScreen(350)});
				$("#bgstars3").css({top:OffsetTopFullScreen(188),left:OffsetLeftFullScreen(570)});
				$("#bgstars4").css({top:OffsetTopFullScreen(50),left:OffsetLeftFullScreen(1390)});
				$("#bgstars5").css({top:OffsetTopFullScreen(194),left:OffsetLeftFullScreen(1752)});
				$("#bgstars6").css({top:OffsetTopFullScreen(226),left:OffsetLeftFullScreen(1764)});
			},0);
			setTimeout(function(){
				$("#bgstars1").css({top:OffsetTopFullScreen(356+10),left:OffsetLeftFullScreen(160-10)});
				$("#bgstars2").css({top:OffsetTopFullScreen(158+10),left:OffsetLeftFullScreen(350+10)});
				$("#bgstars3").css({top:OffsetTopFullScreen(188+10),left:OffsetLeftFullScreen(570-5)});
				$("#bgstars4").css({top:OffsetTopFullScreen(50+10),left:OffsetLeftFullScreen(1390+5)});
				$("#bgstars5").css({top:OffsetTopFullScreen(194+5),left:OffsetLeftFullScreen(1752-10)});
				$("#bgstars6").css({top:OffsetTopFullScreen(226+10),left:OffsetLeftFullScreen(1764-0)});
			},500);
		}
	</script>
  </body>
</html>
