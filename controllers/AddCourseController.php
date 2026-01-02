<?php
require_once 'models/CourseModel.php';
require_once 'helpers/FlashMessage.php';

class AddCourseController {
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name']) && isset($_POST['credit'])) {
            $name = trim($_POST['name']);
            $credit = floatval($_POST['credit']);
            
            if (!empty($name) && $credit > 0) {
                $model = new CourseModel();
                $model->addCourse($name, $credit);
                FlashMessage::success('เพิ่มรายวิชา "' . htmlspecialchars($name) . '" สำเร็จแล้ว');
            } else {
                FlashMessage::error('กรุณากรอกข้อมูลให้ครบถ้วน');
            }
        }
        
        header('Location: manage_courses.php');
        exit;
    }
}
