<?php
	include "paras.php";
	$mode = Get("mode");
	
	$userId = Get("userid");
	/* $token = Get("token");
	if($userId!=""){
		$userinfo = DBGetDataRowByField("custinfo" ,'id', $userId);
		if(!isset($_SESSION["stropenid"])){//session中是否存在数据
			$_SESSION["stropenid"]=$userinfo["openid"];
		}
		$checktoken = md5(substr($_SESSION["stropenid"], 0, 10).$userId);
		if($checktoken!=$token){
			die("-8");
		}  
	}
	$giftRates = array(//设置百分比
		"2016-12-06 00:00:00" => 15,
		"2016-12-07 00:00:00" => 15,
		"2016-12-08 00:00:00" => 15,
		"2016-12-09 00:00:00" => 14,
		"2016-12-10 00:00:00" => 9,
		"2016-12-11 00:00:00" => 9
	);
	$giftClickLevels = array(array("min"=>10,"giftlevel"=>1),array("min"=>5,"giftlevel"=>2),array("min"=>1,"giftlevel"=>3)); */
	switch($mode){
		case "RecordResult":
			$clickcount = Get("clickcount");
//只记录用户的击中数量	
			$r=DBInsertTableField("clickhistory",array("userid","clickcount","clicktime"),array($userId,$clickcount,$DB_FUNCTIONS["now"]));
			if($r<=0)
				echo -1;
			else
				echo 1;
			break;
		
		
		/* case "GetGift":
			if(!isset($giftRates[$targetTime])){
				die("-99");
			}
			$clickcount = Get("clickcount");
			if($clickcount==0){//未中奖
				//插入一条未中奖结果数据
				$r=DBInsertTableField("gifthistory",array("userid","gotdate","isgot"),array($userId,date('Y-m-d'),0));
				if($r<=0)
					die("-1");
				die("-99");//未中奖
			}
			$targetTime = date("Y-m-d 00:00:00" , time());
			$strSql = "Select giftlevel , giftcount as total , gotcount as got , giftcount - gotcount as count from giftcount where gifttime = '$targetTime' and giftcount - gotcount>0 order by giftlevel asc ";
			$giftLevels = DBGetDataRows($strSql);
			
//当天奖池的所有奖品数量信息			
			if($giftLevels == null){//当天时间未设置奖品
				//插入一条未中奖结果数据
				$r=DBInsertTableField("gifthistory",array("userid","gotdate","isgot"),array($userId,date('Y-m-d'),0));
				if($r<=0)
					die("-1");
				die("-99");//未中奖
			}
		
//		
			$giftCount = 0;
			for($i=0;$i<count($giftLevels);$i++){
				$giftCount += $giftLevels[$i]["count"];//当天奖池剩余奖品总数
			}
			
			
			if($giftCount == 0){//当天奖池中奖品已经抽完
				//插入一条未中奖结果数据
				$r=DBInsertTableField("gifthistory",array("userid","gotdate","isgot"),array($userId,date('Y-m-d'),0));
				if($r<=0)
					die("-1");
				die("-99");//未中奖
			}
//设置中奖率
			if($clickcount>0){
				$giftRates[$targetTime]=100;
			}
			
			$rnd = mt_rand(0 , 100);
			if($rnd > $giftRates[$targetTime]){//随机中奖率，超出中奖率
				//插入一条未中奖结果数据
				$r=DBInsertTableField("gifthistory",array("userid","gotdate","isgot"),array($userId,date('Y-m-d'),0));
				if($r<=0)
					die("-1");
				die("-99");//未中奖
			} 
			
			$gotGiftLevel = 0;
			foreach($giftClickLevels as $g){
				if($clickcount >= $g["min"]){
					$gotGiftLevel = $g["giftlevel"];
					break;
				}
			}
			
			
			if($gotGiftLevel == 0){
				//插入一条未中奖结果数据
				$r=DBInsertTableField("gifthistory",array("userid","gotdate","isgot"),array($userId,date('Y-m-d'),0));
				if($r<=0)
					die("-1");
				die("-99");//未中奖
			}
			
			for($i=0;$i<count($giftLevels);$i++){
				if($giftLevels[$i]["giftlevel"] >= $gotGiftLevel){
					$gotGiftLevel = $giftLevels[$i]["giftlevel"];
					break;
				}
			}
			
			
			DBBeginTrans();
			$giftInfo = DBGetDataRowByFieldForUpdate("giftdetail",array("giftlevel","hasgot","gifttime"),array($gotGiftLevel,0,$targetTime));
			
			if($giftInfo == null){//随机的奖品已经发放完
				//插入一条未中奖结果数据
				$r=DBInsertTableField("gifthistory",array("userid","gotdate","isgot"),array($userId,date('Y-m-d'),0));
				if($r<=0)
					AjaxRollBack();
				DBCommitTrans();
				die("-99");//未中奖
			}
		
				
//插入一条中奖结果数据（其他未中奖的返回值，插入未中奖结果数据）	
			$gifthistoryid=DBInsertTableField("gifthistory",array("userid","gotdate","isgot","giftid"),array($userId,date('Y-m-d'),1,$giftInfo["id"]));
			if($gifthistoryid<=0)
				AjaxRollBack();
				
			if(!DBUpdateField("giftdetail" , $giftInfo["id"] , array("hasgot","gotterid","gifthistoryid","gottime") ,array(1,$userId,$gifthistoryid,$DB_FUNCTIONS["now"])))
				AjaxRollBack();
				
			$strSql = " Update giftcount Set gotcount = gotcount + 1 Where gifttime = '$targetTime' and giftlevel = $gotGiftLevel ";
			if(!DBExecute($strSql))
				AjaxRollBack();
			
			DBCommitTrans();
			echo $giftInfo["giftlevel"];
			die();
			break; */
	

	}
?>