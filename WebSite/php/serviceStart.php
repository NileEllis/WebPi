<?php
	if (isset($_GET['service']) and isset($_GET['state'])) {
		$service = $_GET['service'];
		$state = $_GET['state'];
		echo("<p>made it this far</p>");
		echo("<p>$service</p>");
		echo("<p>$state</p>");
		$status = exec("sudo /bin/systemctl $state $service", $out);
		echo("<p>made it further</p>");
		echo("<p>$status</p>");
		
		//Update service Status on page
	}
?>