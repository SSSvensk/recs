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

$student = $students[3];

$similarities = array();

for ($i=0; $i < count($students); $i++) { 
    if (count($students[$i]->courses) != 0 && $students[$i]->number != $student->number) {
        $sim = $student->countSimilarity($students[$i]);
        $notAttended = $student->notAttendedCourses($students[$i]);
        foreach ($notAttended as $course) {
            if (array_key_exists($course->code, $similarities)) {
                $similarities[$course->code] += $sim;
            } else {
                $similarities[$course->code] = $sim;
            }
            
        }
    }       
}

arsort($similarities);

$sims = array();

while ($course_name = current($similarities)) {
    $code = key($similarities);
    foreach ($courses as $course) {
        if ($course->code == $code) {
            $sims[] = $course;
        }
    }
    next($similarities);
}

$similiarcourses = array();

for ($i = 0; $i < count($sims); $i++) {
    $sc = array();
    for ($j = 0; $j < count($sims); $j++) { 
        if (count($sims[$i]->keywords) > 0 && count($sims[$j]->keywords) > 0) {
            $sim = $sims[$i]->countSimilarity($sims[$j]);
            if ($sim > 0 && $i != $j) {
                $sc[$sims[$j]->code] = $sim;
            }
        }
    }
    arsort($sc);
    $finalsc = array();
    while ($course_name = current($sc)) {
        $code = key($sc);
        foreach ($sims as $course) {
            if ($course->code == $code) {
                $finalsc[] = $course;
            }
        }
        next($sc);
    }
    $similiarcourses[$sims[$i]->code] = $finalsc;
}

?>

<!-- Nettisivun pohjaa? search.php ei täysin hiottu -->
<html>
    <head>
        <title>Recommender test</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>
        .hiddenRow {
            padding: 0 !important;
        }
        </style>
    </head>
    <body>
        <form action="/action_page.php" method="get">
            <input type="checkbox" name="vehicle" value="1" onclick="checkAddress(this)" checked> Period 1<br>
            <input type="checkbox" name="vehicle" value="2" onclick="checkAddress(this)" checked> Period 2<br>
            <input type="checkbox" name="vehicle" value="3" onclick="checkAddress(this)" checked> Period 3<br>
            <input type="checkbox" name="vehicle" value="4" onclick="checkAddress(this)" checked> Period 4<br>
        </form>
        <h1>Recommended based on other students</h1>
        <p id = "list"></p>
    </body>
</html>

<script>
var periods = ["1", "2", "3", "4"];

var recommended = <?php echo json_encode($sims); ?>;
var similiarcourses = <?php echo json_encode($similiarcourses); ?>;
console.log(similiarcourses);
//console.log(recommended);
console.log(similiarcourses["LUOYY004"]);
createOutput(recommended);


function createOutput(recommended) {
    var courses = "<table class='table table-hover' style='border-collapse:collapse;'><thead><tr><th>Code</th><th>Name</th><th>Periods</th><th>Credits</th><th>Language</th></tr></thead><tbody>";

    for (var i = 0; i < recommended.length; i++) {
        var credits;
        if (recommended[i]["minects"] == recommended[i]["maxects"]) {
            credits = recommended[i]["minects"];
        } else {
            credits = recommended[i]["minects"] + "-" + recommended[i]["maxects"];
        }
        courses = courses + "<tr data-toggle='collapse' data-target='#demo" + i + "' class='accordion-toggle'><td>" + recommended[i]["code"] + "</td><td>" + recommended[i]["name"] + "</td><td>" + recommended[i]["periods"] + "</td><td>" + credits + "</td><td>" + recommended[i]["language"] + "</td></tr>";
        courses = courses + "<tr><td colspan='6' class='hiddenRow'><div class='accordian-body collapse' id='demo" + i + "'><a href = https://www10.uta.fi/opas/opetusohjelma/marjapuuro.htm?id="+recommended[i]["id"]+">More information from UTA teaching schedule</a>";
        
        if (similiarcourses[recommended[i]["code"]].length > 0) {
            courses = courses + "<br><h4>Similiar courses to "+recommended[i]["name"]+"</h4>";
            courses = courses + "<br><table>";
        };

        for (var j = 0; j < similiarcourses[recommended[i]["code"]].length; j++) {
            courses = courses + "<tr><td>" + similiarcourses[recommended[i]["code"]][j]["code"] + "</td><td>" + similiarcourses[recommended[i]["code"]][j]["name"] + "</td><td>" + credits + " ECTS</td><td>, "+similiarcourses[recommended[i]["code"]][j]["language"]+"</td></tr>";
            if (j == 4) {
                break;
            };
        };
        courses = courses + "</table></div></td></tr>";
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
                if (recommended[i]["periods"].includes(periods[j])) {
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
                if (recommended[i]["periods"].includes(periods[j])) {
                    periodRecs.push(recommended[i]);
                    break;
                };
            }   
        }
        createOutput(periodRecs);
    }
}
</script>