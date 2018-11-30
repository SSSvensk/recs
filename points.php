<?php

function calculatePoints($courses, $student) {

    $pointranking = array();

    //Counting the points for each course in courselist
	foreach ($courses as $course) {
		$points = 0;
		foreach ($course->keywords as $keyword) {
			foreach ($student->importance as $interest) {
				if ($interest["word"] == $keyword["word"]) {
					$points += $interest["importance"];
				}
			}
		}

		//If the course has zero points, we don't recommend that course at all.
		if ($points > 0) {
			$addToTheList = true;

			//Checking courses that student has already done and not to add those.
			foreach ($student->courses as $studentCourse) {
				$addToTheList = true;
				if ($studentCourse->code == $course->code) {
					$addToTheList = false;
					break;
				}
			}

			//If the student hasn't attended on the course, it's added on the recommendations list
			if ($addToTheList) {
				$pointranking[$course->code] = $points;
			}
		}
	}

	//Sorting and returning the course ranking
	arsort($pointranking);

	return $pointranking;
}



?>