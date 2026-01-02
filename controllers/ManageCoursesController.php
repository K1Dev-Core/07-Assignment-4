<?php
require_once 'models/CourseModel.php';
require_once 'views/ManageCoursesView.php';

class ManageCoursesController {
    public function index() {
        $model = new CourseModel();
        $courses = $model->getCourseList();
        
        $view = new ManageCoursesView();
        $view->render($courses);
    }
}
