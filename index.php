<?php
	$servername = "localhost";
	$username = "galaxy";
	$password = "Geradiena15";
	$database = "read_write";
try {
		$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		/*echo "Connected successfully"*/; 

	} catch(PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
	}
	if (isset($_POST['submit'])) {
	$conn->exec("INSERT INTO chat_place (User_name, Timess, Only_text) VALUES ('".$_POST['user_name']."','" . $_SERVER['REQUEST_TIME']."','" . $_POST['text']."')");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title> Read_Write</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

</head>
<body>
	<div class="container">
		<h1 class="bg-info text-white text-center p-5"> C H A T </h1>	
		<div class="row p-1 header mb-1">
			<form action="index.php" method="post" >
				<label for="User">User name</label>
				<input type="text" name="user_name"> 
				<div class="form-group">
					<label for="exampleFormControlTextarea1">Your text</label>
					<textarea class="form-control" rows="3" name="text"></textarea>
				</div>
				<button type="submit" class="btn btn-info" value="submit" name="submit">Submit </button> 
			</form>
		</div>
		<div class="row">
					
			<?php
				$query = $conn->prepare("SELECT * FROM chat_place");
				$query->execute();
 				$products = $query->fetchAll(PDO::FETCH_ASSOC);
 				foreach ($products as $product) {
				echo "<div class='col-md-12'>";
				echo  "<b>Vartotojo vardas:</b>".''.$product['User_name']."<br>";
				echo  "<b>Time:</b>".''.date('Y-m-d H:i:s', $product['Timess'])."<br>";
				echo  "<b>Tekstas:</b>".''.$product['Only_text']."<br>"."<hr>";
				echo "</div>";
}
					?>

		</div>
	</div>
</body>
</html>

