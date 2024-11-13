<?php
class Student{
	public $std_ID;
	public $std_Fname;
	public $std_Lname;
	public $std_MI;
	public $std_Email;
	public $std_pw;
	public $std_phoneNum;
	public $std_gradeLvl;
	
	function __construct($std_Fname, $std_Lname, $std_MI, $std_Email, $std_phoneNum, $std_gradeLvl){
		$this->std_Fname = $std_Fname;
		$this->std_Lname = $std_Lname;
		$this->std_MI = $std_MI;
		$this->std_Email = $std_Email;
		$this->std_phoneNum = $std_phoneNum;
		$this->std_gradeLvl = $std_gradeLvl;
		$this->std_pw = "std12345";
	}
	
	function __destruct() {
	}
	
}

class Teacher{
	public $teach_ID;
	public $teach_Fname;
	public $teach_Lname;
	public $teach_MI;
	public $teach_Email;
	public $teach_pw;
	public $teach_phoneNum;
	
	function __construct($teach_Fname, $teach_Lname, $teach_MI, $teach_Email, $teach_phoneNum){
		$this->teach_Fname = $teach_Fname;
		$this->teach_Lname = $teach_Lname;
		$this->teach_MI = $teach_MI;
		$this->teach_Email = $teach_Email;
		$this->teach_phoneNum = $teach_phoneNum;
		$this->teach_pw = "teach12345";
	}
	
	function __destruct() {
	}
	
}

class Subject{
	public $sub_ID;
	public $sub_name;
	public $sub_desc;
	public $sub_sched;
	public $sub_section;
	
	function __construct($sub_name, $sub_desc, $sub_sched, $sub_section){
		$this->sub_name = $sub_name;
		$this->sub_desc = $sub_desc;
		$this->sub_sched = $sub_sched;
		$this->sub_section = $sub_section;
	}
	
	function __destruct() {
	}
	
}

class Activity{
	public $act_ID;
	public $act_title;
	public $act_desc;
	public $act_link;
	public $act_weight;
	public $act_score;
	public $act_totalScore;
	public $act_percentage;
	public $act_type;
	public $act_deadline;
	public $act_subID;
	public $act_studID;
	
	function __construct($act_title, $act_desc, $act_link, $act_weight, $act_totalScore, $act_type, $act_deadline, $act_subID, $act_studID){
		$this->act_title = $act_title;
		$this->act_desc = $act_desc;
		$this->act_link = $act_link;
		$this->act_weight = $act_weight;
		$this->act_totalScore = $act_totalScore;
		$this->act_type = $act_type;
		$this->act_deadline = $act_deadline;
		$this->act_subID = $act_subID;
		$this->act_studID = $act_studID;
	}
	
	function __destruct() {
	}
	
}

class Content{
	public $content_ID;
	public $content_title;
	public $content_type;
	public $content_link;
	public $content_subID;
	public $content_TeachID;
	
	function __construct($content_title, $content_type, $content_link, $content_subID, $content_TeachID){
		$this->content_title = $content_title;
		$this->content_type = $content_type;
		$this->content_link = $content_link;
		$this->content_subID = $content_subID;
		$this->content_TeachID = $content_TeachID;
	}
	
	function __destruct() {
	}

}

class Enrollment{
	public $enroll_studID;
	public $enroll_subID;
	public $payment;
	public $stud_finalGrade;
	public $remarks;
	
	function __construct($enroll_studID, $enroll_subID, $payment){
		$this->enroll_studID = $enroll_studID;
		$this->enroll_subID = $enroll_subID;
		$this->payment = $payment;
	}
	
	function __destruct() {
	}
	
}

class Assignment{
	public $assign_teachID;
	public $assign_subID;
	
	function __construct($assign_teachID, $assign_subID){
		$assign_teachID = $assign_teachID;
		$assign_subID = $assign_subID;
	}
	
	function __destruct() {
	}

}
?>