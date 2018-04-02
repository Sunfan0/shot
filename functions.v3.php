<?php
	/*if(!defined("APPID"))
		define("APPID","wxd15f2060944c23ba");	//mzone service
	if(!defined("APPSECRET"))
		define("APPSECRET","743defb56a6a64852961ce1452a1139d ");	//mzone service
	if(!defined("APPNAME"))
		define("APPNAME","mzoneservice");	//mzone service*/
	$appid = APPID;
	$appsecret = APPSECRET;
	$appname = APPNAME;

	session_start();
	
	function InitVisitid(){
		$openid = "pre";
		$visitid = 0;
		if(isset($_SESSION["visitid"])){
			$visitid = $_SESSION["visitid"];
			VisitHistoryV2($openid , $visitid);
		} else {
			$visitid = VisitHistoryV2($openid , $visitid);
			$_SESSION["visitid"] = $visitid;
		}

		return $visitid;
	}
	
	function InitVisitidV2(){
		$openid = "InitVisitidV2";
		$visitid = 0;
		if(isset($_SESSION["visitid"])){
			$visitid = $_SESSION["visitid"];
		} else {
			$visitid = VisitHistoryV2($openid , $visitid);
			$_SESSION["visitid"] = $visitid;
		}

		return $visitid;
	}
	function InitVisitidV3($openid = null){
		if($openid == null)
			$openid = "InitVisitidV3";
		$visitid = 0;
		if(isset($_SESSION["visitid"])){
			$visitid = $_SESSION["visitid"];
		} else {
			$visitid = VisitHistoryV2($openid , $visitid);
			$_SESSION["visitid"] = $visitid;
		}

		return $visitid;
	}
	
	function InitOpenid(){
		if(isset($_SESSION["openid"]))
			$openid = $_SESSION["openid"];
		else{
			//ͨ��code���openid
			if (!isset($_GET['code']))
			{
				//����΢�ŷ���code��
				$url = createOauthUrlForCode(GetCurrentURL());
				Header("Location: $url"); 
				die();
			}else
			{
				//��ȡcode�룬�Ի�ȡopenid
				$code = $_GET['code'];
				$openid = getOpenId($code);
				$_SESSION["openid"] = $openid;

				if($openid == null){
					$url = createOauthUrlForCode(GetCurrentURL());
					Header("Location: $url"); 
					die();
				}
			}
		}
		
		return $openid;
	}
	
	
	function InitOpenidV2(){
		if(isset($_SESSION["openid"]))
			$openid = $_SESSION["openid"];
		else{
			//ͨ��code���openid
			if (!isset($_GET['code']))
			{
				//����΢�ŷ���code��
				$url = createOauthUrlForCode(urlencode(GetCurrentURL()));
				Header("Location: $url"); 
				die();
			}else
			{
				//��ȡcode�룬�Ի�ȡopenid
				$code = $_GET['code'];
				$openid = getOpenId($code);
				$_SESSION["openid"] = $openid;

				if($openid == null){
					$url = createOauthUrlForCode(urlencode(GetCurrentURL()));
					Header("Location: $url"); 
					die();
				}
			}
		}
		
		return $openid;
	}
	
	function InitCustInfo(){
		if (!isset($_GET['code'])){
			//����΢�ŷ���code��
			$url = createOauthUrlForInfo(GetCurrentURLNoPara());
			echo $url;
			//die();
			Header("Location: $url"); 
			die();
		} else {
			$code = $_GET['code'];
			$arrInfo = getCustInfo($code);
			$_SESSION["arrInfo"] = $arrInfo;

			if($arrInfo == null){
				$url = createOauthUrlForInfo(GetCurrentURLNoPara());
				Header("Location: $url"); 
				die();
			}
		}
		
		return $arrInfo;
	}
	
	
	function InitCustInfoV2($refresh = false){
		if(isset($_SESSION["arrInfo"]) && $refresh == false){
			$arrInfo = $_SESSION["arrInfo"];
		} else {
			if (!isset($_GET['code'])){
				//����΢�ŷ���code��
				$url = createOauthUrlForInfo(GetCurrentURLNoPara());
				echo $url;
				//die();
				Header("Location: $url"); 
				die();
			} else {
				$code = $_GET['code'];
				$arrInfo = getCustInfo($code);
				if($arrInfo == null){
					$url = createOauthUrlForInfo(GetCurrentURLNoPara());
					echo $url;
					//die();
					Header("Location: $url"); 
					die();
				}
				$_SESSION["arrInfo"] = $arrInfo;

				if($arrInfo == null){
					$url = createOauthUrlForInfo(GetCurrentURLNoPara());
					Header("Location: $url"); 
					die();
				}
			}
		}
		return $arrInfo;
	}
	
	
	
	function InitCustInfoV3($refresh = false){
		if(isset($_SESSION["arrInfo"]) && $refresh == false){
			$arrInfo = $_SESSION["arrInfo"];
		} else {
			if (!isset($_GET['code'])){
				//����΢�ŷ���code��
				$url = createOauthUrlForInfo(GetCurrentURLNoPara());
				echo $url;
				//die();
				Header("Location: $url"); 
				die();
			} else {
				$code = $_GET['code'];
//myecho($code);
				$arrInfo = getCustInfoV2($code);
				if($arrInfo == null){
					$url = createOauthUrlForInfo(GetCurrentURLNoPara());
					echo $url;
					//die();
					Header("Location: $url"); 
					die();
				}
				$_SESSION["arrInfo"] = $arrInfo;

				if($arrInfo == null){
					$url = createOauthUrlForInfo(GetCurrentURLNoPara());
					Header("Location: $url"); 
					die();
				}
			}
		}
		return $arrInfo;
	}
	
	
	
	function InitUnionid($refresh = false){
		$r = Array();
		
		if(isset($_SESSION["openid"]) && isset($_SESSION["unionid"]) && $refresh == false){
			$r["openid"] = $_SESSION["openid"];
			$r["unionid"] = $_SESSION["unionid"];
		}else{
			//ͨ��code���openid
			if (!isset($_GET['code']))
			{
				//����΢�ŷ���code��
				$url = createOauthUrlForCode(GetCurrentURL());
				Header("Location: $url"); 
				die();
			}else
			{
				//��ȡcode�룬�Ի�ȡopenid
				$code = $_GET['code'];
				$r = getUnionid($code);
//				myecho($r);
				$_SESSION["openid"] = $r["openid"];
				$_SESSION["unionid"] = $r["unionid"];

				if($r == null){
					$url = createOauthUrlForCode(GetCurrentURL());
					Header("Location: $url"); 
					die();
				}
			}
		}
		
		return $r;
	}

	function GetOpenidById($id , $tableName = "custinfo"){
		$data = DBGetDataRowByField($tableName , array("id") , array($id));
		if($data == null)
			return null;
		//return explode("," , $data["slogans"]);
		return $data["openid"];
	}
	function GetIdByOpenid($openid , $tableName = "custinfo"){
		$data = DBGetDataRowByField($tableName , array("openid") , array($openid));
		if($data == null)
			return null;
		//return explode("," , $data["slogans"]);
		return $data["id"];
	}
	function IsCustRegisted($openid){
		$data = DBGetDataRowByField("custinfo" , array("openid") , array($openid));
		if($data == null)
			return 0;

		if($data["registtime"] == null)
			return 0;
		else
			return 1;
	}
	
	function resizeImage($im,$maxwidth,$maxheight,$name,$filetype)
	{
		$pic_width = imagesx($im);
		$pic_height = imagesy($im);

		if(($maxwidth && $pic_width > $maxwidth) || ($maxheight && $pic_height > $maxheight))
		{
			$resizewidth_tag = false;
			$resizeheight_tag = false;
			if($maxwidth && $pic_width>$maxwidth)
			{
				$widthratio = $maxwidth/$pic_width;
				$resizewidth_tag = true;
			}

			if($maxheight && $pic_height>$maxheight)
			{
				$heightratio = $maxheight/$pic_height;
				$resizeheight_tag = true;
			}

			if($resizewidth_tag && $resizeheight_tag)
			{
				if($widthratio<$heightratio)
					$ratio = $widthratio;
				else
					$ratio = $heightratio;
			}

			if($resizewidth_tag && !$resizeheight_tag)
				$ratio = $widthratio;
			if($resizeheight_tag && !$resizewidth_tag)
				$ratio = $heightratio;

			$newwidth = $pic_width * $ratio;
			$newheight = $pic_height * $ratio;

			if(function_exists("imagecopyresampled"))
			{
				$newim = imagecreatetruecolor($newwidth,$newheight);//PHPϵͳ����
				imagecopyresampled($newim,$im,0,0,0,0,$newwidth,$newheight,$pic_width,$pic_height);//PHPϵͳ����
			}
			else
			{
				$newim = imagecreate($newwidth,$newheight);
				imagecopyresized($newim,$im,0,0,0,0,$newwidth,$newheight,$pic_width,$pic_height);
			}

			$name = $name.$filetype;
			ImageToFile($newim,$name);
			imagedestroy($newim);
		}
		else
		{
			$name = $name.$filetype;
			ImageToFile($im,$name);
		}
	}
//ʹ�÷�����
//$im=imagecreatefromjpeg("./20140416103023202.jpg");//������ͼƬ�Ĵ淽·��
//$maxwidth="600";//����ͼƬ�������
//$maxheight="400";//����ͼƬ�����߶�
//$name="123";//ͼƬ�����ƣ����ȡ��
//$filetype=".jpg";//ͼƬ����
//resizeImage($im,$maxwidth,$maxheight,$name,$filetype);//��������ĺ���

	function ImageToFile($image , $file){
		$ext = end(explode(".", $file));

        switch ($ext) {
            case "png":
                return imagepng($image, $file);
                break;
            case "jpeg":
                return imagejpeg($image, $file, 100);
                break;
            case "jpg":
                return imagejpeg($image, $file, 100);
                break;
            case "gif":
                return imagegif($image, $file);
                break;
        }
	}

	function ImageCreatFromFile($file){
		$ext = end(explode(".", $file));
        switch ($ext) {
            case "png":
                $image = imagecreatefrompng($file);
                break;
            case "jpeg":
                $image = imagecreatefromjpeg($file);
                break;
            case "jpg":
                $image = imagecreatefromjpeg($file);
                break;
            case "gif":
                $image = imagecreatefromgif($file);
                break;
        }
		
		return $image;
	}
	function GetJsonArray($url,$posts = null)
	{
		$retval = GetUrlContent($url,$posts);

		$Arr=array();
		
		if($retval !== false)
		{
		    $Arr = json_decode($retval,true);
		}

		return $Arr;
	}
	function GetJsonArrayV2($url,$posts = null)
	{
		$retval = GetUrlContentV2($url,$posts);

		$Arr=array();
		
		if($retval !== false)
		{
		    $Arr = json_decode($retval,true);
		}
		return $Arr;
	}

	function GetUrlContent($url,$posts = null,$port = 80)
	{
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); //�൱�ؼ�����仰����curl_exec($ch)���صĽ�����Խ��и�ֵ�������ı������У�json�����ݲ��������û����仰����curl���ص����ݲ����Խ�����Ϊ��ȥ��������json_decode�ȸ�ʽ������
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
		if($port != null)
			curl_setopt($ch, CURLOPT_PORT, $port);
		if($posts != null && $posts != "")
			curl_setopt($ch, CURLOPT_POSTFIELDS, $posts);
		return curl_exec($ch); 
	}
	function GetUrlContentV2($url,$posts = "",$port = 80)
	{
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
		if(strpos($url,"https") !== false)
			$port = 443;
		curl_setopt($ch, CURLOPT_PORT, $port);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $posts);
		curl_setopt($ch,CURLOPT_REFERER, GetCurrentURLNoPara());

		$r =  curl_exec($ch); 

		return $r;
	}

	function GetIP(){ 
		if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) 
			$ip = getenv("HTTP_CLIENT_IP"); 
		else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) 
			$ip = getenv("HTTP_X_FORWARDED_FOR"); 
		else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) 
			$ip = getenv("REMOTE_ADDR"); 
		else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) 
			$ip = $_SERVER['REMOTE_ADDR']; 
		else 
			$ip = "unknown"; 
		
		return($ip); 
	} 
	function GetRefferPage(){
		if(isset($_SERVER['HTTP_REFERER']))
			return $_SERVER['HTTP_REFERER'];
		else
			return "";
	}
	function GetRefferPageNoPara(){
		$t=explode('?',GetRefferPage());
		if(isset($t[0]))
			return $t[0];
		else
			return "";
	}
	function GetRefferPageOnlyPara(){
		$t=explode('?',GetRefferPage());
		if(isset($t[1]))
			return $t[1];
		else
			return "";
	}
	
	function GetCurrentURL(){
		if($_SERVER['QUERY_STRING'] != "")
			return 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
		else
			return 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
	}
	function GetCurrentURLNoPara(){
		return 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
	}
	function GetCurrentURLOnlyPara(){
		return $_SERVER['QUERY_STRING'];
	}
	function GetPosts(){
		return file_get_contents("php://input");
	}
	function GetCurrentPage(){
		return $_SERVER['PHP_SELF'];
	}

	function InsertVisitHistory($page , $openid = ''){
		return VisitHistory($page , GetIP() , GetRefferPage() , GetCurrentURL() , $openid);
	}
	
	function VisitHistoryV2($openid , $visitid , $page = "")
	{
		global $DB_FUNCTIONS;

		$arrFields = array("clientip" , "visitid" , "page" , "openid" , "fromfullurl" , "fromurl" , "fromquery" , "visitfullurl" , "visiturl" , "visitquery" , "visitpost" , "visitpage" , "visittime");
		$arrValues = array();

		array_push($arrValues, GetIP());			//clientip
		array_push($arrValues, $visitid);			//openid
		array_push($arrValues, $page);			//openid
		array_push($arrValues, $openid);			//openid
		array_push($arrValues, GetRefferPage());	//fromfullurl
		array_push($arrValues, GetRefferPageNoPara());	//fromurl
		array_push($arrValues, GetRefferPageOnlyPara());	//fromquery
		array_push($arrValues, GetCurrentURL());	//visitfullurl
		array_push($arrValues, GetCurrentURLNoPara());	//visiturl
		array_push($arrValues, GetCurrentURLOnlyPara());	//visitquery
		array_push($arrValues, GetPosts());	//visitpost
		array_push($arrValues, GetCurrentPage());	//visitpage
		array_push($arrValues, $DB_FUNCTIONS["now"]);	//visittime
//error_log(var_export($arrValues, true));
//$strSql = DBBuildInsertTableField("visithistory" , $arrFields , $arrValues);
//myecho($strSql);
		return DBInsertTableField("visithistory" , $arrFields , $arrValues);

		return;
		global $max_query_per_minute;
		$hasnumber = 0;
		$con = DBOpen();

		$strSql = sprintf("INSERT INTO `visithistory`(`clientip`, `openid`, `fromurl`, `visiturl`, `visitpage`, `visittime`) VALUES ('%s' , '%s' , '%s' , '%s' , '%s' , now())",
			mysql_real_escape_string($ip),
			mysql_real_escape_string($openid),
			mysql_real_escape_string($fromurl),
			mysql_real_escape_string($visiturl),
			mysql_real_escape_string($page));
		$result = mysql_query($strSql , $con);
		if(!$result)
			echo mysql_error();
		
		DBClose($con);
		
		return $hasnumber;
	}
	
	function ActionHistory($page , $currenturl , $action , $memo , $visitid , $openid = '')
	{
		global $DB_FUNCTIONS;

		$arrFields = array();
		array_push($arrFields , "clientip");
		array_push($arrFields , "openid");
		array_push($arrFields , "page");
		array_push($arrFields , "currenturl");
		array_push($arrFields , "visitid");
		array_push($arrFields , "action");
		array_push($arrFields , "memo");
		array_push($arrFields , "visittime");

		$arrValues = array();
		array_push($arrValues , GetIP());
		array_push($arrValues , $openid);
		array_push($arrValues , $page);
		array_push($arrValues , $currenturl);
		array_push($arrValues , $visitid);
		array_push($arrValues , $action);
		array_push($arrValues , $memo);
		array_push($arrValues , $DB_FUNCTIONS["now"]);

		return DBInsertTableField("actionhistory" , $arrFields , $arrValues);
	}
	
	function RND($from = 0 , $to = 1)
	{
		//list($msec, $sec) = explode(' ', microtime());
		//srand((float) $sec);
		srand((double)microtime()*1000000);

		return rand($from , $to);
	}
	
	function myecho($str){
		if($str == null)
			$str="null!!!";
		if(is_array($str)){
			echo "{{{<br>";
			print_r($str);
			echo "<br>}}}";
		} else {
			echo "|" . $str . "|<br>";
		}
	}
	function Get($paraid){
		if(!isset($_REQUEST[$paraid]))
			return "";
		else 
			return $_REQUEST[$paraid];
	}
	function Post($paraid){
		if(!isset($_POST[$paraid]))
			return "";
		else 
			return $_POST[$paraid];
	}

	function createOauthUrlForCode($redirectUrl)
	{
		global $appid;
		$urlObj["appid"] = $appid;
		$urlObj["redirect_uri"] = "$redirectUrl";
		$urlObj["response_type"] = "code";
		$urlObj["scope"] = "snsapi_base";
		$urlObj["state"] = "STATE"."#wechat_redirect";
		$bizString = formatBizQueryParaMap($urlObj, false);
		return "https://open.weixin.qq.com/connect/oauth2/authorize?".$bizString;
	}
	function createOauthUrlForOpenid($code)
	{
		global $appid;
		global $appsecret;
		$urlObj["appid"] = $appid;
		$urlObj["secret"] = $appsecret;
		$urlObj["code"] = $code;
		$urlObj["grant_type"] = "authorization_code";
		$bizString = formatBizQueryParaMap($urlObj, false);
		return "https://api.weixin.qq.com/sns/oauth2/access_token?".$bizString;
	}
	
	function createOauthUrlForInfo($redirectUrl){
		global $appid;

		$GetUserinfo_Para = "&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
		$auth_url = "https://open.weixin.qq.com/connect/oauth2/authorize";

		$callbackURL = urlencode($redirectUrl);
		$para = $GetUserinfo_Para;
		$auth_url_with_para = $auth_url . "?appid=" . APPID . "&redirect_uri=" . $callbackURL . "?" . $_SERVER['QUERY_STRING'] . $GetUserinfo_Para;

		return $auth_url_with_para;
	}
	
	/**
	 * 	���ã���ʽ��������ǩ��������Ҫʹ��
	 */
	function formatBizQueryParaMap($paraMap, $urlencode)
	{
		$buff = "";
		ksort($paraMap);
		foreach ($paraMap as $k => $v)
		{
		    if($urlencode)
		    {
			   $v = urlencode($v);
			}
			//$buff .= strtolower($k) . "=" . $v . "&";
			$buff .= $k . "=" . $v . "&";
		}
		$reqPar;
		if (strlen($buff) > 0) 
		{
			$reqPar = substr($buff, 0, strlen($buff)-1);
		}
		return $reqPar;
	}
	
	/**
	 * 	���ã�ͨ��curl��΢���ύcode���Ի�ȡopenid
	 */
	function getOpenid($code)
	{
		$url = createOauthUrlForOpenid($code);
        //��ʼ��curl
       	$ch = curl_init();
		//���ó�ʱ
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		//����curl�������jason��ʽ����
        $res = curl_exec($ch);
		curl_close($ch);
		//ȡ��openid
		$data = json_decode($res,true);
//print_r($data);
//die();
		if(!isset($data["openid"]))
			return null;

		$openid = $data['openid'];
		return $openid;
	}
	
	function getCustInfo($code){
		$token_arr = GetJsonArray("https://api.weixin.qq.com/sns/oauth2/access_token?code=" . $code . "&grant_type=authorization_code&appid=" . APPID . "&secret=" . APPSECRET . "",null);
//myecho($code);
//die();
		if(isset($token_arr["errcode"]) && $token_arr["errcode"] != 0)
			return null;

		$openid = $token_arr["openid"];
		$accesstoken = $token_arr["access_token"];
		$token_arrInfo = GetJsonArray("https://api.weixin.qq.com/sns/userinfo?access_token=" . $accesstoken . "&openid=" . $openid . "&lang=zh_CN",null);

		return $token_arrInfo;
	}
	
	function getCustInfoV2($code){
		$token_arr = GetJsonArrayV2("https://api.weixin.qq.com/sns/oauth2/access_token?code=" . $code . "&grant_type=authorization_code&appid=" . APPID . "&secret=" . APPSECRET . "",null);
//myecho($token_arr);
//die();
		if(isset($token_arr["errcode"]) && $token_arr["errcode"] != 0)
			return null;

		$openid = $token_arr["openid"];
		$accesstoken = $token_arr["access_token"];
		$token_arrInfo = GetJsonArrayV2("https://api.weixin.qq.com/sns/userinfo?access_token=" . $accesstoken . "&openid=" . $openid . "&lang=zh_CN",null);
//myecho($token_arrInfo);
//die();
		return $token_arrInfo;
	}

		/**
	 * 	���ã�ͨ��curl��΢���ύcode���Ի�ȡopenid
	 */
	function getUnionid($code)
	{
		$url = createOauthUrlForOpenid($code);
        //��ʼ��curl
       	$ch = curl_init();
		//���ó�ʱ
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		//����curl�������jason��ʽ����
        $res = curl_exec($ch);
		curl_close($ch);
		//ȡ��openid
		$data = json_decode($res,true);
//myecho($data);
//die();
		if(!isset($data["openid"]) && !isset($data["unionid"]))
			return null;

		$r = Array();
		$r["openid"] = $data['openid'];
		$r["unionid"] = $data['unionid'];
		return $r;
	}
	
	function GetSubscriberInfo($openid){
		global $appname;
		$access_token = GetUrlContent("http://weixin.wsestar.com/getaccesstoken.php?app=".$appname,"");
		$access_token = str_replace('"','',$access_token);
//		myecho("access_token=$access_token");
//			myecho("openid=$openid");
		//while(1){
			$arr = GetJsonArray("https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$access_token."&openid=".$openid."&lang=zh_CN","");
//		myecho($arr);

			if($arr != null){
				if(isset($arr["subscribe"])){
					if($arr["subscribe"] == 0)
						return null;
					else
						return $arr;
				} else {
					return null;
				}
			} else {
				return null;
			}
			
			
			//break;
		//}
	}
	

	function InitDBCustInfo($tableName , $arrInfo){
		$openid = $arrInfo["openid"];
		$nickname = $arrInfo["nickname"];
		$headimgurl = $arrInfo["headimgurl"];
		if($headimgurl == "")
			$headimgurl = "http://cmcc.wsestar.com/gaokao2015/logo.png";
		$sex = $arrInfo["sex"];
		$province = $arrInfo["province"];
		$city = $arrInfo["city"];
		$country = $arrInfo["country"];
		$privilege = $arrInfo["privilege"];
		
		global $DB_FUNCTIONS;
		
		$arrFields = array("openid" , "nickname" , "country" , "province" , "city" , "imgurl" , "privilege" , "sex" );
		$arrValues = array();
		array_push($arrValues , $openid);
		array_push($arrValues , $nickname);
		array_push($arrValues , $country);
		array_push($arrValues , $province);
		array_push($arrValues , $city);
		array_push($arrValues , $headimgurl);
		array_push($arrValues , json_encode($privilege));
		array_push($arrValues , $sex);

		return DBInsertTableField($tableName , $arrFields , $arrValues);
	}
	
	function Page($url){
		header("location:".$url);
		die();
	}

	function GetWXConfigData(){
		$option = array(
			'http' => array(
				'header' => "Referer:" . GetCurrentURL()
			)
		);

		$url = "http://www.wsestar.com/getwxconfigdata.php?app=" . APPNAME;
		$configData = file_get_contents($url, false,stream_context_create($option));
		
		return $configData;
	}
	
	function GetWXConfigDataV2(){
		$option = array(
			'http' => array(
				'header' => "Referer:" . GetCurrentURL()
			)
		);

		$url = "http://weixin.wsestar.com/getwxconfigdata.php?app=" . APPNAME;
		$configData = file_get_contents($url, false,stream_context_create($option));
		
		return $configData;
	}
?>