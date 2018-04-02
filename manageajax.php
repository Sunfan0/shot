<?php
	include "paras.php";
	$perpage = 50;
	$mode = Get("mode");
	$loginName = Get("loginname");
	

	if(!defined("PASSWORD"))
		define("PASSWORD","admin");
	
	
	$loginpassword = Get("loginpassword");
	if($loginpassword!=md5(PASSWORD)){
		die();
	}
	switch($mode){
		case "checklogin":
			echo 1;
			break;
		case "getsearchsalername":
			$type = Get("type");
			$searchtext = Get("searchtext");
			$currentpage = Get("currentpage");
			$currentpage=$currentpage-1;
			$p=$currentpage*$perpage;
			if($type != "-1" && $type != "0" && $type != "1")
				die();
			$detail=array();
			$data=array();
			$strSql= "select  count(*) as total from salers ";
			$strSql .=" Where status = $type  and ( name  like '%" . $searchtext . "%')  ";
			$result = DBGetDataRow ($strSql);
			$data["total"]=$result[0];
			if($data["total"]==0){
				$detail=null;
				echo json_encode($detail);
				die();
			}
			$strSql = " SELECT s.id , s.nickname , s.imgurl , s.name , s.mobile FROM `salers` s  ";
			$strSql .= " Where s.status = $type and ( s.name  like '%" . $searchtext . "%') ";
			//$strSql .= " order by s.name ";
			$strSql .= " limit $p,$perpage ";
			$datas = DBGetDataRows($strSql);
			foreach($datas as $result){
				$data["id"]=$result["id"];
				$data["nickname"]=$result["nickname"];
				$data["imgurl"]=$result["imgurl"];
				$data["name"]=$result["name"];
				$data["mobile"]=$result["mobile"];
				$data["pagecount"]=ceil($data["total"]/$perpage);
				$data["perpage"]=$perpage;
				array_push($detail,$data);
			}
			echo json_encode($detail);
			break;
		case "getsalerinfo"://销售人员列表
			$type = Get("type");
			$currentpage = Get("currentpage");
			$currentpage=$currentpage-1;
			$p=$currentpage*$perpage;
			if($type != "-1" && $type != "0" && $type != "1")
				die();
			
			$detail=array();
			$data=array();
			$strSql= "select  count(*) as total from salers Where status = $type  ";
			$result = DBGetDataRow($strSql);
			
			$data["total"]=$result[0];
			if($data["total"]==0){
				$detail=null;
				echo json_encode($detail);
				die();
			}
			$strSql = " SELECT s.id , s.nickname , s.imgurl , s.name , s.mobile  FROM `salers` s ";
			$strSql .= " Where s.status = $type ";
			//$strSql .= " order by s.name ";
			$strSql .= " limit $p,$perpage";
			$datas = DBGetDataRows($strSql);
			
			foreach($datas as $result){
				$data["id"]=$result["id"];
				$data["nickname"]=$result["nickname"];
				$data["imgurl"]=$result["imgurl"];
				$data["name"]=$result["name"];
				$data["mobile"]=$result["mobile"];
				$data["pagecount"]=ceil($data["total"]/$perpage);
				$data["perpage"]=$perpage;
				array_push($detail,$data);
			}
			echo json_encode($detail);
			die();
			
			break;
		
		case "updatesaler"://重新审核按钮操作
			$id = (int)(Get("id"));
			$infos = DBUpdateField("salers" , $id , array("status") ,array(0));
			if(!$infos)
				echo -1;
			else
				echo 1;
			break;
		case "passsaler":
			$id = (int)(Get("id"));
			$infos = DBUpdateField("salers" , $id , array("status") ,array(1));
			if(!$infos)
				echo -1;
			else
				echo 1;
			break;
		case "refusesaler":
			$id = (int)(Get("id"));
			$infos = DBUpdateField("salers" , $id , array("status") ,array(-1));
			if(!$infos)
				echo -1;
			else
				echo 1;
			break;
			
		/* case "updatesaler"://审核状态更新合并
			$id = (int)(Get("id"));
			$status = Get("status");
			$infos = DBUpdateField("salers" , $id , array("status") ,array($status));
			if(!$infos)
				echo -1;
			else
				echo 1;
			break;	 */
		case "GetProvidedList":
			$result = array();
			$strSql0 = " select giftlevel , sum(giftcount) as cnt from giftcount  group by giftlevel ";
			$data0 = DBGetDataRows($strSql0);//总数
		
			$result["ptotalcount1"] = GetData($data0 , 1) == null ? 0 : GetData($data0 , 1)["cnt"];
			$result["ptotalcount2"] = GetData($data0 , 2) == null ? 0 : GetData($data0 , 2)["cnt"];
			$result["ptotalcount3"] = GetData($data0 , 3) == null ? 0 : GetData($data0 , 3)["cnt"];
	
			$strSql = " select giftlevel , count(*) as cnt from giftdetail where hasgot = 1  group by giftlevel ";
			$data = DBGetDataRows($strSql);//已领取
			$result["pselfcount1"] = GetData($data , 1) == null ? 0 : GetData($data , 1)["cnt"];
			$result["pselfcount2"] = GetData($data , 2) == null ? 0 : GetData($data , 2)["cnt"];
			$result["pselfcount3"] = GetData($data , 3) == null ? 0 : GetData($data , 3)["cnt"];

			echo(json_encode($result));
			break;
	
		case "GetTotalGiftDetail"://显示奖品使用明细
			$giftLevel = Get("giftLevel");
			$strSql = " SELECT g.giftlevel,g.gottime,g.usetime,s.mobile as salermobile,s.name as salername,c.nickname,c.imgurl FROM `giftdetail` g ";
			$strSql .= " left join salers s on g.usesaler = s.id ";
			$strSql .= " left join custinfo c on g.gotterid = c.id ";
			$strSql .= " where g.isused = 1 ";
			if($giftLevel != "0")
				$strSql .= " and g.giftlevel = " . (int)$giftLevel;
			
			$data = DBGetDataRowsSimple($strSql);
			echo(json_encode($data));
			break;
			//
		case "GetProvidedDetail"://显示奖品获取明细
			$giftLevel = Get("giftLevel");
			$strSql = " SELECT g.giftlevel,g.giftname,g.gottime,c.nickname,c.imgurl FROM `giftdetail` g ";
			$strSql .= " left join custinfo c on g.gotterid = c.id ";
			$strSql .= " where g.hasgot = 1 ";
			if($giftLevel != "0")
				$strSql .= " and g.giftlevel = " . (int)$giftLevel;
			$data = DBGetDataRows($strSql);
			if($data == null)
				$data = array();
			echo json_encode($data);
			break;
		case "GetUsedtotal"://所有奖品领取
			$result = array();
			$strSql = " select giftlevel as level , count(*) as cnt from giftdetail where hasgot = 1 and isused = 1 group by giftlevel ";
			$data = DBGetDataRows($strSql);
			$result["usedcount1"] = GetData($data , 1) == null ? 0 : GetData($data , 1)["cnt"];
			$result["usedcount2"] = GetData($data , 2) == null ? 0 : GetData($data , 2)["cnt"];
			$result["usedcount3"] = GetData($data , 3) == null ? 0 : GetData($data , 3)["cnt"];
			echo(json_encode($result));
			break;
		
		} 
	
	function GetData($datas , $k){
		for($i = 0 ; $i < count($datas) ; $i ++){
			if($datas[$i][0] == $k)
				return $datas[$i];
		}
	}
	
?>