<?php

//PHP-file to get data from database and creating arrays.

require_once("course.php");
require_once("student.php");

//Getting courses data and making array.

$result = $conn->query("SELECT * FROM course");
$courses = array();

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	$c = new Course($row["id"], $row["code"], $row["name"], $row["subject"], $row["language"], $row["periods"], $row["minects"], $row["maxects"]);
    	$keywords = array();
    	   $keys = $conn->query("SELECT keyword.word FROM keyword, includes WHERE keyword.id = includes.kid AND includes.ccode = '". $c->code ."'");
    	   while($keyrow = $keys->fetch_assoc()) {
    	    $keywords[] = $keyrow;
    	   }
    	   $c->addKeywords($keywords);
        $courses[] = $c;
    }
}
$GLOBALS['courses'] = $courses;

//----
//Loading students.

$result = $conn->query("SELECT * FROM student");
$students = array();

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	$s = new Student($row["number"], $row["name"]);
    	$importances = array();
    	$imps = $conn->query("SELECT keyword.word, keyword.id, COUNT(*) as importance FROM course, attends, student, includes, keyword WHERE student.number = '". $s->number . "' AND student.number = attends.stnumb AND attends.coursecode = course.code AND course.code = includes.ccode AND includes.kid = keyword.id GROUP BY keyword.word ORDER BY importance DESC");
    	while($improw = $imps->fetch_assoc()) {
    		$importances[] = $improw;
    	}
    	$s->setImportance($importances);
    	$sc = array();
    	$coursesByStudent = $conn->query("SELECT course.id, course.code, course.name, course.subject, course.language, course.periods, course.minects, course.maxects FROM course, attends WHERE course.code = attends.coursecode AND attends.stnumb = '". $s->number ."'");
        while($row = $coursesByStudent->fetch_assoc()) {
            //if ($row["periods"] != NULL && $row["subject"] != NULL) {
            $c = new Course($row["id"], $row["code"], $row["name"], $row["subject"], $row["language"], $row["periods"], $row["minects"], $row["maxects"]);
            $keywords = array();
            $keys = $conn->query("SELECT keyword.word FROM keyword, includes WHERE keyword.id = includes.kid AND includes.ccode = '". $c->code ."'");
            while($keyrow = $keys->fetch_assoc()) {
                $keywords[] = $keyrow;
            }
            $c->addKeywords($keywords);
    		$sc[] = $c;
            //}
    	}
    	$s->setCourses($sc);
        $students[] = $s;
    }
}
$GLOBALS['students'] = $students;


?>