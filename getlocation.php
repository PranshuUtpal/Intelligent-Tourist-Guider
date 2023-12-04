<?php
session_start();
include('connection.php');

$city = $_GET['city'];
$query1 = $_GET['query1'];
$dayNo = $_GET['dayNo'];
$stime = $_GET['stime'];
$etime = $_GET['etime'];
?>
<html>
<head>
</head>
<body onload="javascript:get_response(fun)">
<script>
var outp1;
var city = "<?php echo $city;?>";
var	CLIENT_ID = "EFGY3AP2405PBETXM0WJ1Z5MGQR5SGH1M2KVEX2CB4ZVM1DB";
var CLIENT_SECRET = "Y13HKFRDUS0RY1URR42GJU21JIGX1KBT4LQ5WIZ1GOFMSPAA";
var QUERY = "<?php echo $query1; ?>";
var dayNo = <?php echo $dayNo; ?>;
var stime = <?php echo $stime; ?>;
var etime = <?php echo $etime; ?>;
var YYYYMMDD = 20190327;
var Response;
var outp2;




function get_response(callback){
	//console.log(city+QUERY);
	const Http = new XMLHttpRequest();
	const url = "https://api.foursquare.com/v2/venues/search?near="+city+"&query="+QUERY+"&client_id="+CLIENT_ID+"&client_secret="+CLIENT_SECRET+"&v="+YYYYMMDD;
		
	Http.open("GET", url);
	Http.send();
	Http.onreadystatechange=(e)=>{
		 outp1 = Http.responseText;
		
		//var Response = JSON.parse(outp1);
		
		//console.log(outp1);
		callback(fun3);
	console.log("hello");
		
	}
	
}


function fun(callback){
	Response = JSON.parse(outp1);
	
	for (i = 0; i < Response.response.venues.length; i++) {  
			const Http1 = new XMLHttpRequest(); 
			const url1 = "https://api.foursquare.com/v2/venues/"+Response.response.venues[i].id+"/hours?client_id="+CLIENT_ID+"&client_secret="+CLIENT_SECRET+"&v="+YYYYMMDD;
			
			Http1.open("GET", url1);
			Http1.send();
			Http1.onreadystatechange=(e)=>{
				 outp2= Http1.responseText;
				
				callback();
			}
	}
}
 function fun3()
 {
	 //get_response(fun);
	 console.log(outp2);
 }

</script>
</body>
</html>

