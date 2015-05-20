<?php
	$request = "https://www.kimonolabs.com/api/bx513rau?apikey=oEcJwLHv6GedDnOkwRT8Pa9tcN43Qr7D";
	$response = file_get_contents($request);
	$results = json_decode($response, TRUE);
	$collection = $results.results.collection1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>FetchFlix</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
</head>
<body>
	<h1>Welcome to FetchFlix</h1>

	<main>
		<table id="movies">
			<thead>
				<tr>
					<th>Title</th>	
					<th>Gross</th>
				</tr>
			</thead>
			
			<tbody>
				<?php 
					// First 2 fields are garbage
					for ($i=2; $i < count($collection); $i++ ) {

						$title = $collection[$i].m_title.text;
						$gross = $collection[$i].gross;

						echo "<tr><td>$title</td></tr>";
						echo "<tr><td>$gross</td></tr>";

					}
				?>
			</tbody>

		</table>
	</main>	

</body>
</html>