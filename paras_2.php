<?php
	if(!defined("APPID"))
		define("APPID","wx7fa6fd4b94f47973");
	if(!defined("APPSECRET"))
		define("APPSECRET","bd7ec0f1b39c565d46f4082c27fb6400");
	if(!defined("APPNAME"))
		define("APPNAME","wsestarservice");

	/* if(!defined("APPID"))
		define("APPID","wxd15f2060944c23ba");
	if(!defined("APPSECRET"))
		define("APPSECRET","743defb56a6a64852961ce1452a1139d");
	if(!defined("APPNAME"))
		define("APPNAME","mzone029service"); */
	
	if(!defined("URL_BASE"))
		define("URL_BASE","http://www.wsestar.com/test/shot/");
	if(!defined("PATH_FUNCTION"))
		// define("PATH_FUNCTION","../common/functions.V3.php");
		define("PATH_FUNCTION","functions.V4.php");
	if(!defined("PATH_DBACCESS"))
		// define("PATH_DBACCESS","../common/dbaccess.v5.php");
		define("PATH_DBACCESS","dbaccess.v5.php");
	if(!defined("DEBUG"))
		define("DEBUG",false);
	if(!defined("CHECKIN_TIMESPAN"))
		define("CHECKIN_TIMESPAN",180);
	if(!defined("SOCKET_SERVER_URL"))
		define("SOCKET_SERVER_URL","http://www.wsestar.com:8033");
		// define("SOCKET_SERVER_URL","http://115.120.119.158:8060");
		// define("SOCKET_SERVER_URL","http://192.168.0.60:8060");
	
	date_default_timezone_set('Asia/Shanghai');

	include PATH_FUNCTION;
	include PATH_DBACCESS;

	
	$dbms='mysql';     //数据库类型
	$host='localhost'; //数据库主机名
	$dbName='gxshot';    //使用的数据库
	$dbUser='root';      //数据库连接用户名
	$dbPass='lim1hou';          //对应的密码
	//$dbPass='root'; 
	function CheckRights($formName = null){
		if(!isset($_SESSION["uid"]))
			return -20;
		if(!isset($_SESSION["uname"]))
			return -10;

		if($formName == "teacher")
			return 1;
		
		if($_SESSION["uname"] == "admin")
			return 1;

		$managerInfo = DBGetDataRowByField("bgmanager","loginname",$_SESSION["uname"]);
		if($managerInfo == null)
			return -9;
		if($managerInfo["rights"] == "")
			return -7;
		
		if($formName == null)
			return $managerInfo["id"];
			
		$rights = json_decode($managerInfo["rights"],true);
		if(isset($rights[$formName]))
			return $rights[$formName];
		else
			return -7;
	}
	
	function GenerateCheckCode($teacherId , $groupId , $index){
		$p = md5($teacherId) . md5($groupId) . md5($index);
		$p = substr(md5($p),0,10);
		return $p;
	}
	
	function GenerateToken($openid){
		$stropenid = substr($openid, 0, 10);
		$strdate = date("YmdHi", time());
		$BarCodePara = md5($stropenid.$strdate);//二维码参数
		$BarCodePara = substr($BarCodePara, 0, 10);
		
		if(strlen($openid) > 15)
			$t = substr($openid , 5 , 10);
		else
			$t = $openid;
		
		$p = md5($t.$strdate);
		
		return substr($p , 5 , 10);
	}
	
	function CheckToken($openid , $token){
//echo "openid : $openid , token : $token \n";

		if(strlen($openid) > 15)
			$t = substr($openid , 5 , 10);
		else
			$t = $openid;
		
		$hasflag=0;
		
		for($i=0;$i<11;$i++){//10分钟之内
			$strnow = date("YmdHi", time()-60*$i);
			$codepara = md5($t.$strnow);
//myecho($codepara);
			$codepara = substr($codepara, 5, 10);

			if($token == $codepara){//二维码参数和用户数据库数据符合
				return true;
			}
		}
		
		return false;
	}
	
	
	function JsonResult($resultNumber , $dataPart = null , $message = ""){
		$r = array();
		$r["result"] = $resultNumber;
		$r["data"] = $dataPart;
		$r["message"] = $message;
		echo json_encode($r);
		die();
	}
?>