
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./images/raspberry-pi-logo.png">

    <title>Pi Device Config</title>

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./css/dashboard.css" rel="stylesheet">
	<link href="./css/custom.css" rel="stylesheet">
  </head>
  
  <?php include("./php/_login.php"); ?>
  
  <body>
  
  <!-- Injects the Navigation header and sidebar into the page -->
  <?php include("./php/navigation.php");?>

	<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
	  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Network Configuration</h1>    
	  </div>
	
	<?php
	function network($phys){
		$hwAddr = exec("ifconfig $phys | grep Link\ encap:", $out);
		$hwAddr = substr($hwAddr, -17);
		echo ("<div class=\"form-inline\">
			<label for=\"hwAddr\" class=\"control-label col-sm-4\">Hardware Address</label>
			<div class=\"col-sm-4\">
				<input type=\"text\" readonly class=\"form-control\" id=\"hwAddr\" value=\"$hwAddr\">
			</div>
		</div>");
		
		$submask = exec("ifconfig $phys | grep inet\ addr", $out);
		$submask = str_ireplace("inet addr:", "", $submask);
		$submask = str_ireplace("Mask:", "", $submask);
		$submask = trim($submask);
		$submask = explode(" ", $submask);
		$ip_address=$submask[0];
		echo ("<div class=\"form-inline\">
			<label for=\"ipAddr\" class=\"control-label col-sm-4\">IP Address</label>
			<div class=\"col-sm-4\">
				<input type=\"text\" readonly class=\"form-control\" id=\"ipAddr\" value=\"$ip_address\">
			</div>
		</div>");
		
		$mask=$submask[4];
		echo ("<div class=\"form-inline\">
			<label for=\"subMask\" class=\"control-label col-sm-4\">Subnet Mask</label>
			<div class=\"col-sm-4\">
				<input type=\"text\" readonly class=\"form-control\" id=\"subMask\" value=\"$mask\">
			</div>
		</div>");
		
		$gatewayType = shell_exec("route -n");
		$gatewayTypeRaw = explode(" ", $gatewayType);
		$gateway=$gatewayTypeRaw[42];
		echo ("<div class=\"form-inline\">
			<label for=\"gateway\" class=\"control-label col-sm-4\">Default Gateway</label>
			<div class=\"col-sm-4\">
				<input type=\"text\" readonly class=\"form-control\" id=\"gateway\" value=\"$gateway\">
			</div>
		</div>");
		
		//$dnsType = file('/etc/resolv.conf');
		//$dnsType = str_ireplace("nameserver ", "", $dnsType);
		//$dns1 = $dnsType[2];
		//$dns2 = $dnsType[3];
		//$dns3 = $dnsType[4];
		
	}
		$hostname = GETHOSTNAME();
	?>
	<div class="card">
		<div class="card-header bg-info">Device Hostname</div>
		<div class="card-body">
			<input type="text" readonly class="form-control col-md-6" id="hostName" <?php echo("value=\"$hostname\""); ?>>
		</div>
	</div>
		
	<div class="card-deck">	
		<div class="card" style="margin: 5px">
			<div class="card-header">Interface: eth0</div><!-- Container for displaying the eth0 interface settings -->
			<div class="card-body">
				<?php network('eth0'); ?>
			</div>
		</div>
		<div class="card" style="margin: 5px">
			<div class="card-header">Interface: wlan0</div>
			<div class="card-body">
				<?php network('wlan0'); ?>
			</div>
		</div>
	</div>
	
	</main>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/popper.min.js"></script>
    <script src="https://getbootstrap.com/docs/4.0/dist/js/bootstrap.min.js"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>
	
  </body>
</html>
