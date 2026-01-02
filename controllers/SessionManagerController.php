<?php
require_once 'models/CourseModel.php';
require_once 'models/GradeModel.php';
require_once 'views/SessionManagerView.php';

class SessionManagerController {
    public function index() {
        $courseModel = new CourseModel();
        $gradeModel = new GradeModel();
        
        $courses = $courseModel->getCourseList();
        $grades = $gradeModel->getGrades();
        
        $view = new SessionManagerView();
        $view->render($courses, $grades);
    }

    public function clearSession() {
        if (isset($_POST['clear_type'])) {
            $clearType = $_POST['clear_type'];
            
            switch ($clearType) {
                case 'courses':
                    unset($_SESSION['course_list']);
                    $_SESSION['course_list'] = [];
                    break;
                case 'grades':
                    unset($_SESSION['courses']);
                    $_SESSION['courses'] = [];
                    break;
                case 'all':
                    unset($_SESSION['course_list']);
                    unset($_SESSION['courses']);
                    $_SESSION['course_list'] = [];
                    $_SESSION['courses'] = [];
                    break;
            }
        }
        
        header('Location: session_manager.php');
        exit;
    }
}
