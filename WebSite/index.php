<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./images/raspberry-pi-logo.png">

    <title>Pi Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./css/dashboard.css" rel="stylesheet">
	<link href="./css/custom.css" rel="stylesheet">
  </head>
  <body>
  
  <!-- Injects the Navigation header and sidebar into the page -->
  <?php include("./php/navigation.php");?>
  
	<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
	  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Dashboard</h1>           
	  </div>
	<div class="card" style="width: 32rem">
		<div class="card-header bg-info">Telemetries</div>
		<div class="card-body">
			<div id='status'> </div>
		</div>
	<!-- Graph would go here -->
	</div>
	</main>
	
	<script>
		function update() {
		  var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
			  document.getElementById("status").innerHTML =
			  this.responseText;
			  setTimeout(function(){update()}, 5000);
			}
		  };
		  xhttp.open("GET", "php/status.php", true);
		  xhttp.send();
		}
		update();
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
