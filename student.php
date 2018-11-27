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

	public function setImportance($imp) {
		$this->importance = $imp;
	}
}