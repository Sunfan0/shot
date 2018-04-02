<?php
	include "paras.php";

	$mode = Get("mode");

	switch($mode){
		case "getmobileposition":
			$mobileId = Get("mobileid");
			$memcache = new Memcache;  
			$memcache->pconnect('localhost', 11211);
			$key = "shot-mobile-" . $mobileId;
			$value = $memcache->get($key);

			if(!$value){
				die("-1");
			} else {
				echo $value;
			}
			break;
		case "setmobileposition":
			/*$memcache = new Memcache;  
			$memcache->pconnect('localhost', 11211);
			$key = "JsApiTicket_" . $this->appId;
			$memcache->set($key , json_encode($data));
			break;*/
			$mobileId = Get("mobileid");
			$arrValue = array();
			$arrValue["alpha"] = Get("alpha");
			$arrValue["beta"] = Get("beta");
			$memcache = new Memcache;  
			$memcache->pconnect('localhost', 11211);
			$key = "shot-mobile-" . $mobileId;
			$memcache->set($key , json_encode($arrValue));

			echo json_encode($arrValue);
			break;
		case "setaimposition":
			$mobileId = Get("mobileid");
			$aimId = Get("aimid");
			$arrValue = array();
			$arrValue["alpha"] = Get("alpha");
			$arrValue["beta"] = Get("beta");
			$memcache = new Memcache;  
			$memcache->pconnect('localhost', 11211);
			$key = "aim-mobile-" . $mobileId . "-" . $aimId;
			$memcache->set($key , json_encode($arrValue));

			echo json_encode($arrValue);
			break;
		case "getaimposition":
			$mobileId = Get("mobileid");
			$aimId = Get("aimid");
			$memcache = new Memcache;  
			$memcache->pconnect('localhost', 11211);
			$key = "aim-mobile-" . $mobileId . "-" . $aimId;
			$value = $memcache->get($key);

			if(!$value){
				die("-1");
			} else {
				echo $value;
			}
			break;
		case "shot":
			$mobileId = Get("mobileid");
			$aimId = Get("aimid");
			$arrValue = array();
			$arrValue["alpha"] = Get("alpha");
			$arrValue["beta"] = Get("beta");
			$memcache = new Memcache;  
			$memcache->pconnect('localhost', 11211);
			for($i=1;$i<=4;$i++){
				$key = "aim-mobile-" . $mobileId . "-" . $i;
				$value = $memcache->get($key);
myecho($key);
				if(!$value){
					$memcache->set($key , json_encode($arrValue));
					die("aim".$i);
				}
			}
			$key = "shot-mobile-" . $mobileId;
			die("1");
			break;
	}
?>