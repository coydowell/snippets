<?php include './db.php';

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
echo "<br>";

$sql = "SELECT `salaries`.`emp_no`," .
"`salaries`.`salary`," .
"`salaries`.`from_date`," .
"`salaries`.`to_date`" .
"FROM `employees`.`salaries`" .
"LIMIT 10";

$result = $conn->query($sql);

/* if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo $row["emp_no"]. " " . $row["salary"]. " " . $row["from_date"]. " " . $row["to_date"]. "<br>";
    }
} else {
    echo "0 results";
} */

 // Create empty array to hold query results
 $someArray = [];

 // Loop through query and push results into $someArray;
 while ($row = mysqli_fetch_assoc($result)) {
   array_push($someArray, [
     'emp_no'   => $row['emp_no'],
     'salary'   => $row['salary'],
     'from_date'   => $row['from_date'],
     'to_date' => $row['to_date']
   ]);
 }

 // Convert the Array to a JSON String and echo it
 $someJSON = json_encode($someArray);
 echo $someJSON;

 file_put_contents("newfile.json", $someJSON);

$conn->close();
