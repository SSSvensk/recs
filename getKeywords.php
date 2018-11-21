<?php

require_once("dbconn.php");

//Nyt kyselyyn on kovakoodattu yksi opiskelijanumero. Se täytyy muuttaa myöhemmin, mutta nyt vain demotaan kyselyn toimivuutta.
$GLOBALS['keywords'] = $conn->query("SELECT keyword.word, keyword.id, COUNT(*) as importance FROM course, attends, student, includes, keyword WHERE student.number = 98607 AND student.number = attends.stnumb AND attends.coursecode = course.code AND course.code = includes.ccode AND includes.kid = keyword.id GROUP BY keyword.word ORDER BY importance DESC");

//TODO: Muotoilu listaksi ja vertailu muihin kursseihin.
?>