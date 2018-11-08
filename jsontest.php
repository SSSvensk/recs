<?php
$curl = curl_init();
// echo "URL: " . $url . "<br>";
curl_setopt($curl, CURLOPT_URL, "https://opendata.uta.fi:8443/apiman-gateway/UTA/opintojaksot/1.0?apikey=cc65d236-7cca-4d7a-b216-5975f4c14900");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

$resp = curl_exec($curl);

$json = json_decode($resp, true);

var_dump($json)

?>
