<!DOCTYPE html>
<html>
<head>
    <title>Railway Schedule</title>
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
input{
    background-color: white;
  border: black;
  border-radius: 50px ;
  width: 30%;
  height: 44px;
  text-align: center;
  font-size: 30px;
}


</style>





    <h1 class="heading">Railway Enquiry System</h1>
    <ul>
  <li><a href="t_search.php">Search Train</a></li>
  <li><a href="st_search.php">Search station</a></li>
  <li><a href="from_to.php">Search Train between two station</a></li>
  <li><a href="s_bw.php" >Search Train between two station in a time slot</a></li>
</ul>



<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <input type="text" name="from_station" placeholder="From Station Code" ><br><br>
    <input type="text" name="to_station" placeholder="To Station Code" ><br><br>
    Start Time: <input type="time" name="start_time"><br><br>
    End Time: <input type="time" name="end_time"><br><br>
    <input class="button-9" type="submit" value="Search">
</form>

</body>
</html>



<?php
// Connecting to the database
$servername = "localhost";
$username = "root"; // Replace with your username
$password = ""; // Replace with your password
$dbname = "railways";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Form handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $from_station = $_POST["from_station"];
    $to_station = $_POST["to_station"];
    $start_time = $_POST["start_time"];
    $end_time = $_POST["end_time"];

    $sql = "SELECT train.trainNo, train.trainName, route.arrival, route.departure
            FROM train
            JOIN route ON train.trainNo = route.trainNo
            WHERE route.stationCode = '$from_station' AND route.trainNo IN (
                SELECT trainNo
                FROM route
                WHERE stationCode = '$to_station' AND arrival >= '$start_time' AND departure <= '$end_time'
            )";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>Train No.</th>
                    <th>Train Name</th>
                    <th>Arrival</th>
                    <th>Departure</th>
                </tr>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row["trainNo"]."</td>
                    <td>".$row["trainName"]."</td>
                    <td>".$row["arrival"]."</td>
                    <td>".$row["departure"]."</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No trains found in the specified time slot.";
    }
}

$conn->close();
?>