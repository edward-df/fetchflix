// console.log('hello');
$.ajax({
	"url":"https://www.kimonolabs.com/api/bx513rau?apikey=oEcJwLHv6GedDnOkwRT8Pa9tcN43Qr7D",
	"crossDomain":true,
	"dataType":"jsonp",
	success: function (response) {

		var $response = response,
			collection = $response.results.collection1,
			r_length = collection.length;

		for (var i=0; i<r_length; i++) {
			var title = collection[i].m_title,
				gross = collection[i].gross;

			$('table#movies tbody').append("<tr><td>" + title.text + "</td> <td>" + gross + "</td></tr>");
		}

	},
	error: function (xhr, status) {
		console.log("Error :(");
	}
});