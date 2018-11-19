<?php
	if (isset($_GET['state'])) {
		$num = $_GET['num'];
		$temp = $_GET['state'];
		$bri = $_GET['bri'];
		
		switch ($temp) {
			case 1:
				$state = "true";
				$stateW = "on";
				break;
			case 0:
				$state = "false";
				$stateW = "off";
				break;
			default:
				echo ("State value passed is incorrect");
		}
		
		$json = exec("curl -X PUT http://192.168.1.100/api/zLxFMQOlY3uDcj8SNghqvaGQBVNivdTVZt19mVnn/lights/$num/state -d '{\"on\":$state,\"bri\":$bri}'", $out);
		echo("<p>Light #$num turned $stateW successfully</p>");

	}
		//$obj = json_decode($json, true);
?>