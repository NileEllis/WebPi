
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

  	<?php
	function serviceStat($service){
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
	?>
  
	<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
	  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">System Services</h1>    
	  </div>
	<div id="alert" class="alert alert-success fade in">
			<strong>Success!</strong> Indicates a successful or positive action.
	</div>
	<div class="card">
		<div class="card-header bg-info">Default Services</div>
		<div class="card-body">
			<?php
			serviceStat('bluetooth');
			serviceStat('nfs-common');
			serviceStat('nodered');
			serviceStat('ssh');
			serviceStat('samba');
			?>
		</div>
	</div>
	</main>
	
	<script>
		function serviceState(service, state) {
		  var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
			  //document.getElementById("auto").innerHTML = this.responseText;
			  //document.getElementById("alert").style.opacity = 1;
			  //window.setTimeout(fade,3000);
			  window.setTimeout(reload,3000);
			}
		  };
		  xhttp.open("POST", "/php/serviceStart.php/?service=" + service + "&state=" + state, true);
		  xhttp.send();
		}
		function fade() {
			document.getElementById("alert").style.opacity = 0;
		}
		function reload(){
			location.reload();
		}
	</script>
	
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
