<?php
	include "paras.php";
//$openId ="44";

	$userInfo=null;
	if($openId == ""){
		$arrInfo = InitCustInfoV3();
		$openId = $arrInfo["openid"];
		$nickname=$arrInfo["nickname"];
		$imgurl=$arrInfo["headimgurl"];
	} else{
		$userInfo = DBGetDataRowByField("salers","openid",$openId);
		$nickname=$userInfo["nickname"];
		$imgurl=$userInfo["imgurl"];
		//$nickname='昵称';
//$imgurl="image/a.png";
	}
	if($userInfo == null){//没有进行查找
		$userInfo = DBGetDataRowByField("salers","openid",$openId);
	} 

	if($userInfo == null){//查找数据为空
		$userId = DBInsertTableField("salers",array("openid","nickname","imgurl","status"), array($openId,$nickname,$imgurl,-9));
		$hasReg = 0;
		$status = -9;
	} else {
		$userId = $userInfo["id"];
		$status = $userInfo["status"];
		if($userInfo["name"] == "")
			$hasReg = 0;
		else
			$hasReg = 1;
	} 
?>
<!DOCTYPE html >
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<title>销售员申请</title>
		<link rel="stylesheet" href="style/bgstyle.css" charset="utf-8" />
		<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
	</head>	
	<body>
		<div id="apply" class="float fullScreen">
			<table width="80%" align="center" class="pure-table pure-table-bordered">
				<tr>
					<td align="center" colspan="2">您正在申请成为移动高新营业厅销售人员。</td>
				</tr>
			
				<tr>
					<td>姓名</td>
					<td align="center"><input value="" type="text" id="name" placeholder="请输入姓名"></td>
				</tr>
				<tr>
					<td>电话</td>
					<td align="center"><input value="" type="text" id="mobile" placeholder="请输入手机号"></td>
				</tr>
				<tr>
					<td align="center" colspan="2"><button id="signup" class="pure-button-primary ">提交申请</button></td>
				</tr>
			</table>
		</div>
	</body>
	<script src="js/jquery-1.11.1.min.js" charset="utf-8"></script>
	<script src="js/jquery.common.js" charset="utf-8"></script>
	<script src="http://weixin.wsestar.com/common/script.js" charset="utf-8"></script>

	<script type="text/javascript" >
	
		var openid = "<?php echo $openId; ?>";
		var status = "<?php echo $status; ?>";
		var hasReg = "<?php echo $hasReg; ?>";
		var userId = "<?php echo $userId; ?>";
		
		
		
		window.onload = function(){
			
			BindEvents();
			

			if(hasReg != "0"){
				switch(status){
					case "-1":
						Message("您的申请被驳回，您可以修改信息后重新提交申请。");
						break;
					case "0":
						MessageFix("您已经提交过申请，请等待审核。");
						break;
					case "1":
						MessageFix("您的申请已经通过。<br>用户持二维码进店领取奖品时，使用微信的“扫一扫”功能扫描其二维码进行核销领取即可。");
						break;
				}				
			}
		}
		
		function BindEvents(){
			$("#signup").click(function(){
				name=$("#name").val();
				mobile=$("#mobile").val();
				if(!Check())
				return;
				url = "salerajax.php?";
				url += "mode=applysaler";
				url += "&name=" + name;
				url += "&mobile=" + mobile;
				url += "&openid=" + openid;
				url += "&userId=" + userId;
				$.get(url,function(json,status){
					switch(json){
						case "1":
							MessageFix("申请提交成功，请等待审核。");
							break;
						case "-1":
							Message("服务器忙，请稍候重试。");
							break;
						case "-9":
							Message("您已经提交过申请，请勿重复提交。");
							break;
					}
				});
			})
		}
		function Check(){
			name=$("#name").val();
			mobile=$("#mobile").val();
			if(name == ""){
				Message("请输入姓名！");
				return false;
			}
			
			if(mobile == ""){
				Message("请输入手机号码！");
				return false;
			}
			
			if(!(/^1[34578][0-9]\d{8}|1[3578][01379]\d{8}|1[34578][01256]\d{8}|134[012345678]\d{7}$/.test(mobile))){
				//请输入正确的号码
				Message("请输入正确的手机号码！");
				return false;
			}
			return true;
		}
	</script>
</html>