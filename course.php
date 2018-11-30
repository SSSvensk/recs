<?php

class Course {
	public $id;
	public $code;
	public $name;
	public $subject;
	public $language;
	public $periods;
	public $minects;
	public $maxects;
	public $keywords = array();

	public function __construct($cid, $ccode, $cname, $csubject = "UTA", $clanguage, $cperiods = "", $cminects, $cmaxects) {
		$this->id = $cid;
		$this->code = $ccode;
		$this->name = $cname;
		$this->subject = $csubject;
		$this->language = $clanguage;
		$this->periods = $cperiods;
		$this->minects = $cminects;
		$this->maxects = $cmaxects;
	}

	public function addKeywords($kw) {
		$this->keywords = $kw;
	}

	public function countSimilarity($s) {
		$intersect = 0;
		foreach($this->keywords as $keyword) {
			foreach($s->keywords as $otherkeyword) {
				if ($keyword == $otherkeyword) {
					$intersect++;
				}
			}
		} 

		$similarity = $intersect / (count($this->keywords) + count($s->keywords) - $intersect);
		return $similarity;
	}
}

?>