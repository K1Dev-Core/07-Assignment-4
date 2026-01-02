<?php
class CourseModel {
    public function getCourseList() {
        return isset($_SESSION['course_list']) ? $_SESSION['course_list'] : [];
    }

    public function addCourse($name, $credit) {
        if (!isset($_SESSION['course_list'])) {
            $_SESSION['course_list'] = [];
        }
        $_SESSION['course_list'][] = [
            'name' => $name,
            'credit' => $credit
        ];
    }

    public function deleteCourse($index) {
        if (isset($_SESSION['course_list'][$index])) {
            $courseName = $_SESSION['course_list'][$index]['name'];
            
            if (isset($_SESSION['courses'])) {
                foreach ($_SESSION['courses'] as $grade) {
                    if ($grade['name'] === $courseName) {
                        return false;
                    }
                }
            }
            
            unset($_SESSION['course_list'][$index]);
            $_SESSION['course_list'] = array_values($_SESSION['course_list']);
            return true;
        }
        return false;
    }

    public function isCourseUsed($courseName) {
        if (isset($_SESSION['courses'])) {
            foreach ($_SESSION['courses'] as $grade) {
                if ($grade['name'] === $courseName) {
                    return true;
                }
            }
        }
        return false;
    }
}
