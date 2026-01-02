<?php
require_once 'models/CourseModel.php';
require_once 'models/GradeModel.php';
require_once 'views/AddGradeView.php';
require_once 'helpers/FlashMessage.php';

class AddGradeController {
    public function index() {
        $courseModel = new CourseModel();
        $courses = $courseModel->getCourseList();
        
        $view = new AddGradeView();
        $view->render($courses);
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['course_name']) && isset($_POST['grade'])) {
            $courseName = trim($_POST['course_name']);
            $grade = trim($_POST['grade']);
            
            if (!empty($courseName) && !empty($grade)) {
                $model = new GradeModel();
                $model->addGrade($courseName, $grade);
                FlashMessage::success('เพิ่มเกรด "' . htmlspecialchars($grade) . '" สำหรับรายวิชา "' . htmlspecialchars($courseName) . '" สำเร็จแล้ว');
            } else {
                FlashMessage::error('กรุณาเลือกรายวิชาและเกรด');
            }
        }
        
        header('Location: add_grade.php');
        exit;
    }
}
