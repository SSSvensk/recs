<?php 

class Student {
	public $number;
	public $name;
	public $courses = array();
	public $importance = array();

	public function __construct($sn, $n) {
		$this->number = $sn;
		$this->name = $n;
	}

	public function setCourses($c) {
		$this->courses = $c;
	}

	//Importance for keywords

	public function setImportance($imp) {
		$this->importance = $imp;
	}

	//Counting the Jaccard similarity between two students

	public function countSimilarity($s) {
		$intersect = 0;
		foreach($this->courses as $course) {
			foreach($s->courses as $othercourse) {
				if ($course->code == $othercourse->code) {
					$intersect++;
				}
			}
		} 

		$similarity = $intersect / (count($this->courses) + count($s->courses) - $intersect);
		return $similarity;;
	}
}