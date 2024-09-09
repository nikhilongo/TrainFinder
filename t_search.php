<!DOCTYPE html>
<html>
<head>
    <title>Get Station Information by Train Number</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 30px;
            display: inline-block;
    padding: .25em 0;
    
    color: black;
        }
        th, td {
            border: 2px solid red;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: transparent;
        }
        
    </style>
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
input{
    background-color: white;
  border: black;
  border-radius: 50px ;
  width: 30%;
  height: 44px;
  text-align: center;
  font-size: 30px;
}
.button-9 {
  appearance: button;
  backface-visibility: hidden;
  background-color: #405cf5;
  border-radius: 6px;
  border-width: 0;
  box-shadow: rgba(50, 50, 93, .1) 0 0 0 1px inset,rgba(50, 50, 93, .1) 0 2px 5px 0,rgba(0, 0, 0, .07) 0 1px 1px 0;
  box-sizing: border-box;
  color: #fff;
  cursor: pointer;
  font-family: -apple-system,system-ui,"Segoe UI",Roboto,"Helvetica Neue",Ubuntu,sans-serif;
  font-size: 100%;
  height: 44px;
  line-height: 1.15;
  margin: 12px 0 0;
  outline: none;
  overflow: hidden;
  padding: 0 25px;
  position: relative;
  text-align: center;
  text-transform: none;
  transform: translateZ(0);
  transition: all .2s,box-shadow .08s ease-in;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  width: 30%;
}

.button-9:disabled {
  cursor: default;
}

.button-9:focus {
  box-shadow: rgba(50, 50, 93, .1) 0 0 0 1px inset, rgba(50, 50, 93, .2) 0 6px 15px 0, rgba(0, 0, 0, .1) 0 2px 2px 0, rgba(50, 151, 211, .3) 0 0 0 4px;
}


</style>


<h1 class="heading">Railway Enquiry System</h1>
    <ul>
  <li><a href="t_search.php">Search Train</a></li>
  <li><a href="st_search.php">Search station</a></li>
  <li><a href="from_to.php">Search Train between two station</a></li>
  <li><a href="s_bw.php" >Search Train between two station in a time slot</a></li>
</ul>



    <h2>Enter Train Number to Get Station Information</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input  type="text" id="train_no" name="train_no" required placeholder="ENTER TRAIN NUMBER"><br><br>
        <button class="button-9" type="submit">Get Information</button>
    </form>
</body>
</html>


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

// Check if train number is provided
if(isset($_POST['train_no'])) {
    $train_no = $_POST['train_no'];

    // Query to retrieve station name, station code, arrival, departure based on train number
    $sql = "SELECT station.stationCode, station.stName, route.arrival, route.departure
            FROM station
            INNER JOIN route ON station.stationCode = route.stationCode
            WHERE route.trainNo = '$train_no'";
    
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Start HTML table
        echo "<table>";
        echo "<tr><th>Station Code</th><th>Station Name</th><th>Arrival</th><th>Departure</th></tr>";
        
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["stationCode"] . "</td>";
            echo "<td>" . $row["stName"] . "</td>";
            echo "<td>" . $row["arrival"] . "</td>";
            echo "<td>" . $row["departure"] . "</td>";
            echo "</tr>";
        }

        // End HTML table
        echo "</table>";
    } else {
        echo "No data found for the train number provided.";
    }
}

// Close connection
$conn->close();
?>
