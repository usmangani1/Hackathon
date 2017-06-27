<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">
	<link rel="stylesheet" type="text/css" href="hisstyle.php">
	<style>

	body{
		background-color: rgb(100,180,220);
		background-image: url("HON-1920-logo_pos_WEB.png");
		background-size: cover;
		background-repeat: no-repeat;
	}
	</style>
	
</head>
<body>
	<nav>
		<div class="nav-wrapper">
			<a href="#" class="brand-logo" style="align:">Plot and Query</a>
		</div>
	</nav>
	
	        <div class="row">
		    <div class="col m5">
			<div class="row">
            <form action="uploadhack.php" method="post" enctype="multipart/form-data">
 
					<div class="file-field input-field">
                  
						<div  class="btn col s3 push-s10 ">
                
							    <span >CHOOSE File</span>

							<input type="file" name="file">
					  </div>
					  </div>
			</div></div>	
			</div>
			<div class="row">
			<div class="col s4 push-s4">
			<button class="btn waves-effect waves-light" type="submit" name="btn-upload">Upload
					<i class="material-icons right">send</i>
  </button>
                            </form>
						</div>
					</div>


</body>

</html>