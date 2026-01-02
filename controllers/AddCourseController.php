<?php
require_once 'models/CourseModel.php';

class AddCourseController {
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name']) && isset($_POST['credit'])) {
            $name = trim($_POST['name']);
            $credit = floatval($_POST['credit']);
            
            if (!empty($name) && $credit > 0) {
                $model = new CourseModel();
                $model->addCourse($name, $credit);
            }
        }
        
        header('Location: manage_courses.php');
        exit;
    }
}
