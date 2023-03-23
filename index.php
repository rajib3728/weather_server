<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "weather";
	
// connect the database with the server
$conn = new mysqli($servername,$username,$password,$dbname);
	
	// if error occurs
	if ($conn -> connect_errno)
	{
	echo "Failed to connect to MySQL: " . $conn -> connect_error;
	exit();
	}

	$sql = "select * from weatherData";
	$result = ($conn->query($sql));
	//declare array to store the data of database
	$row = [];

	if ($result->num_rows > 0)
	{
		// fetch all data from db into array
		$row = $result->fetch_all(MYSQLI_ASSOC);
	}
?>

<!DOCTYPE html>
<html>
    <head>
         <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="img1.jpg">
    <title>Weather Report</title>
<style>
	td,th {
		border: 1px solid black;
		padding: 10px;
		margin: 5px;
		text-align: center;
	}

    body {
    background-image: url('img1.jpg');
    background-repeat: no-repeat;
    background-attachment: fixed; 
    background-size: 100% 100%;
   }
  .container
  {    width:80%;
       margin-top:250px;
       background-color:white;
       border-radius:20px;
       color:white;
  }
</style>
</head>
<body>
    <center>
        <h1>Weather Report</h1>
        <div class="container">
        
        <button onclick="fun1()">See data</button>
	<table>
		<thead>
			<tr>
				<th>Humidity</th>
				<th>Temperature</th>
				<th>Place</th>
                <th>Datetime</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(!empty($row))
			foreach($row as $rows)
			{
			?>
			<tr>

				<td><?php echo $rows['humidity'] ; ?>%</td>
				<td><?php echo $rows['temperature'] ; ?>℃</td>
				<td><?php echo $rows['place']; ?></td>
                <td><?php echo $rows['time']; ?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
            </div>
            </center>

    <script>
        function fun1()
        {
            document.getElementsByClassName("container")[0].style.color="black";
        }
    </script>
</body>
</html>
<?php
	mysqli_close($conn);
?>
