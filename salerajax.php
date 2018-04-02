<?php
	include "paras.php";
	$mode = Get("mode");
	switch($mode){
		case "applysaler"://销售人员申请
			$openid = Get("openid");
			$name = Get("name");
			$mobile = Get("mobile");
			$salerId = Get("userId");
			$arrFields = array("status","name","mobile");
			$arrValues = array(0,$name,$mobile);
			$salerInfo = DBGetDataRowByField("salers","openid",$openid);
			if($salerInfo["mobile"] != "" && $salerInfo["name"] != ""&& $salerInfo["status"] != -1)
				die("-9");
			$r = DBUpdateField("salers" , $salerId , $arrFields ,$arrValues);
			if(!$r){
				echo -1;
			}else{
				echo 1;
			}
			break;
	}

?>