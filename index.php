<?php
	$request = "https://www.kimonolabs.com/api/bx513rau?apikey=oEcJwLHv6GedDnOkwRT8Pa9tcN43Qr7D";
	$response = file_get_contents($request);
	$results = json_decode($response, TRUE);
	$collection = $results;
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>FetchFlix</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
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
					for ($i=0; $i < count($collection); $i++ ) {

						$title = $results["results"]["collection1"][$i]["m_title"]["text"];
						$gross = $results["results"]["collection1"][$i]["gross"];

						echo "<tr>";
						echo "<td>$title</td>";
						echo "<td>$gross</td>";
						echo "</tr>";

					}
				?>
			</tbody>

		</table>
	</main>	

</body>
</html>