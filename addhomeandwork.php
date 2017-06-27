<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "usman";

$work=$_POST["addwork"];
$home=$_POST["addhome"];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO Hackathon (workaddress, homeaddress)
VALUES ('$work', '$home', );";

if ($conn->multi_query($sql) === TRUE) {
    echo "New records created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

$work=$_POST["addwork"];
$home=$_POST["addhome"];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
} 

$array = array();

$sql = "INSERT INTO Hackathon (workaddress, homeaddress)
VALUES ('$work', '$home', );";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) 
    {
        
    $new_array[$row['timestmp']] = $row;
    $new_array[$row['lattitude']] = $row;
    $new_array[$row['longitude']] = $row;
    $new_array[$row['accuracy']] = $row;
        
    }
} 