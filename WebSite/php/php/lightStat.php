<?php
	$json = exec("curl http://192.168.1.100/api/zLxFMQOlY3uDcj8SNghqvaGQBVNivdTVZt19mVnn/lights", $out);
	$obj = json_decode($json, true);

	if($obj[1]['state']['on'] == 1){
		$on = "on";
	} else{
		$on = "off";
	}
	$bri = ($obj[1]['state']['bri']/254)*100;
	echo ("<p>Light #1 is $on and the brightness is set to $bri%</p>");
	
	if($obj[3]['state']['on'] == 1){
		$on = "on";
	} else{
		$on = "off";
	}
	$bri = ($obj[3]['state']['bri']/254)*100;
	echo ("<p>Light #2 is $on and the brightness is set to $bri%</p>");
	
	if($obj[4]['state']['on'] == 1){
		$on = "on";
	} else{
		$on = "off";
	}
	$bri = ($obj[4]['state']['bri']/254)*100;
	echo ("<p>Light #3 is $on and the brightness is set to $bri%</p>");

	//$test2 = json_last_error(); // 4 (JSON_ERROR_SYNTAX)
	//echo ("<p>$test2</p>");
	//$test3 = json_last_error_msg(); // unexpected character
	//echo ("<p>$test3</p>");
?>