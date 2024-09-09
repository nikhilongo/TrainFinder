<?php
// Database connection
$servername = "localhost"; // Change this to your MySQL server name if it's different
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$dbname = "railways"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Get Station Name</title>
</head>
<body>

<style>
    body{
        margin: 0px;
        padding: 0px;
        background-image: url('train.jpg');
        background-repeat: no-repeat;
        

    }
    li {
  display: inline;
}
li {
  float: left;
}

a {
  display: block;
  padding: 8px;
  background-color: #dddddd;
}
ul {
  background-color: #dddddd;
}
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #dddddd;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

/* Change the link color to #111 (black) on hover */
li a:hover {
  background-color: #111;
}
.heading{
    color: yellow;

}

</style>





    <h1 class="heading">Railway Enquiry System</h1>
    <ul>
  <li><a href="t_search.php">Search Train</a></li>
  <li><a href="st_search.php">Search station</a></li>
  <li><a href="from_to.php">Search Train between two station</a></li>
  <li><a href="s_bw.php" >Search Train between two station in a time slot</a></li>
</ul>
</body>
</html>
