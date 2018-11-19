<?php
    $uptime = exec("uptime -p");
	$uptime = str_ireplace("up", "", $uptime);
	//$uptime = trim($uptime);
	echo ("<p><strong>Up Time:</strong> $uptime</p>");
	
	$cpuTemp = exec("cat /sys/class/thermal/thermal_zone0/temp", $out);
	$cpuTemp = $cpuTemp/1000;
	$cpuTemp = round($cpuTemp, 2);
	echo("<p><strong>CPU Temp:</strong> $cpuTemp C</p>");
	
	$usedCPU = exec("top -n 1 | grep %Cpu", $out);
	echo("<p><strong>CPU Usage:</strong> $usedCPU</p>");
	
	$FreeMem = exec("free | grep Mem", $out);
	$FreeMem = preg_replace('/\s+/', ' ', $FreeMem);
	$FreeMem = explode(" ", $FreeMem);
	$percRAM = round (($FreeMem[2]/$FreeMem[1])*100, 1);
	$intPRAM = intval($percRAM);
	//$bkg = status($intPRAM);
	echo("<p><strong>Used RAM:</strong> $percRAM%</p>
	<div class=\"progress\">
		<div class=\"progress-bar $bkg\" role=\"progressbar\" style=\"width: $intPRAM%\" aria-valuenow=\"$percRAM\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>
	</div>
	");
	$FreeSwap = exec("free | grep Swap", $out);
	$FreeSwap = preg_replace('/\s+/', ' ', $FreeSwap);
	$FreeSwap = explode(" ", $FreeSwap);
	$percSwap = round (($FreeSwap[2]/$FreeSwap[1])*100, 1);
	$intPSwap = intval($percSwap);
	//$bkg = status($intPSwap);
	echo("<p><strong>Used Swap:</strong> $percSwap%</p>
	<div class=\"progress\">
		<div class=\"progress-bar $bkg\" role=\"progressbar\" style=\"width: $intPSwap%\" aria-valuenow=\"$percSwap\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>
	</div>
	");
	
	$df = exec("df | grep /dev/root", $out);
	$df = preg_replace('/\s+/', ' ', $df);
	$df = explode(" ", $df);
	$percStorage = round(($df[2]/$df[1])*100, 1);
	$intPStor = intval($percStorage);
	//$bkg = status($intPStor);
	echo("<p><strong>Used Disk Space:</strong> $percStorage%</p>
	<div class=\"progress\">
		<div class=\"progress-bar $bkg\" role=\"progressbar\" style=\"width: $intPStor%\" aria-valuenow=\"$percStorage\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>
	</div>
	");
	/*
	function status(level){
		if(level <= 50){
			return("bg-success");
		}else if(level > 50 and level <= 75){
			return("bg-warning");
		}else if(level > 75 and level <= 100){
			return("bg-danger");
		}else{
			return("");
		}
	}
	*/
?>