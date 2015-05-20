<?php
	$request = "https://www.kimonolabs.com/api/bx513rau?apikey=oEcJwLHv6GedDnOkwRT8Pa9tcN43Qr7D";
	$response = file_get_contents($request);
	$results = json_decode($response, TRUE);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>FetchFlix</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="js/lib/tablesorter/jquery.tablesorter.min.js"></script>

	<script>
		$(document).ready(function() 
		    { 
		        $("table#movies").tablesorter(); 
		    } 
		); 
	</script>

</head>
<body>
	<h1>Welcome to FetchFlix</h1>

	<main>
		<table id="movies" class="tablesorter">
			<thead>
				<tr>
					<th>Title</th>	
					<th>iMDb Rating</th>
					<th>Gross</th>
					<th>Runtime</th>
					<th>Rated</th>
					<th>Released</th>
				</tr>
			</thead>
			
			<tbody>
				<?php 
					for ($i=0; $i < count($results); $i++ ) {

						$title = $results["results"]["collection1"][$i]["m_title"]["text"];
						$gross = $results["results"]["collection1"][$i]["gross"];

						$href = parse_url($results["results"]["collection1"][$i]["m_title"]["href"]);

						// Get the iMDb id
						$imdb_id = explode('/', $href[path]);

						$imdb_request = "http://www.omdbapi.com/?i=".end($imdb_id)."&plot=short&r=json";
						$imdb_response = file_get_contents($imdb_request);
						$imdb_results = json_decode($imdb_response, TRUE);

						$released = $imdb_results["Released"];
						$rated = $imdb_results["Rated"];
						$runtime = $imdb_results["Runtime"];
						$score = $imdb_results["imdbRating"];

						echo "<tr>";
						echo "<td>$title</td>";
						echo "<td>$score</td>";
						echo "<td>$gross</td>";
						echo "<td>$runtime</td>";
						echo "<td>$rated</td>";
						echo "<td>$released</td>";
						echo "</tr>";

					}

/*
	Notes: Setup a php page that fetches all the JSON data and saves it to access locally.
*/


				?>
			</tbody>

		</table>
	</main>	

</body>
</html>