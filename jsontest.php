<?php
$curl = curl_init();

//curl-functions to receive the url and make some settings
curl_setopt($curl, CURLOPT_URL, "https://opendata.uta.fi:8443/apiman-gateway/UTA/opintojaksot/1.0?apikey=cc65d236-7cca-4d7a-b216-5975f4c14900");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

//Executing the curl-requests
$resp = curl_exec($curl);

//Decoding the feedback to JSON-array and storing it to variable json
$json = json_decode($resp, true);

//Printing the array and its structure out using var_dump command.
var_dump($json)

?>
