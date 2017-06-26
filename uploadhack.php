<?php
$folder="/Applications/XAMPP/xamppfiles/htdocs/hackathonnew/";
$target_file = $folder . basename($_FILES['file']['name']);
$upload = 1;

if(isset($_POST['btn-upload']))
{    
 $file = $_FILES['file']['name'];
 $file_loc = $_FILES['file']['tmp_name'];
 $file_size = $_FILES['file']['size']/1024;
 $file_type = pathinfo($target_file,PATHINFO_EXTENSION);

 if($file_type != "json" && $file_type != "Json" && $file_type != "JSON") {
    echo "<center>";
    echo "Sorry, only JSON files are allowed.";
   
    $upload = 0;
          }



//if ($_FILES["file"]["size"] > 8388608)
// {
 //   echo "Sorry, your file is too large.";
 //   $upload = 0;
//}
$name= "location";
  move_uploaded_file($_FILES["file"]["tmp_name"], "/Applications/XAMPP/xamppfiles/htdocs/hackathonnew/" . $name.".".$file_type);
}
?>
<html>
<head>
<title> Filters </title>
<style>
.button {
    background-color: #39906F;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
	border-radius: 12px;
}
.heading-main {
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	font-style: italic;
	color: #000;
	font-weight: bold;
}
</style>
<style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    width: 200px;
    background-color: #009999;
}

li a {
    display: block;
    color: #ffffff;
    padding: 8px 16px;
    text-decoration: none;
}

/* Change the link color on hover */
li a:hover {
    background-color: #555;
    color: white;
}
</style>
<script>
	function viewMapMarkers(){
		console.log("hello");
		}
</script>
<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
<nav>
		<div class="nav-wrapper">
			<a href="#" class="brand-logo">Please Select a Filter</a>
		</div>
	</nav>
<p>
<div class="navigationbar">
 <ul>
    <li><a href="http://localhost:8080/Apps/html/hack/MapMarker.html"> mapMarkers</a></li>
    <li><a href="http://localhost:8080/Apps/html/hack/viewPerson.html">ViewPerson</a></li>
    <li> <a href="http://localhost:8080/Apps/html/hack/mapMarkerInfo.html">MapMarkerInfo</a></li>
	<li><a href="http://localhost:8080/Apps/html/hack/chooseMarkers.html">ChooseMarker(Date)</a></li>
  </ul>


</div>
</body>
</html>