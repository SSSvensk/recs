<?php

//Tästä tiedostosta ehkä voisi tehdä sivun, jolla kyselyt näytetään.
//Tähän vain referenssejä koodiin, muuten koodi näkyy sivulla.

require_once("dbconn.php");
require_once("curlInit.php");


$checkQuery = $conn->query("SELECT COUNT(*) AS cnt FROM student");
$result = $checkQuery->fetch_assoc();
if ($result["cnt"] == 0) {
    require_once("insertdata.php");
}
require_once("getData.php");
require_once("points.php");


?>

<!-- Nettisivun pohjaa? search.php ei täysin hiottu -->
<html>
    <head>
        <title>Recommender test</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <form action="/action_page.php" method="get">
            <input type="checkbox" name="vehicle" value="1" onclick="checkAddress(this)" checked> Period 1<br>
            <input type="checkbox" name="vehicle" value="2" onclick="checkAddress(this)" checked> Period 2<br>
            <input type="checkbox" name="vehicle" value="3" onclick="checkAddress(this)" checked> Period 3<br>
            <input type="checkbox" name="vehicle" value="4" onclick="checkAddress(this)" checked> Period 4<br>
        </form>
        <h1>Recommended based on your previous interests</h1>
        <?php
            $points = calculatePoints($courses, $students[3]);
            $recommended = array();
            while ($course_name = current($points)) {
                $code = key($points);
                foreach ($courses as $course) {
                    if ($course->code == $code) {
                        $recommended[] = $course;
                    }
                }
                next($points);
            }
			$ratememory = array();
			$count = 0;
			$semirate = 0;
			foreach ($recommended as $course) {
				$ratings = $conn->query("SELECT rate FROM attends WHERE coursecode = '". $course->code ."'");
				while($ratearray = $ratings->fetch_assoc()){
					$semirate = $semirate + $ratearray['rate'];
					$count = $count + 1;
					echo $ratearray['rate'];
				}
				echo "<br>";
				echo $count;
				$finalrate = $semirate / $count;
				$ratememory[$course->code] = $finalrate;
			}
			arsort($ratememory);
			var_dump($ratememory);
        ?>
        <p id = "list"></p>
    </body>
</html>
<script>
var periods = ["1", "2", "3", "4"];

var recommended = <?php echo json_encode($recommended); ?>;
console.log(recommended);
createOutput(recommended);


function createOutput(recommended) {
    var courses = "<table class='table table-striped'><thead><tr><th>Code</th><th>Name</th><th>Periods</th><th>Language</th></tr></thead><tbody>";

    for (var i = 0; i < recommended.length; i++) {
        courses = courses + "<tr><td>" + recommended[i]["code"] + "</td><td>" + recommended[i]["name"] + "</td><td>" + recommended[i]["periods"] + "</td><td>" + recommended[i]["language"] + "</td></tr>";
    };
    
    courses = courses + "</tbody></table>";
    document.getElementById("list").innerHTML = courses;
}

function checkAddress(checkbox) {

    if (checkbox.checked) {
        periodRecs = [];
        periods.push(checkbox.value);
        for (var i = 0; i < recommended.length; i++) {
            for (var j = 0; j < periods.length; j++) {
                if (recommended[i].periods.includes(j)) {
                    periodRecs.push(recommended[i]);
                    break;
                };
            }   
        }
        createOutput(periodRecs);

    } else {
        var index = periods.indexOf(checkbox.value);
        periodRecs = [];
        if (index > -1) {
            periods.splice(index, 1);
        }
        for (var i = 0; i < recommended.length; i++) {
            for (var j = 0; j < periods.length; j++) {
                if (recommended[i].periods.includes(j)) {
                    periodRecs.push(recommended[i]);
                    break;
                };
            }   
        }
        createOutput(periodRecs);
    }
}
$conn->close();
</script>