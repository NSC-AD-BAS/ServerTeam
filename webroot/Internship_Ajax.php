
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
	
	<script>
		function populate_list() {
  			var xhttp = new XMLHttpRequest();
  			xhttp.onreadystatechange = function() {
		    	if (xhttp.readyState == 4 && xhttp.status == 200) {
		      		document.getElementById("internship_list").innerHTML = xhttp.responseText;
		    	}
		  	};
		  	xhttp.open("GET", "Internship_Ajax_List.php", true);
		  	xhttp.send();
		}
		populate_description
		function populate_description(id) {
  			var xhttp = new XMLHttpRequest();
  			xhttp.onreadystatechange = function() {
		    	if (xhttp.readyState == 4 && xhttp.status == 200) {
		      		document.getElementById("description").innerHTML = xhttp.responseText;
		    	}
		  	};
		  	var baseUrl = "Internship_Ajax_Description.php?id=";
		  	var fullUrl = baseUrl.concat(id);
		  	xhttp.open("GET", fullUrl, true);
		  	xhttp.send();
		}
</script>
<body>
	<input type="submit" onclick="populate_list()" value="Populate Internship List">
    <table id="internship_list"></table>
    <br><br>
    <table id="description"></table>
</body>