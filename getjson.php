<?php

//Tästä tiedostosta ehkä voisi tehdä sivun, jolla kyselyt näytetään.

require_once("dbconn.php");
require_once("getKeywords.php");

$checkQuery = $conn->query("SELECT COUNT(*) AS cnt FROM course");
$result = $checkQuery->fetch_assoc();

//Insert data from API, if data doesn't exist.
if ($result["cnt"] == 0) {

    $curl = curl_init();

    //curl-functions to receive the url and make some settings
    curl_setopt($curl, CURLOPT_URL, "https://opendata.uta.fi:8443/apiman-gateway/UTA/opintojaksot/1.0?apikey=cc65d236-7cca-4d7a-b216-5975f4c14900");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

    //Executing the curl-requests
    $resp = curl_exec($curl);
    
    //Decoding the feedback to JSON-array and storing it to variable json
    $json = json_decode($resp, true);

    //Printing the array and its structure out using var_dump command.

    //Jos käytetään mysql, toimisko tää?
    foreach($json as $item) {
        if ($item['code'] != "") {
            $periods = "";
            $periodslength = sizeof($item["studyPeriods"]);
            for ($i = 0; $i < $periodslength; $i++) {
                $periods .= $item["studyPeriods"][$i]. " ";
            }
            $conn->query("SET NAMES utf8");
            $sql = "INSERT INTO course (code, id, name, subject, language, periods, minects, maxects) VALUES ('".$item['code']."', '".$item['id']."', '".$item['name']."', '".$item['degreeProgrammeCode']."','".$item['teachingLanguage']."', '".$periods."','".$item['creditsMin']."', '".$item['creditsMax']."')";
            if ($conn->query($sql) === TRUE) {
                echo "";
            } else {
                //echo "Error: " . $conn->error;
            }
        }
    }
}

$conn->close();
?>

<!-- Nettisivun pohjaa? search.php ei täysin hiottu -->
<html>
    <head>
        <title>Recommender test</title>
    </head>
        <body>
            <form action="search.php" method="GET">
                <input id="search" type="text" name="query">
                <input id="submit" type="submit" value="Search">
            </form>
            <h1>HI!</h1>
            <p>TODO: Tässä voisi näyttää alla getKeywordissa luodun listan. Nyt tässä vain var_dumbattu</p>
            <?php
            var_dump($keywords);
            ?>
        </body>
</html>

