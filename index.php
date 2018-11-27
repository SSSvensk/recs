<?php

//Tästä tiedostosta ehkä voisi tehdä sivun, jolla kyselyt näytetään.

require_once("dbconn.php");
require_once("getjson.php");
require_once("getKeywords.php");

$courses = $conn->query("SELECT * FROM course");
var_dump($courses);
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

