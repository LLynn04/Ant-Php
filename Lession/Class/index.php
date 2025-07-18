<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

class Student {
    public $name;
    public $dept;
    public $score;

    public function __construct($name, $dept,$score) {
        $this->name = $name;
        $this->dept = $dept;
        $this->score = $score;

        if ($this->score >= 80) {
            echo "pass <br>";
        } else {
            echo "fail <br>";
        }
        return false;
    }
    
}
$result = new Student("John Doe", "CSE", 85);
echo "Student Name: " . $result->name . "And dept: ". $result->dept . "And score : " . $result->score;
