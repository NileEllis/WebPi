
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./images/raspberry-pi-logo.png">

    <title>Pi Device Config</title>
	
	<!-- JQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	
    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./css/dashboard.css" rel="stylesheet">
	<link href="./css/custom.css" rel="stylesheet">
  </head>
  
  <?php include("./php/_login.php"); ?>

  <body>
    <?php include("./php/navigation.php");?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Home Automation Interface</h1>           
          </div>
		<div class="card-deck">  
			<div class="card text-center">
				<div class="card-header bg-info">Lighting Status</div>
				<div class="card-body">
					<div id="status"></div>
					<button type="button" class="btn" onclick="updateStat();">Refresh</button>
				</div>
			</div>
			<div id="servStat"></div> <!-- This is a card that will be inserted by ajax-->
		</div>
		<div class="card-deck">
			<div class="card text-center" style="margin: 5px">
				<div class="card-header">Light #1</div>
				<div class="card-body">
					<button type="button" class="btn" onclick="lightToggle(1,1,254);">Turn On</button>
					<button type="button" class="btn" onclick="lightToggle(1,0,254);">Turn Off</button>
				</div>
			</div>
			<div class="card text-center" style="margin: 5px">
				<div class="card-header">Light #3</div>
				<div class="card-body">
					<button type="button" class="btn" onclick="lightToggle(3,1,254);">Light On</button>
					<button type="button" class="btn" onclick="lightToggle(3,0,254);">Light Off</button>
				</div>
			</div>
			<div class="card text-center" style="margin: 5px">
				<div class="card-header">Light #4</div>
				<div class="card-body">
					<button type="button" class="btn" onclick="lightToggle(4,1,254);">Light On</button>
					<button type="button" class="btn" onclick="lightToggle(4,0,254);">Light Off</button>
				</div>
			</div>
			<div class="card text-center" style="margin: 5px">
				<div class="card-header">Group #1 (Livingroom)</div>
				<div class="card-body">
					<button type="button" class="btn" onclick="groupToggle(1,1,254);">Group On</button>
					<button type="button" class="btn" onclick="groupToggle(1,0,254);">Group Off</button>
				</div>
			</div>
		</div>
		
		<div id="alert" class="alert alert-success fade in">
			<strong>Success!</strong> Indicates a successful or positive action.
		</div>
        </main>
      </div>
    </div>

	 <!-- Custom JavaScript for philips hue API-->
	<script src="/js/lights.js"></script>
	<script>
		function updateServiceStat(service) {
		  var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
			  document.getElementById("servStat").innerHTML = this.responseText;
			}
		  };
		  xhttp.open("POST", "/php/serviceStatus.php/?service=" + service, true);
		  xhttp.send();
		}
		function serviceState(service, state) {
		  var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
			  window.setTimeout(reload,3000);
			}
		  };
		  xhttp.open("POST", "/php/serviceStart.php/?service=" + service + "&state=" + state, true);
		  xhttp.send();
		}
		function reload(){
			location.reload();
		}
		updateServiceStat('homeauto');
	</script>
	
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/popper.min.js"></script>
    <script src="https://getbootstrap.com/docs/4.0/dist/js/bootstrap.min.js"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>
	
  </body>
</html>
