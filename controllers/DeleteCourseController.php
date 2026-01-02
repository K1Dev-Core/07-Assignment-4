<?php
require_once 'models/CourseModel.php';
require_once 'helpers/FlashMessage.php';

class DeleteCourseController {
    public function delete() {
        if (isset($_GET['index'])) {
            $index = intval($_GET['index']);
            $model = new CourseModel();
            $courseList = $model->getCourseList();
            
            if (isset($courseList[$index])) {
                $courseName = $courseList[$index]['name'];
                
                if ($model->deleteCourse($index)) {
                    FlashMessage::success('ลบรายวิชา "' . htmlspecialchars($courseName) . '" สำเร็จแล้ว');
                } else {
                    FlashMessage::error('ไม่สามารถลบรายวิชา "' . htmlspecialchars($courseName) . '" ได้ เนื่องจากมีเกรดอยู่แล้ว');
                }
            } else {
                FlashMessage::error('ไม่พบรายวิชาที่ต้องการลบ');
            }
        }
        
        header('Location: manage_courses.php');
        exit;
    }
}
