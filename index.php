<?php
	include "paras.php";
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
	
	if($userInfo==null){//没有找到数据
		$userId = DBInsertTableField("custinfo",array("openid","nickname","imgurl"), array($openid,$nickname,$headimgurl));
	}else{
		$userId=$userInfo["id"];
	}
	
	//$visitid = InitVisitidV3();
	$visitid = -1;
	$visitid = VisitHistoryV4($openid,$visitid,"index.php",$inviter,$ua,$publisher);//在visithistory表中插入访问数据

	/* $stropenid = substr($openid, 0, 10);
	$token = md5($stropenid.$userId); 
	
	$stropenid = substr($openid, 0, 10);
	$strdate = date("YmdHi", time());
	$BarCodePara = md5($userId.$stropenid.$strdate);//二维码参数
	$BarCodePara = substr($BarCodePara, 0, 10); */
	
	/* $isgot=0;
	$targetTime =  date("Y-m-d 00:00:00" , time());
	$isgotinfo = DBGetDataRowByField("gifthistory" ,array("userid","gotdate","isgot"), array($userId,date('Y-m-d'),1));
	if($isgotinfo!=null){
		$isgot=1;
	}  */
	
	$imgPath = "img/";
	

?>
