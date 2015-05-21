<?php 
	$request = "https://www.kimonolabs.com/api/bx513rau?apikey=oEcJwLHv6GedDnOkwRT8Pa9tcN43Qr7D";
	$response = file_get_contents($request);
	$results = json_decode($response, TRUE);

	$fp = fopen('results.json', 'w');
	fwrite($fp, json_encode($results));
	fclose($fp);

	$data[] = [];
	

	for ($i=0; $i < count($results); $i++ ) {

		$href = parse_url($results["results"]["collection1"][$i]["m_title"]["href"]);
		// Get the iMDb id
		// This should be the last element in the exploded array
		$imdb_id = end(explode('/', $href[path]));

		$imdb_request = "http://www.omdbapi.com/?i=".$imdb_id."&plot=short&r=json";
		$imdb_response = file_get_contents($imdb_request);
		$imdb_results = json_decode($imdb_response, TRUE);

		if ($i == 0) { $data = $imdb_results; }
		else { array_push($data, $imdb_results); }
	}

	$fp = fopen('results_imdb.json', 'w');
	fwrite($fp, json_encode($data));
	fclose($fp);
 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Fetch</title>
 </head>
 <body>
 	<h1>Done fetching</h1>

 	<?php 
 		date_default_timezone_set('America/Los_Angeles');
 		echo date('l jS \of F Y h:i:s A');
 	?>
 </body>
 </html>