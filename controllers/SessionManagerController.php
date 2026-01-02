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
        require_once 'helpers/FlashMessage.php';
        
        $clearType = $_GET['clear_type'] ?? $_POST['clear_type'] ?? null;
        
        if ($clearType) {
            switch ($clearType) {
                case 'courses':
                    $count = count($_SESSION['course_list'] ?? []);
                    unset($_SESSION['course_list']);
                    $_SESSION['course_list'] = [];
                    FlashMessage::success('ลบรายวิชาทั้งหมด (' . $count . ' รายการ) สำเร็จแล้ว');
                    break;
                case 'grades':
                    $count = count($_SESSION['courses'] ?? []);
                    unset($_SESSION['courses']);
                    $_SESSION['courses'] = [];
                    FlashMessage::success('ลบเกรดทั้งหมด (' . $count . ' รายการ) สำเร็จแล้ว');
                    break;
                case 'all':
                    $courseCount = count($_SESSION['course_list'] ?? []);
                    $gradeCount = count($_SESSION['courses'] ?? []);
                    unset($_SESSION['course_list']);
                    unset($_SESSION['courses']);
                    $_SESSION['course_list'] = [];
                    $_SESSION['courses'] = [];
                    FlashMessage::success('ลบข้อมูลทั้งหมดสำเร็จแล้ว (รายวิชา ' . $courseCount . ' รายการ, เกรด ' . $gradeCount . ' รายการ)');
                    break;
            }
        }
        
        header('Location: session_manager.php');
        exit;
    }
}
