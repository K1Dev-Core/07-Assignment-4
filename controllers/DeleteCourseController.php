<?php
require_once 'models/CourseModel.php';

class DeleteCourseController {
    public function delete() {
        if (isset($_GET['index'])) {
            $index = intval($_GET['index']);
            $model = new CourseModel();
            $model->deleteCourse($index);
        }
        
        header('Location: manage_courses.php');
        exit;
    }
}
