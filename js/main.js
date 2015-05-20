// console.log('hello');
$.ajax({
    "url":"https://www.kimonolabs.com/api/bx513rau?apikey=oEcJwLHv6GedDnOkwRT8Pa9tcN43Qr7D",
    "crossDomain":true,
    "dataType":"jsonp",
    success: function(result){
        console.log(result);
        
    }
});