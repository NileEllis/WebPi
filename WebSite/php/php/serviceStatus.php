<?php
	if (isset($_GET['service'])) {
		$service = $_GET['service'];
		
		$status = exec("systemctl status $service | grep Loaded", $out);
		//
		if (strpos($enabled, 'not-found') !== false) {
			return;
		}else{
			//
			$enabled = exec("systemctl status $service | grep Loaded", $out);
			if (strpos($enabled, 'enabled') !== false) {
				$enabled = "checked";
			} else {
				$enabled = "";
			}
			
			$status = exec("systemctl status $service | grep Active", $out);
			$status = str_replace("Active: ","",$status);
			/*
			Note that the use of !== false is deliberate; strpos() returns either the offset at which the
			needle string begins in the haystack string, or the boolean false if the needle isn't found.
			Since 0 is a valid offset and 0 is "falsey", we can't use simpler constructs like !strpos($a, 'are').
			*/
			if (strpos($status, 'inactive') !== false) {
				$btnText = "Start";
				$stateFunc = "start";
				$class = "class=\"my-notify-error\"";
			}else if (strpos($status, 'active') !== false) {
				$btnText = "Stop";
				$stateFunc = "stop";
				if (strpos($status, '(exited)') !== false) {
					$class = "class=\"my-notify-warning\"";
				}else if (strpos($status, '(running)') !== false){
					$class = "class=\"my-notify-success\"";
				}
			}else {
				echo("<span>Logging an unexpected status: $status</span>");
			}
			
			echo("<div class=\"card\" style=\"margin: 5px\">
				<div class=\"card-header\">$service Service</div>
				<div class=\"card-body\">
					<span $class>$status</span>
					<button type=\"button\" class=\"btn\" onclick=\"serviceState('$service.service', '$stateFunc');\">$btnText</button>
					<button type=\"button\" class=\"btn\" onclick=\"serviceState('$service.service', 'restart');\">Restart</button>
					<div class=\"form-check-inline\">
						<label class=\"form-check-label\">
							<input type=\"checkbox\" class=\"form-check-input\" value=\"onBoot\" $enabled> Start on boot
						</label>
					</div>
				</div>
			</div> ");
		}
	}
	//Active: active (exited) since Fri 2018-11-09 11:17:40 EST; 21min ago
	//active since Fri 2018-11-09 11:17:40 EST; 21min ago
?>

