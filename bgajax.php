<?php
	include "paras.php";
	
	if(!defined("ONLINE_TIME"))
		define("ONLINE_TIME","2016-11-30");
	if(!defined("PASSWORD"))
		define("PASSWORD","admin");
	$perpage = 50;
	$mode = Get("mode");
	$loginpassword = Get("loginpassword");
	if($loginpassword!=md5(PASSWORD)){
		die();
	}

	$config = array();
	$c = array();
	$c["name"] = "DaysVisitLine";
	$c["mode"] = "DaysVisitLine";
	$c["title"] = "分日访问状况";
	$c["chart"] = "line";
	array_push($config,$c);
	
	$c = array();
	$c["name"] = "HoursVisitLine";
	$c["mode"] = "HoursVisitLine";
	$c["title"] = "分时访问状况";
	$c["chart"] = "line";
	array_push($config,$c);
	
	$c = array();
	$c["name"] = "DaysUserJoinLine";
	$c["mode"] = "DaysUserJoinLine";
	$c["title"] = "分日用户加入（初次访问）";
	$c["chart"] = "line";
	array_push($config,$c);
	
	$c = array();
	$c["name"] = "HoursUserJoinLine";
	$c["mode"] = "HoursUserJoinLine";
	$c["title"] = "分时用户加入（初次访问）";
	$c["chart"] = "line";
	array_push($config,$c);
	
	
	/* $c = array();
	$c["name"] = "DaysShareLine";
	$c["mode"] = "DaysShareLine";
	$c["title"] = "分日用户分享";
	$c["chart"] = "line";
	array_push($config,$c);
	
	$c = array();
	$c["name"] = "HoursShareLine";
	$c["mode"] = "HoursShareLine";
	$c["title"] = "分时用户分享";
	$c["chart"] = "line";
	array_push($config,$c); */
	
	
	$c = array();
	$c["name"] = "FromUrlPie";
	$c["mode"] = "FromUrlPie";
	$c["title"] = "用户访问来源";
	$c["chart"] = "bar";
	array_push($config,$c);
		
	/* $c = array();
	$c["name"] = "ShareTargetPie";
	$c["mode"] = "ShareTargetPie";
	$c["title"] = "用户分享行为";
	$c["chart"] = "bar";
	array_push($config,$c); */
	
	/* $c = array();
	$c["name"] = "DaysGotLine";
	$c["mode"] = "DaysGotLine";
	$c["title"] = "分日抽取奖品人数";
	$c["chart"] = "line";
	array_push($config,$c);
	
	$c = array();
	$c["name"] = "HoursGotLine";
	$c["mode"] = "HoursGotLine";
	$c["title"] = "分时抽取奖品人数";
	$c["chart"] = "line";
	array_push($config,$c); */

	
	$c = array();
	$c["name"] = "Before24HoursVisitLine";
	$c["mode"] = "Before24HoursVisitLine";
	$c["title"] = "过去24小时的访问量";
	$c["chart"] = "line";
	array_push($config,$c);
	
	$c = array();
	$c["name"] = "Before1HoursVisitLine";
	$c["mode"] = "Before1HoursVisitLine";
	$c["title"] = "过去1小时的访问量";
	$c["chart"] = "line";
	array_push($config,$c);
	
	
	switch($mode){
		case "Login"://登录
			echo 1;
			break;
		case "GetConfig":
			echo json_encode($config);
			break;
		case 'DaysVisitLine'://分日，折线图//visithistory
			$strSql= " select date_format(visittime,'%Y-%m-%d') as title,count(*) as value from visithistory ";
			$strSql.= " where  visittime >= '".ONLINE_TIME."' ";
			$strSql.= " group by date_format(visittime,'%Y-%m-%d') order by date_format(visittime,'%Y-%m-%d') asc ";
			$result = DBGetDataRowsSimple($strSql);
			if($result!=null){
				$result = FillDate($result);
			}
			echo json_encode($result);
			break;
		case 'HoursVisitLine'://分时，折线图//visithistory
			$strSql= " select date_format(visittime,'%H') as title,count(*) as value from visithistory  ";
			$strSql.= " where visittime >= '".ONLINE_TIME."' ";
			$strSql.= " group by date_format(visittime,'%H') order by date_format(visittime,'%H') asc ";
			$result = DBGetDataRowsSimple($strSql);
			if($result!=null){
				$result = FillHour($result);
			}
			echo json_encode($result);
			break;
		case 'DaysUserJoinLine'://分日，折线图//custinfo
			$strSql= " select date_format(createtime,'%Y-%m-%d') as title,count(*) as value from custinfo ";
			$strSql.= " where  createtime >= '".ONLINE_TIME."' ";
			$strSql.= " group by date_format(createtime,'%Y-%m-%d') order by date_format(createtime,'%Y-%m-%d') asc ";
			$result = DBGetDataRowsSimple($strSql);
			if($result!=null){
				$result = FillDate($result);
			}
			echo json_encode($result);
			break;
		case 'HoursUserJoinLine'://分时，折线图//custinfo
			$strSql= " select date_format(createtime,'%H') as title,count(*) as value from custinfo  ";
			$strSql.= " where createtime >= '".ONLINE_TIME."' ";
			$strSql.= " group by date_format(createtime,'%H') order by date_format(createtime,'%H') asc ";
			$result = DBGetDataRowsSimple($strSql);
			if($result!=null){
				$result = FillHour($result);
			}
			echo json_encode($result);
			break;
		/* case 'DaysShareLine'://分日，折线图//分享
			$strSql= " select date_format(visittime,'%Y-%m-%d') as title,count(*) as value from actionhistory ";
			$strSql.= " where  visittime >= '".ONLINE_TIME."' ";
			$strSql.= " group by date_format(visittime,'%Y-%m-%d') order by date_format(visittime,'%Y-%m-%d') asc ";
			$result = DBGetDataRowsSimple($strSql);
			if($result!=null){
				$result = FillDate($result);
			}
			echo json_encode($result);
			break;
		case 'HoursShareLine'://分时，折线图//分享
			$strSql= " select date_format(visittime,'%H') as title,count(*) as value from actionhistory  ";
			$strSql.= " where visittime >= '".ONLINE_TIME."' ";
			$strSql.= " group by date_format(visittime,'%H') order by date_format(visittime,'%H') asc ";
			$result = DBGetDataRowsSimple($strSql);
			if($result!=null){
				$result = FillHour($result);
			}
			echo json_encode($result);
			break;	 */
		case 'FromUrlPie'://进入来源
			$strSql= " select visiturl as title,count(*) as value from visithistory ";
			$strSql.= " where  visittime >= '".ONLINE_TIME."' ";
			$strSql.= " group by visiturl ";
			$result = DBGetDataRowsSimple($strSql);
			echo json_encode($result);
			break;
		/* case 'ShareTargetPie'://分享途径
			$strSql= " select action as title ,count(*) as value from actionhistory ";
			$strSql.= " where  visittime >= '".ONLINE_TIME."' ";
			$strSql.= " group by action ";
			$result = DBGetDataRowsSimple($strSql);
			echo json_encode($result);
			break; */
		case 'Before24HoursVisitLine':
			$strSql= " select date_format(visittime,'%H') as title,count(*) as value from visithistory ";
			$strSql.= " where visittime > concat(date_format(date_add(now(),interval -24 hour),'%Y/%m/%d %H'),':00:00')  ";
			$strSql.= " group by date_format(visittime,'%H') order by  date_format(visittime,'%Y/%m/%d %H')  ";
			$result = DBGetDataRowsSimple($strSql);
			if($result!=null){
				$result = FillHourAdd($result);
			}
			echo json_encode($result);
			break;
		 case 'Before1HoursVisitLine':
			$strSql= " select date_format(visittime,'%i') as title,count(*) as value from visithistory ";
			$strSql.= " where unix_timestamp(visittime)>=unix_timestamp(now())-3600 ";
			$strSql.= " group by date_format(visittime,'%i') order by date_format(visittime,'%Y/%m/%d %H:%i')  ";
			$result = DBGetDataRowsSimple($strSql);
			if($result!=null){
				$result = FillMinute($result);
			}
			echo json_encode($result);
			break;	
		case 'ShowUserList':
			$currentpage = Get("currentpage");
			$currentpage=$currentpage-1;
			$p=$currentpage*$perpage;
			$strSql = " select * from custinfo ";
			$strSql.= " order by createtime desc ";
			$strSql .= " limit $p,$perpage";
			$detail = DBGetDataRowsSimple($strSql);
			$strSql= "select  count(*) as total from custinfo ";
			$result = DBGetDataRow($strSql);
			$detailInfo['data']=$detail;
			$detailInfo['total']=$result['total'];
			$detailInfo["pagecount"]=ceil($detailInfo["total"]/$perpage);
			$detailInfo["perpage"]=$perpage;
			echo json_encode($detailInfo);
			break;
		
		case 'ShowUserData':
			$userid = Get("userid");
			$strSql= " select c.imgurl,c.nickname,d.clickcount,d.clicktime  from clickhistory d ";
			$strSql.= " left join custinfo c on d.userid=c.id ";
			$strSql.= " where d.userid=$userid ";
			$results = DBGetDataRows($strSql);	
			echo json_encode($results);			
			break;
		
	}
	
	function FillMinute($arr){//填充分钟。3分钟间隔
		$new=array();
		$standard=date('i');//当前小时的分钟数
		for($i=$standard;$i<60;$i++){//上一小时的当前分钟-59
			$h = str_pad($i,2,'0',STR_PAD_LEFT);
			$found = false;
			for($j=0;$j<count($arr);$j++){
				if($arr[$j]["title"] == $h){
					$found = true;
					$anew = array();
					$anew["title"] = $arr[$j]["title"];
					$anew["value"] = $arr[$j]["value"];
					array_push($new,$anew);
				}
			}
			if(!$found){
				$a = array();
				$a["title"] = $h;
				$a["value"] = 0;
				array_push($new,$a);
			} 
		}
		for($i=0;$i<$standard;$i++){//当前小时的0分-前一分钟
			$h = str_pad($i,2,'0',STR_PAD_LEFT);
			$found = false;
			for($j=0;$j<count($arr);$j++){
				if($arr[$j]["title"] == $h){
					$found = true;
					$bnew = array();
					$bnew["title"] = $arr[$j]["title"];
					$bnew["value"] = $arr[$j]["value"];
					array_push($new,$bnew);
				}
			}
			if(!$found){
				$b = array();
				$b["title"] = $h;
				$b["value"] = 0;
				array_push($new,$b);
			}
		}
		$arrResult = array();
		$timeSpan = 3;
		for($i=0;$i<count($new);$i+=$timeSpan){
			$t = array();
			$t["title"] = $new[$i]["title"]."分";
			$t["value"] = 0;
			for($j=0;$j<$timeSpan;$j++)
				$t["value"] += $new[$i+$j]["value"];
			array_push($arrResult , $t);
		}
		return $arrResult;
	}
	function FillHourAdd($arr){//填充小时
		$new=array();
		$standard=date('H');//当前的小时数
		for($i=$standard;$i<24;$i++){//昨天某小时-23时
			$h = str_pad($i,2,'0',STR_PAD_LEFT);
			$found = false;
			for($j=0;$j<count($arr);$j++){
				if($arr[$j]["title"] == $h){
					$found = true;
					$anew = array();
					$anew["title"] = $arr[$j]["title"];
					$anew["value"] = $arr[$j]["value"];
					array_push($new,$anew);
				}
			}
			if(!$found){
				$a = array();
				$a["title"] = $h;
				$a["value"] = 0;
				array_push($new,$a);
			} 
		}
		for($i=0;$i<$standard;$i++){//今天的0-前一个小时
			$h = str_pad($i,2,'0',STR_PAD_LEFT);
			$found = false;
			for($j=0;$j<count($arr);$j++){
				if($arr[$j]["title"] == $h){
					$found = true;
					$bnew = array();
					$bnew["title"] = $arr[$j]["title"];
					$bnew["value"] = $arr[$j]["value"];
					array_push($new,$bnew);
				}
			}
			if(!$found){
				$b = array();
				$b["title"] = $h;
				$b["value"] = 0;
				array_push($new,$b);
			} 	
		}
		$arrResult = array();
		for($i=0;$i<count($new);$i++){
			$t = array();
			$t["title"] = ($new[$i]["title"]+1)."点";
			$t["value"] = $new[$i]["value"];
			array_push($arrResult , $t);
		} 
		return $arrResult;
	}
	function FillHour($arr){//填充小时
		for($i=0;$i<24;$i++){
			$h = str_pad($i,2,'0',STR_PAD_LEFT);
			$found = false;
			for($j=0;$j<count($arr);$j++){
				if($arr[$j]["title"] == $h){
					$found = true;
				}
			}
			if(!$found){
				$a = array();
				$a["title"] = $h;
				$a["value"] = 0;
				array_push($arr,$a);
			}
		}
		$title = array();
		$value = array();
		foreach ($arr as $key => $row){ 
			$title[$key]  = $row['title']; 
			$value[$key] = $row['value']; 
		} 
		array_multisort($title, SORT_ASC, $value, SORT_ASC, $arr);//升序
		$arrResult = array();
		for($i=0;$i<count($arr);$i++){
			$t = array();
			$t["title"] = $arr[$i]["title"]."点";
			$t["value"] = $arr[$i]["value"];
			array_push($arrResult , $t);
		} 
		return $arrResult;
	}
	function FillDate($arr){//填充日期
		$days=prDates(ONLINE_TIME,date('Y-m-d'));//所有显示的日期数据
		for($i=0;$i<count($days);$i++){
			$d = str_pad($days[$i],2,'0',STR_PAD_LEFT);
			$found = false;
			for($j=0;$j<count($arr);$j++){
				if($arr[$j]["title"] == $d){
			
					$found = true;
				}
			}
			if(!$found){
				$a = array();
				$a["title"] = $d;
				$a["value"] = 0;
				array_push($arr,$a);
			}
		}
		$title = array();
		$value = array();
		foreach ($arr as $key => $row){ 
			$title[$key]  = $row['title']; 
			$value[$key] = $row['value']; 
		} 
		array_multisort($title, SORT_ASC, $value, SORT_ASC, $arr);//升序
		return $arr;
	}
	function prDates($start,$end){ // 两个日期之间的所有日期 
		$p=array();
		$dt_start = strtotime($start);//转为日期格式  
		$dt_end = strtotime($end);  
		while ($dt_start<=$dt_end){  
			//echo date('Y-m-d',$dt_start).",";  
			array_push($p,date('Y-m-d',$dt_start));
			$dt_start = strtotime('+1 day',$dt_start); 
		} 
		return $p;
	}  
	
	
?>