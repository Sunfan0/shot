<?php
 //die();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<title>后台数据</title>
		<link rel="stylesheet" href="style/bgstyle.css" type="text/css"/>
		<link rel="stylesheet" href="style/demo.css" type="text/css"/>
		<link rel="stylesheet" href="http://www.wsestar.com/common/pure/pure-min.css">
		<link rel="stylesheet" type="text/css" href="style/kkpager_blue.css" />
	</head>
	<body>
		<div id="divLogin" class="float fullScreen">
			<table width="80%" align="center" class="pure-table pure-table-bordered">
				<tr>
					<td align='right'>密码</td>
					<td align='center'><input type="password" id="loginPassword"/></td>
				</tr>
				<tr>
					<td align='center' colspan='2'>
						<button id="btnLogin" class="pure-button pure-button-primary ">登录</button>
					</td>
				</tr>
			</table>
		</div>
		<div id="divselect" class="float hidden fullScreen" >
			<table width="80%"  height='100%' align="center" class="pure-table pure-table-bordered">
				<tr>
					<td align='center'><button id="btnvisit" class="pure-button pure-button-primary ">访问统计</button></td>
				</tr>
				<tr>
					<td align='center'><button id="btnsalers" class="pure-button pure-button-primary ">销售人员审核</button></td>
				</tr>
				<tr>
					<td align='center'><button id="btngiftgot" class="pure-button pure-button-primary ">查看奖品发放</button></td>
				</tr>
				<tr>
					<td align='center'><button id="btngiftuse" class="pure-button pure-button-primary ">查看奖品领取</button></td>
				</tr>
				<tr>
					<td align='center'><button id="btngetgift" class="pure-button pure-button-primary ">查看奖品数量</button></td>
				</tr>
				<tr>
					<td align='center'><button id="emptygift" class="pure-button pure-button-primary ">清空奖品数据</button></td>
				</tr>
				<tr>
					<td align='center'><button id="emptyuser" class="pure-button pure-button-primary ">清空用户数据</button></td>
				</tr>
				<tr>
					<td align='center'><button id="resetusergift" class="pure-button pure-button-primary ">重置用户抽奖数据</button></td>
				</tr>
				
				
			</table>
		</div>
		<div id='canvasDiv' class="float hidden fullScreen">
			<button id="visitreturn" class="pure-button pure-button-primary">返回</button>
		
		</div>
		<div id='giftcount' class="float hidden fullScreen" >
			<button id="giftreturn" class="pure-button pure-button-primary">返回</button>
			<p style="font-size:150%;margin-left:45%"><b>奖品数据显示</b></p>
			<table width="80%" align="center" class="pure-table pure-table-bordered">
				<thead>
					<tr>
						<td  align="center">奖品发放日期</td>
						<td  align="center">预计发放奖品总数</td>
						<td  align="center">实际抽到奖品总数</td>
						<td  align="center">剩余奖品总数</td>
						<td  align="center">奖品领取人数</td>
					</tr>
				</thead>
				<tbody id="giftdetail">
					
				</tbody>
			</table>
			<p style="font-size:150%;margin-left:42%"><b>分类奖品数据显示</b></p>
			<table width="80%" align="center" class="pure-table pure-table-bordered">
				<thead>
					<tr>
						<td  align="center" >奖品发放日期</td>
						<td  align="center" >奖品名称</td>
						<td  align="center" >预计奖品发放数量</td>
						<td  align="center" >实际领取奖品数量</td>
						<td  align="center" >奖品剩余数量</td>
					</tr>
				</thead>
				<tbody id="datalist">
				</tbody>
			</table>
		</div>
		<div id="divsalersList" class="float hidden fullScreen">
			<button id="btnReturn_salers" class="pure-button pure-button-primary ">返回</button>
			<button id="passsalers" class="pure-button pure-button-primary "onclick='ShowAllowedList()' >查看已通过人员</button>
			<button id="refusesalers" class="pure-button pure-button-primary " onclick='ShowRefusedList()'>查看已拒绝人员</button>
			<button id="initsalers" class="pure-button pure-button-primary " onclick='InitCheckList()'>查看未审核人员</button>
			
			
			<input id="searchtype" type="hidden">
			
			<input id="searchname" type="text" placeholder="按人员姓名搜索">
			<button id="btnsearchname" class="pure-button pure-button-primary " >按姓名搜索</button>
			<table  width="90%" align="center" id="" class=" pure-table  pure-table-bordered"  >
				<thead>
					<tr><td colspan="3" align="center" id='typesaler'>待审核人员列表</td></tr>
				</thead>
				<tbody id="salerslist"></tbody>
			</table>
			<div id="kkpager" style="padding:45px"></div>
		</div>
		
		<div id="divProvided" class="float hidden fullScreen">
			<button id="btnReturn_Provided" class="pure-button pure-button-primary">返回</button>
			<table width="90%" align="center"  class=" pure-table  pure-table-bordered">
				<thead>
					<tr><th colspan="4" align="center"><b>奖品发放列表</b></th></tr>
				</thead>
				<tbody>
					<tr>
						<td align="center">奖品名称</td>
						<td align="center">发放总数</td>
						<td align="center">领取总数</td>
						<td align="center"></td>
					</tr>
					<tr>
						<td align="center">一等奖</td>
						<td id="ptotalcount1" align="center" ></td>
						<td id="pselfcount1" align="center" ></td>
						<td align="center"><button id="pget1" class="pure-button pure-button-primary " >查看明细</button></td>
					</tr>
					<tr>
						<td align="center">二等奖</td>
						<td id="ptotalcount2" align="center" ></td>
						<td id="pselfcount2" align="center" ></td>
						<td align="center"><button id="pget2" class="pure-button pure-button-primary " >查看明细</button></td>
					</tr>
					<tr>
						<td align="center">三等奖</td>
						<td id="ptotalcount3" align="center"></td>
						<td id="pselfcount3" align="center" ></td>
						<td align="center"><button id="pget3" class="pure-button pure-button-primary " >查看明细</button></td>
					</tr>
					<tr>
						<td colspan="4" align="center">
							<button id="pget" class="pure-button pure-button-primary ">查看优惠券发放总明细</button>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div id="divtotalUsed" class="float  fullScreen hidden">
			<button id="btnReturn_totalUsed" class="pure-button pure-button-primary ">返回</button><br>
			<table width="90%" align="center"  class=" pure-table  pure-table-bordered">
				<thead>
					<tr><th colspan="3" align="center"><b>奖品领取列表</b></th></tr>
					<tr>
						<th align="center">奖品名称</th>
						<th align="center">已使用人数</th>
						<th align="center"></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td align="center">一等奖</td>
						<td id="count1"  align="center"></td>
						<td align="center"><button id="totaluse1" class="pure-button pure-button-primary " >查看使用明细</button></td>
					</tr>

					<tr>
						<td align="center">二等奖</td>
						<td id="count2"  align="center"></td>
						<td align="center"><button id="totaluse2" class="pure-button pure-button-primary " >查看使用明细</button></td>
					</tr>
					<tr>
						<td align="center">三等奖</td>
						<td id="count3"  align="center"></td>
						<td align="center"><button id="totaluse3" class="pure-button pure-button-primary " >查看使用明细</button></td>
					</tr>
					<tr><td colspan="3" align="center">
						<button id="totaluse" class="pure-button pure-button-primary ">查看奖品领取总明细</button>
						<!--<button id="totaluseexport" class="pure-button pure-button-primary ">用户信息导出</button>-->
					</td></tr>
				</tbody>
			</table>
		</div>
		<div id="divProvidedDetail" class="float hidden fullScreen">
			<button id="btnReturn_ProvidedDetail" class="pure-button pure-button-primary ">返回</button><br>
			<table width="90%" align="center" id="" class=" pure-table  pure-table-bordered" >
				<thead>
					<tr>
						<th colspan="4" align="center">已发放【<span id="providedgiftlevel"></span>】等奖人员列表</th>
					</tr>
					<tr>
						<th align="center">奖品名称</th>
						<th align="center">领取时间</th>
						<th align="center">头像</th>
						<th align="center">昵称</th>
					</tr>
				</thead>
				<tbody id="providedDetailList"></tbody>
			</table>
		</div>
		<div id="divtotaluseDetail" class="float hidden fullScreen">
			<button id="btnReturn_totaluseDetail" class="pure-button pure-button-primary ">返回</button><br>
			<table width="90%" align="center" id="" class=" pure-table  pure-table-bordered" >
				<thead>
					<tr>
						<th colspan="8" align="center">【<span id="totalgiftlevel"></span>】等奖明细列表</th>
					</tr>
					<tr>
						<th align="center">奖品名称</th>
						<th align="center">昵称</th>
						<th align="center">头像</th>
						<th align="center">领取时间</th>
						<th align="center">使用时间</th>
						<th align="center">核销员</th>
						<th align="center">核销电话</th>
						<th align="center">使用信息</th>
					</tr>
				</thead>
				<tbody id="totaluseDetailList"></tbody>
			</table>
		</div>
	</body>
	<script src="http://www.wsestar.com/common/jquery-1.11.1.min.js" charset="utf-8"></script>
	<script src="js/jquery.common.js" charset="utf-8"></script>
	<script type="text/javascript" src="js/ichart.1.2.1.min.js"></script>
	<script src="http://www.wsestar.com/common/md5.min.js" charset="utf-8"></script>
	<script src="js/script.js" charset="utf-8"></script>
	<script src="js/kkpager.js" charset="utf-8"></script>
	<script type="text/javascript">
		var loginPassword="";
		PageSize.oriHeight = 1008;
		PageSize.oriWidth = 640;
		PageSize.windowHeight = $(window).height();
		PageSize.windowWidth = $(window).width();
		var currentPage;
		var Settings = {};
		Settings.PageMode = "";
		var ViewWidth=OffsetLeftFullScreen(640);
		var ViewHeight=OffsetTopFullScreen(500);
		var colors=["#6C3365","#484891","#336666","#616130","#613030","#642100","#5B4B00","#844200","#5B4B00","#467500",
					"#28004D","#006000","#460046","#006030","#600030","#003E3E","#2F0000","#000079","#000000","#000079",
					"#7E3D76","#842B00","#5151A2","#484891","#796400","#3D7878","#5B5B00","#707038","#548C00","#743A3A",
					"#3A006F","#007500","#5E005E","#01814A","#820041","#005757","#4D0000","#003D79","#272727","#000093",
					"#8F4586","#A23400","#5A5AAD","#BB5E00","#977C00","#408080","#737300","#808040","#64A600","#804040"];
		//console.log(ViewWidth);
		//console.log(ViewHeight);
		
		
		window.onload = function(){
			BindEvents();
		}
		function ShowGiftData(){
			url = "bgajax.php?";
			url += "mode=ShowGiftData&loginpassword=" + loginPassword;
			$("#giftdetail").html("");
			$.get(url,function(json,status){
				if(json == "" || json == null || json == "null")
					return;
				var data=eval("("+json+")");
				for(i=0;i<data.length;i++){
					timer = data[i].timer;
					plancount = data[i].plancount;
					gotcount = data[i].gotcount;
					overcount = data[i].overcount;
					usecount = data[i].usecount;
					if(usecount==null){
						usecount = 0;
					}
					$("#giftdetail").append("<tr><td align='center'>"+timer+"</td><td align='center'>"+plancount+"</td><td align='center'>"+gotcount+"</td><td align='center'>"+overcount+"</td><td align='center'>"+usecount+"</td></tr>");
				}
			});
			url = "bgajax.php?";
			url += "mode=ShowDetailGiftData&loginpassword=" + loginPassword;
			$("#datalist").html("");
			$.get(url,function(json,status){
				if(json == "" || json == null || json == "null")
					return;
				var data=eval("("+json+")");
				for(i=0;i<data.length;i++){
					giftname = data[i].giftname;
					giftlevel = data[i].giftlevel;
					gifttime = data[i].gifttime;
					giftcount = data[i].giftcount;
					giftgotcount = data[i].gotcount;
					count = data[i].count;
					$("#datalist").append("<tr><td align='center'>"+gifttime+"</td><td align='center'>"+giftname+"</td><td align='center'>"+giftcount+"</td><td align='center'>"+giftgotcount+"</td><td align='center'>"+count+"</td></tr>");
				}
			});
	
		} 
		function dataPaging(pagecount,type){
			kkpager.generPageHtml({
				pno : 1,
				total : pagecount,
				mode : 'click',//默认值是link，可选link或者click
				click : function(n){
					currentpage = n;
					this.selectPage(currentpage);
					switch(Settings.PageMode){
						case "getsalerinfo":
							url="manageajax.php?mode="+Settings.PageMode+"&type="+type+"&currentpage="+currentpage;
							url += "&loginname=" + loginName + "&loginpassword=" + loginPassword;
							$.get(url,function(json){
								BuildList("salerslist",json,type);
							})	
							break;
						case "getsearchsalerinfo":
							url="manageajax.php?mode="+Settings.PageMode+"&type="+type+"&currentpage="+currentpage+"&searchtext="+$("#search").find("option:selected").text();
							url += "&loginname=" + loginName + "&loginpassword=" + loginPassword;
							$.get(url,function(json){
								BuildList("salerslist",json,type);
							})	
							break; 
						case "getsearchsalername":
							url="manageajax.php?mode="+Settings.PageMode+"&type="+type+"&currentpage="+currentpage+"&searchtext="+$("#searchname").val();
							url += "&loginname=" + loginName + "&loginpassword=" + loginPassword;
							$.get(url,function(json){
								BuildList("salerslist",json,type);
							})	
							break; 
					}
					
				}
			} , true);
		}
		function BindEvents(){
			$("#btnLogin").click(function(){
				loginPassword = md5($("#loginPassword").val());
				url = "bgajax.php?mode=Login&loginpassword=" + loginPassword;
				$.get(url,function(json,status){
					switch(json){
						case "1":
							$("#divLogin").addClass("hidden");
							$("#divselect").removeClass("hidden");
							//$("#canvasDiv").removeClass("hidden");
							//GetConfig();
							break;
						default:
							alert("登陆失败。");
							break;
					}
				});
			})
			$("#emptygift").click(function(){
				url = "bgajax.php?mode=UpdateGiftData&loginpassword=" + loginPassword;
				$.get(url,function(json,status){
					switch(json){
						case "1":
							alert("操作成功。");
							break;
						default:
							alert("操作失败。");
							break;
					}
				});
			})
			$("#emptyuser").click(function(){
				url = "bgajax.php?mode=UpdateUserAllData&loginpassword=" + loginPassword;
				$.get(url,function(json,status){
					switch(json){
						case "1":
							alert("操作成功。");
							break;
						default:
							alert("操作失败。");
							break;
					}
				});
			})
			$("#resetusergift").click(function(){
				url = "bgajax.php?mode=UpdateUserGiftData&loginpassword=" + loginPassword;
				$.get(url,function(json,status){
					switch(json){
						case "1":
							alert("更新成功。");
							break;
						default:
							alert("更新失败。");
							break;
					}
				});
			})
			$("#btnvisit").click(function(){
				
				$("#divselect").addClass("hidden");
				$("#canvasDiv").removeClass("hidden");
				GetConfig();
				
			})
			$("#btngetgift").click(function(){
				$("#divselect").addClass("hidden");
				$("#giftcount").removeClass("hidden");
				///奖品数量的获取
				ShowGiftData()
			})
			/* $("#btnexport").click(function(){
				window.open("excel.php?loginpassword=" + loginPassword);
			}) */
			$("#visitreturn").click(function(){
				
				$("#canvasDiv").addClass("hidden");
				$("#divselect").removeClass("hidden");
				
			})
			$("#giftreturn").click(function(){
				$("#giftcount").addClass("hidden");
				$("#divselect").removeClass("hidden");
			})
			$("#btnsearchname").click(function(){//点击搜索，根据姓名查找
				searchtype=$("#searchtype").val();
				searchtext=$("#searchname").val();
				if(searchtext==""){
					Message("搜索文字不能为空");
					return;
				}
				$("#salerslist").html("");
				url = "manageajax.php?";
				url += "mode=getsearchsalername&currentpage=1&type="+searchtype+"&searchtext="+$("#searchname").val();
				url += "&loginpassword=" + loginPassword;
				$.get(url,function(json,status){
					Settings.PageMode = "getsearchsalername";
					BuildList("salerslist",json,parseInt($("#searchtype").val()));
				});
			
			})
		
			/* $("#totaluseexport").click(function(){
				window.open("useexcel.php?loginname=" + loginName + "&loginpassword=" + loginPassword);
			}); */
			$("#btngiftgot").click(function(){//优惠券发放
				ShowProvidedList();
			})
			$("#btngiftuse").click(function(){//优惠券使用
				Showtotaluse();
			})
			$("#btnsalers").click(function(){//人员审核
				//区域赋值
				
				InitCheckList();//初始化列表
				$("#divselect").addClass("hidden");
				$("#divsalersList").removeClass("hidden");
			})
			$("#btnReturn_salers").click(function(){
				$("#kkpager1").html("");
				$("#search").val("");
				$("#divsalersList").addClass("hidden");
				$("#divselect").removeClass("hidden");
			})
			$("#btnReturn_totalUsed").click(function(){
				$("#divtotalUsed").addClass("hidden");
				$("#divselect").removeClass("hidden");
			})
			
			$("#btnReturn_Provided").click(function(){
				$("#divProvided").addClass("hidden");
				$("#divselect").removeClass("hidden");
			})
		
			$("#btnReturn_totaluseDetail").click(function(){
				$("#divtotalUsed").removeClass("hidden");
				$("#divtotaluseDetail").addClass("hidden");
			})
		
			$("#totaluse1").click(function(){
				ShowtotaluseDetail(1);
			});
			$("#totaluse2").click(function(){
				ShowtotaluseDetail(2);
			});
			$("#totaluse3").click(function(){
				ShowtotaluseDetail(3);
			});
			$("#totaluse").click(function(){
				ShowtotaluseDetail(0);
			});
		
			$("#pget1").click(function(){
				ShowProvidedDetail(1);
			});
			$("#pget2").click(function(){
				ShowProvidedDetail(2);
			});
			$("#pget3").click(function(){
				ShowProvidedDetail(3);
			});
			$("#pget").click(function(){
				ShowProvidedDetail(0);
			});
			
			$("#btnReturn_ProvidedDetail").click(function(){
				$("#divProvided").removeClass("hidden");
				$("#divProvidedDetail").addClass("hidden");
			});
		}
		function Showtotaluse(){
			$("#divselect").addClass("hidden");
			$("#divtotalUsed").removeClass("hidden");
			url = "manageajax.php?mode=GetUsedtotal";
			url += "&loginpassword=" + loginPassword;
			$.get(url,function(json){
				var data=eval("("+json+")");
				$("#count1").html(data.usedcount1);
				$("#count2").html(data.usedcount2);
				$("#count3").html(data.usedcount3);
	
			});
		}
		function ShowtotaluseDetail(totalLevel){
			$("#divtotalUsed").addClass("hidden");
			$("#divtotaluseDetail").removeClass("hidden");
			if(totalLevel == 0)
				$("#totalgiftlevel").html("");
			else
				$("#totalgiftlevel").html(totalLevel);
			
			url = "manageajax.php?mode=GetTotalGiftDetail&giftLevel="+totalLevel;
			url += "&loginpassword=" + loginPassword;
			$.get(url,function(json){
				var data=eval("("+json+")");
				if(data==null){
					alert('暂无数据！');
					return;
				}
				strHtml = "";
				for(i=0;i<data.length;i++){
					strHtml += "	<tr>";
					strHtml += "		<td align='center'>"+data[i].giftlevel+"</td>";
					strHtml += "		<td align='center'>"+data[i].nickname+"</td>";
					strHtml += "		<td align='center'><img  src='"+data[i].imgurl+"'"+"style='width:"+50+"px;height:"+50+"px'></td>";
					strHtml += "		<td align='center'>"+data[i].gottime+"</td>";
					strHtml += "		<td align='center'>"+data[i].usetime+"</td>";
					strHtml += "		<td align='center'>"+data[i].salername+"</td>";
					strHtml += "		<td align='center'>"+data[i].salermobile+"</td>";
					strHtml += "		<td align='center'>奖品内容</td>";
					strHtml += "	</tr>";
				}
				$("#totaluseDetailList").html(strHtml);
			});
			
		
		}
		function ShowProvidedDetail(giftLevel){
			$("#divProvided").addClass("hidden");
			$("#divProvidedDetail").removeClass("hidden");
			if(giftLevel == 0)
				$("#providedgiftlevel").html("");
			else
				$("#providedgiftlevel").html(giftLevel);
			
			url = "manageajax.php?mode=GetProvidedDetail&giftLevel="+giftLevel;
			url += "&loginpassword=" + loginPassword;

			$.get(url,function(json){
				var data=eval("("+json+")");
				if(data==null){
					alert('暂无数据！');
					return;
				}
				strHtml = "";
				for(i=0;i<data.length;i++){
						strHtml += "	<tr>";
						strHtml += "		<td align='center'>"+data[i].giftname+"</td>";
						strHtml += "		<td align='center'>"+data[i].gottime+"</td>";
						strHtml += "		<td align='center'><img  src='"+data[i].imgurl+"'"+"style='width:"+50+"px;height:"+50+"px'></td>";
						strHtml += "		<td align='center'>"+data[i].nickname+"</td>";
						strHtml += "	</tr>";
				}
				$("#providedDetailList").html(strHtml);
			});
		}
		function ShowProvidedList(){
			url = "manageajax.php?mode=GetProvidedList";
			url += "&loginpassword=" + loginPassword;
			$.get(url,function(json){
				var data=eval("("+json+")");
				$("#ptotalcount1").html(data.ptotalcount1);
				$("#ptotalcount2").html(data.ptotalcount2);
				$("#ptotalcount3").html(data.ptotalcount3);
				
			
				$("#pselfcount1").html(data.pselfcount1);
				$("#pselfcount2").html(data.pselfcount2);
				$("#pselfcount3").html(data.pselfcount3);
				
				
			});
			$("#divselect").addClass("hidden");
			$("#divProvided").removeClass("hidden");
		}
		
		function pass(id){
			url = "manageajax.php?";
			url += "&mode=passsaler";
			url += "&id=" + id;
			url += "&loginpassword=" + loginPassword;
			$.get(url,function(json,status){
				var data=eval("("+json+")");
				switch(data){
					case 1:
						InitCheckList();
					break;
					case -1:
						alert("操作失败！");
					break;	
				}
			});
		}

		function refuse(id){
			url = "manageajax.php?";
			url += "&mode=refusesaler";
			url += "&id=" + id;
			url += "&loginpassword=" + loginPassword;
			$.get(url,function(json,status){
				var data=eval("("+json+")");
				switch(data){
					case 1:
						InitCheckList();
					break;
					case -1:
						alert("操作失败！");
					break;	
				}
			});
		}
		
		function update(id){
			url = "manageajax.php?";
			url += "&mode=updatesaler";
			url += "&id=" + id;
			url += "&loginpassword=" + loginPassword;
			$.get(url,function(json,status){
				var data=eval("("+json+")");
				switch(data){
					case 1:
						InitPassList();
						InitRefuseList();
					break;
					case -1:
						alert("操作失败！");
					break;	
				}
			});
		}

		function ShowAllowedList(){
			InitPassList();
			$("#typesaler").html("已通过人员列表");
			$("#searchtype").val(1);
			$("#search").val("");
		}

		function ShowRefusedList(){
			InitRefuseList();
			$("#typesaler").html("已拒绝人员列表");
			$("#searchtype").val(-1);
			$("#search").val("");
		}
		
		
		function InitRefuseList(){
			$("#salerslist").html("");
			url = "manageajax.php?";
			url += "mode=getsalerinfo&type=-1&currentpage=1";
			url += "&loginpassword=" + loginPassword;
			$.get(url,function(json,status){
				Settings.PageMode = "getsalerinfo";
				BuildList("salerslist",json,-1);
			});
		}

		function InitPassList(){
			$("#salerslist").html("");
			url = "manageajax.php?";
			url += "mode=getsalerinfo&type=1&currentpage=1";
			url += "&loginpassword=" + loginPassword;
			$.get(url,function(json,status){
				Settings.PageMode = "getsalerinfo";
				BuildList("salerslist",json,1);
			});
		}

		function InitCheckList(){
			$("#searchtype").val(0);
			$("#search").val("");
			$("#typesaler").html("未审核人员列表");
			$("#salerslist").html("");
			url = "manageajax.php?";
			url += "mode=getsalerinfo&type=0&currentpage=1";
			url += "&loginpassword=" + loginPassword;
			$.get(url,function(json,status){
				Settings.PageMode = "getsalerinfo";
				BuildList("salerslist",json,0);
			});
			
		}
		
		function BuildList(containerID , json , type){
			if(json == "" || json == "null"){
				dataPaging(1,type);
				return;
			}
			data = eval("("+json+")");
			
			if(data==null){
				alert('暂无数据！');
				
				return;
			}
			dataPaging(data[0].pagecount,type);
			c = $("#"+containerID);
			c.html("");
			strHtml = "";
			for(i=0;i<data.length;i++){
				strHtml += "	<tr>";
				strHtml += "		<td align='center'><img  src='"+data[i].imgurl+"'"+"style='width:"+50+"px;height:"+50+"px'><br>昵称："+data[i].nickname+"</td>";
				strHtml += "		<td align='center'>姓名："+data[i].name+"<br>电话："+data[i].mobile+"</td>";
				switch(type){
					case 0:
						strHtml += "		<td align='center'><button class='pure-button pure-button-primary'onclick='pass(" + data[i]["id"] + ")';>通过</button><button class='pure-button pure-button-primary' onclick='refuse(" + data[i]["id"] + ")';>拒绝</button></td>";
						break;
					case 1:
						strHtml += "		<td align='center'><button class='pure-button pure-button-primary' onclick='update(" + data[i]["id"] + ")'>重新审核</button></td>";
						break;
					case -1:
						strHtml += "		<td align='center'><button class='pure-button pure-button-primary' onclick='update(" + data[i]["id"] + ")'>重新审核</button></td>";
						break;
				}
				strHtml += "	</tr>";
			}
			c.append(strHtml);
		}
		function GetConfig(){
			$.post("bgajax.php?mode=GetConfig&loginpassword=" + loginPassword, function(data){	
					if(data==""){
						alert("服务器配置有误，请与管理员联系！");
						return;
					}
					data = eval("(" + data + ")");
					//console.log(data);
					for(i=0;i<data.length;i++){	
						strHtml = '<div id="'+data[i].name+'"></div> ';
						$("#canvasDiv").append(strHtml);
						$("#"+data[i].name).html(data[i].title+"&nbsp;&nbsp;&nbsp;&nbsp;加载中。。。").css({"text-align":"center","fontSize":OffsetLeftFullScreen(15),"color":"#8B0000"});
						PageData(data[i].chart,data[i].mode,data[i].name,data[i].title);
					}
				}
			);
		}
		
		function PageData(chart,mode,name,title){
			switch(chart){
				case "line":
					var DataView_value=[],DataView_labels=[],DataView_total=0;
					$.post("bgajax.php?mode="+mode+"&loginpassword=" + loginPassword, function(data){	
							data = eval("(" + data + ")");
							if(data==null){
								$("#"+name).html(title+"&nbsp;&nbsp;&nbsp;&nbsp;暂无数据").css({"text-align":"center","fontSize":OffsetLeftFullScreen(15),"color":"#8B0000"});
								return;
							}
							
							// console.log(data);
							for(i=0;i<data.length;i++){	
								DataView_total=parseInt(data[i].value)+DataView_total;
								pvalue=data[i].value;
								DataView_value.push(pvalue);
								DataView_labels.push(data[i].title);
							}
							ViewLineBasic2D(name,title+"【"+DataView_total+"人】",DataView_value,DataView_labels);
						}
					);
					break;
				case "pie":
					var DataView_total=0;
					$.post("bgajax.php?mode="+mode+"&loginpassword=" + loginPassword, function(data){	
							data = eval("(" + data + ")");
							if(data==null){
								$("#"+name).html(title+"&nbsp;&nbsp;&nbsp;&nbsp;暂无数据").css({"text-align":"center","fontSize":OffsetLeftFullScreen(15),"color":"#8B0000"});
								return;
							}
							
							var newdata = [];
							for(var i=0;i<data.length;i++){
								DataView_total=parseInt(data[i].value)+DataView_total;
								var d = {};
								d.name = data[i].title;
								pvalue=data[i].value;
								d.value = pvalue;
								if(colors[i])
									d.color = colors[i];
								newdata.push(d);
							}
							ViewPie2D(name,title+"【"+DataView_total+"人】",newdata);
						}
					);
					break;
				case "bar":
					var DataView_total=0;
					$.post("bgajax.php?mode="+mode+"&loginpassword=" + loginPassword, function(data){	
							data = eval("(" + data + ")");
							if(data==null){
								$("#"+name).html(title+"&nbsp;&nbsp;&nbsp;&nbsp;暂无数据").css({"text-align":"center","fontSize":OffsetLeftFullScreen(15),"color":"#8B0000"});
								return;
							}
							
							var newdata = [];
							for(var i=0;i<data.length;i++){
								DataView_total=parseInt(data[i].value)+DataView_total;
								var d = {};
								d.name = data[i].title;
								pvalue=data[i].value;
								d.value = pvalue;
								if(colors[i])
									d.color = colors[i];
								newdata.push(d);
							}
							ViewBar2D(name,title+"【"+DataView_total+"人】",newdata);
						}
					);
					break;
				
			} 
			
		}
		
		 
		function bar2D(name,title,newdata){		
			new iChart.Column2D({
					render : name,
					data: newdata,
					title : title,
					//showpercent:true,
					//decimalsnum:2,
					//animation : true,//开启过渡动画
					//animation_duration:600,//800ms完成动画
					width : 800,
					height : 400,
					coordinate:{
						background_color:'#fefefe',
						scale:[{
							width : 60,
							 start_scale:0,
							
							 /* listeners:{
								parseText:function(t,x,y){
									return {text:t+"%"}
								}
							} */
						}]
					},
				}).draw();
		
		}  
	
		
		function ViewLineBasic2D(name,title,value,labels){		
			//console.log(name);
			//console.log(value);
			//console.log(labels);
			var data = [
						
						{
							name : name,
							value:value,
							color:'#f68f70',
							line_width:2
						}
					 ];
			 
			var chart = new iChart.LineBasic2D({
				render : name,		//图表渲染的HTML DOM的id.
				data: data,				
				align:'center',				
				title : title,
				//animation : true,//开启过渡动画
				//animation_duration:600,//800ms完成动画
				// subtitle : '平均每个人访问2-3个页面(访问量单位：万)',
				// footnote : '数据来源：模拟数据',
				width : ViewWidth,
				height : ViewHeight,
				background_color:'#FEFEFE',
				tip:{		//提示框的配置项.(默认为false)
					enable:true,
					shadow:true,
					move_duration:400,
					border:{				//此处设置了开启边框配置项。
						 enable:true,
						 radius : 5,
						 width:2,
						 color:'#3f8695'
					},
					listeners:{					//事件的配置项。(默认为null)
						 // tip:提示框对象、name:数据名称、value:数据值、text:当前文本、i:数据点的索引
						parseText:function(tip,name,value,text,i){
							return name+"访问量:"+value+"人";	
						}
					}
				},
				tipMocker:function(tips,i){		//当有多条线段(数据)时，可以利用tipMocker将tip整合到一起。作为一个iChart.Tip展示出来。
					return "<div style='font-weight:600'>"+
							labels[i]+" "+//日期
							"</div>"+tips.join("<br/>");
				},
				legend : {		//图例的配置项
					enable : true,
					row:1,//设置在一行上显示，与column配合使用
					column : 'max',
					valign:'top',
					sign:'bar',
					background_color:null,//设置透明背景
					offsetx:-80,//设置x轴偏移，满足位置需要
					border : true
				},
				crosshair:{
					enable:true,
					line_color:'#62bce9'//十字线的颜色
				},
				sub_option : {	//图中折线段的配置项
					label:false,
					point_size:10
				},
				coordinate:{
					width:640,
					height:240,
					axis:{
						color:'#dcdcdc',
						width:1
					},
					scale:[{
						 position:'left',	
						 // start_scale:0,
						 // end_scale:2000,
						 // scale_space:500,
						 // scale_size:2,
						 scale_color:'#9f9f9f'
					},{
						 position:'bottom',	
						 labels:labels
					}]
				}
			});
		
		//开始画图
		chart.draw();
	}
		
		function ViewPie2D(name,title,newdata){
			//console.log(name);
			//console.log(newdata);
			
			new iChart.Pie2D({
				render : name,
				data: newdata,
				title : title,
				legend : {
					enable : true
				},
				showpercent:true,
				decimalsnum:2,
				width : ViewWidth,
				height : ViewHeight,
				radius:140
			}).draw();
		}
		
		function ViewBar2D(name,title,newdata){
			//console.log(name);
			//console.log(newdata);
			
			new iChart.Bar2D({
					render : name,
					data: newdata,
					title : title,
					align:'right',
					// footnote : 'Data from StatCounter',
					width : 800,
					height : 400,
					//animation : true,//开启过渡动画
					//animation_duration:600,//800ms完成动画
					coordinate:{
						width:450,
						height:220,
						scale:[{
							 position:'bottom',	
							 start_scale:0,
							 // end_scale:100,
							 // scale_space:10,
							 // listeners:{
								// parseText:function(t,x,y){
									// return {text:t+"%"}
								// }
							 // }
						}]
					},
					rectangle:{
						listeners:{
							drawText:function(r,t){
								return t+"%";
							}
						}
					}
			}).draw();
		}
		
		
	</script>
</html>