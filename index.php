<?php

//Tästä tiedostosta ehkä voisi tehdä sivun, jolla kyselyt näytetään.
//Tähän vain referenssejä koodiin, muuten koodi näkyy sivulla.

require_once("dbconn.php");
require_once("curlInit.php");
require_once("getData.php");


//$course = new Course()

//var_dump($courses[0]);
//echo $courses[0]["name"];
?>

<!-- Nettisivun pohjaa? search.php ei täysin hiottu -->
<html>
    <head>
        <title>Recommender test</title>
    </head>
        <body>
            <form action="search.php" method="GET">
                <input id="query" type="text" name="query">
                <input id="submit" type="submit" value="Search">
            </form>
            <h1>HI!</h1>
            <p>TODO: Tässä voisi näyttää alla getKeywordissa luodun listan. Nyt tässä vain var_dumbattu</p>
            <?php
            var_dump($students);
            ?>
        </body>
</html>