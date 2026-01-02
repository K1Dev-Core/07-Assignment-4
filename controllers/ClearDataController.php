<?php
require_once 'models/GradeModel.php';
require_once 'models/CourseModel.php';
require_once 'helpers/FlashMessage.php';

class ClearDataController {
    public function clearGrade() {
        if (isset($_GET['index'])) {
            $index = intval($_GET['index']);
            $model = new GradeModel();
            $grades = $model->getGrades();
            
            if (isset($grades[$index])) {
                $gradeData = $grades[$index];
                $model->deleteGrade($index);
                FlashMessage::success('ลบเกรด "' . htmlspecialchars($gradeData['grade']) . '" ของรายวิชา "' . htmlspecialchars($gradeData['name']) . '" สำเร็จแล้ว');
            } else {
                FlashMessage::error('ไม่พบเกรดที่ต้องการลบ');
            }
        }
        
        header('Location: gpa_calculator.php');
        exit;
    }

    public function clearAllGrades() {
        $model = new GradeModel();
        $count = count($model->getGrades());
        $model->clearAllGrades();
        
        if ($count > 0) {
            FlashMessage::success('ลบเกรดทั้งหมด (' . $count . ' รายการ) สำเร็จแล้ว');
        } else {
            FlashMessage::info('ไม่มีเกรดให้ลบ');
        }
        
        header('Location: gpa_calculator.php');
        exit;
    }

    public function clearAllCourses() {
        $model = new CourseModel();
        $count = count($model->getCourseList());
        $model->clearAllCourses();
        
        if ($count > 0) {
            FlashMessage::success('ลบรายวิชาทั้งหมด (' . $count . ' รายการ) สำเร็จแล้ว');
        } else {
            FlashMessage::info('ไม่มีรายวิชาให้ลบ');
        }
        
        header('Location: manage_courses.php');
        exit;
    }

    public function clearAll() {
        $courseModel = new CourseModel();
        $gradeModel = new GradeModel();
        $courseCount = count($courseModel->getCourseList());
        $gradeCount = count($gradeModel->getGrades());
        
        unset($_SESSION['courses']);
        unset($_SESSION['course_list']);
        
        FlashMessage::success('ลบข้อมูลทั้งหมดสำเร็จแล้ว (รายวิชา ' . $courseCount . ' รายการ, เกรด ' . $gradeCount . ' รายการ)');
        
        header('Location: index.php');
        exit;
    }
}
