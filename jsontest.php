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

//Jos käytetään mysql, toimisko tää?
foreach($json as $item) {
$insert_value = "INSERT INTO courses (id, unit, code, name, startDate, endDate,
 teachingLanguage, creditsMin, creditsMax, evaluationScale, enrollmentDescription,
 enrollmentUrl, subjectCode, degreeProgrammeCode, _opsi_opryhmät, studyPeriods0, 
 studyPeriods1)VALUES
('".$item['id']."', '".$item['unit']."', '".$item['code']."', '".$item['name']."',
'".$item['startDate']."', '".$item['endDate']."', '".$item['teachingLanguage']."',
'".$item['creditsMin']."', '".$item['creditsMax']."', '".$item['evaluationScale']."',
'".$item['enrollmentDescription']."', '".$item['enrollmentUrl']."', '".$item['subjectCode']."',
'".$item['degreeProgrammeCode']."', '".$item['_opsi_opryhmät']."', '".$item['studyPeriods0']."',
'".$item['studyPeriods1']."')");
  
?>
