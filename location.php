<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	
	<script src="../../Build/Cesium/Cesium.js"></script>
    <style>
       @import url(../../Build/Cesium/Widgets/widgets.css);
       html, body, #cesiumContainer {
       width: 100%; height: 100%;
       }
	</style>
	
</head>
<body>
	<nav>
		<div class="nav-wrapper">
			<a href="#" class="brand-logo">Plot and Query</a>
		</div>
	</nav>
	
	<div class="row">
		<div class="col m5">
			<div class="row">
<form action="uploadhack.php" method="post" enctype="multipart/form-data">
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<div class="file-field input-field">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<div  class="btn col s3 push-s10 ">
                
							        <span > File</span>
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