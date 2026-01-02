<?php
class GradeModel {
    public function getGrades() {
        return isset($_SESSION['courses']) ? $_SESSION['courses'] : [];
    }

    public function addGrade($courseName, $grade) {
        if (!isset($_SESSION['courses'])) {
            $_SESSION['courses'] = [];
        }
        $_SESSION['courses'][] = [
            'name' => $courseName,
            'grade' => $grade
        ];
    }

    public function getGradePoint($grade) {
        $gradePoints = [
            'A' => 4.0,
            'B+' => 3.5,
            'B' => 3.0,
            'C+' => 2.5,
            'C' => 2.0,
            'D+' => 1.5,
            'D' => 1.0,
            'F' => 0.0
        ];
        return isset($gradePoints[$grade]) ? $gradePoints[$grade] : 0.0;
    }

    public function calculateGPA() {
        $grades = $this->getGrades();
        $courseList = isset($_SESSION['course_list']) ? $_SESSION['course_list'] : [];
        
        if (empty($grades)) {
            return 0.0;
        }

        $totalWeightedPoints = 0;
        $totalCredits = 0;

        foreach ($grades as $gradeData) {
            $courseName = $gradeData['name'];
            $grade = $gradeData['grade'];
            
            foreach ($courseList as $course) {
                if ($course['name'] === $courseName) {
                    $credit = $course['credit'];
                    $gradePoint = $this->getGradePoint($grade);
                    $totalWeightedPoints += $gradePoint * $credit;
                    $totalCredits += $credit;
                    break;
                }
            }
        }

        return $totalCredits > 0 ? $totalWeightedPoints / $totalCredits : 0.0;
    }
}
