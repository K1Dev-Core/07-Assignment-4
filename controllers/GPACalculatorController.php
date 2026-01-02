<?php
require_once 'models/CourseModel.php';
require_once 'models/GradeModel.php';
require_once 'views/GPACalculatorView.php';

class GPACalculatorController {
    public function index() {
        $courseModel = new CourseModel();
        $gradeModel = new GradeModel();
        
        $courses = $courseModel->getCourseList();
        $grades = $gradeModel->getGrades();
        $gpa = $gradeModel->calculateGPA();
        
        $view = new GPACalculatorView();
        $view->render($courses, $grades, $gpa);
    }
}
