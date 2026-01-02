<?php
require_once 'models/GradeModel.php';
require_once 'models/CourseModel.php';

class ClearDataController {
    public function clearGrade() {
        if (isset($_GET['index'])) {
            $index = intval($_GET['index']);
            $model = new GradeModel();
            $model->deleteGrade($index);
        }
        
        header('Location: gpa_calculator.php');
        exit;
    }

    public function clearAllGrades() {
        $model = new GradeModel();
        $model->clearAllGrades();
        
        header('Location: gpa_calculator.php');
        exit;
    }

    public function clearAllCourses() {
        $model = new CourseModel();
        $model->clearAllCourses();
        
        header('Location: manage_courses.php');
        exit;
    }

    public function clearAll() {
        unset($_SESSION['courses']);
        unset($_SESSION['course_list']);
        
        header('Location: index.php');
        exit;
    }
}
