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
		        $("table#movies").tablesorter({sortList: [[2,1]] }); 
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
					<th></th>
					<th>Title</th>	
					<th>iMDb Rating</th>
					<th>Gross</th>
					<th>Runtime</th>
					<th>Rated</th>
					<th>Released</th>
					<th>Plot</th>
				</tr>
			</thead>
			
			<tbody>
				<?php 
					for ($i=0; $i < count($results); $i++ ) {

						$title = $results["results"]["collection1"][$i]["m_title"]["text"];
						$gross = $results["results"]["collection1"][$i]["gross"];

						$href = parse_url($results["results"]["collection1"][$i]["m_title"]["href"]);

						// Get the iMDb id
						// This should be the last element in the exploded array
						$imdb_id = end(explode('/', $href[path]));

						$imdb_request = "results_imdb.json";
						$imdb_response = file_get_contents($imdb_request);
						$imdb_results = json_decode($imdb_response, TRUE);

						$poster = $imdb_results[$i]["Poster"];
						$score = $imdb_results[$i]["imdbRating"];
						$rated = $imdb_results[$i]["Rated"];
						$runtime = $imdb_results[$i]["Runtime"];
						$released = $imdb_results[$i]["Released"];
						$plot = $imdb_results[$i]["Plot"];



						$movie_page_url = $results["results"]["collection1"][$i]["m_title"]["href"];

						echo "<tr>";
						echo "<td><a href='$movie_page_url'><img src='$poster' height='100' alt='$title' title='$title'></a></td>";
						echo "<td><a href='$movie_page_url'>$title</a></td>";
						echo "<td>$score</td>";
						echo "<td>$gross</td>";
						echo "<td>$runtime</td>";
						echo "<td>$rated</td>";
						echo "<td>$released</td>";
						echo "<td>$plot</td>";
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