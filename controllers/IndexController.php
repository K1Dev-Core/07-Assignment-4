<?php
require_once 'models/CourseModel.php';
require_once 'views/IndexView.php';

class IndexController {
    public function index() {
        $view = new IndexView();
        $view->render();
    }
}
