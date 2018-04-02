<?php
	header("Access-Control-Allow-Origin:http://www.wsestar.com");
	include "paras.php";

	$mode = Get("mode");
	$checktoken = Get("checktoken");
	$checksalerid = Get("checksalerid");
	
	$targetTime = date("Y-m-d 00:00:00" , time());
	
	$checksalerinfo = DBGetDataRowByField("salers","id",$checksalerid);
	if($checksalerinfo == null)
		die("1");
	if($checksalerinfo["status"] != 1)
		die("2");

	$checksaleropenid=$checksalerinfo["openid"];
	$strcheckopenid = substr($checksaleropenid, 0, 10);
	$salerflag=false;
	for($i=0;$i<11;$i++){//10分钟之内
		$strnow = date("YmdHi", time()-60*$i);
		$tokenpara = md5($checksalerid.$strcheckopenid.$strnow);
		if($checktoken==$tokenpara){
			$salerflag = true;
			break;
		}
	}
	if($salerflag!=true){
		die("3");
	}
	switch($mode){	
		//核销数据
		case "showuserinfo"://显示用户信息
			$id = (int)(Get("id"));
			$strSql = " SELECT c.nickname,c.imgurl,g.giftlevel,g.giftname, s.name as salername,s.mobile as salermobile,";
			$strSql .= " g.gottime,g.usetime ";
			$strSql .= " FROM `giftdetail` g  ";
			$strSql .= " left join custinfo c on g.gotterid=c.id ";
			$strSql .= " left join salers s on g.usesaler = s.id ";
			$strSql .= " WHERE g.gotterid=$id and g.gifttime='$targetTime' ";
			$result = DBGetDataRow($strSql);
			echo json_encode($result);
			break;
		case "comfirmsale":	//确认核销
			$id = (int)(Get("id"));
			$giftinfo = DBGetDataRowByField("giftdetail",array("gotterid","gifttime"),array($id,$targetTime));
			$giftid=$giftinfo["id"];
			$p = DBUpdateField("giftdetail" , $giftid , array("isused","usetime","usesaler") ,array(1,$DB_FUNCTIONS["now"],$checksalerid));
			if(!$p)
				echo -1;
			else
				echo 1;
			break;	
	}
?>