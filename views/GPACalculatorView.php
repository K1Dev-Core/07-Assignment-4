<?php
require_once 'models/GradeModel.php';

class GPACalculatorView {
    public function render($courses, $grades, $gpa) {
        $gradeModel = new GradeModel();
        ?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>คำนวณ GPA</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-6xl mx-auto">
            <div class="bg-white rounded-lg shadow-xl p-8 mb-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-6">คำนวณ GPA</h1>
                
                <?php if (empty($grades)): ?>
                    <p class="text-gray-500 text-center py-8 mb-6">ยังไม่มีข้อมูลเกรด</p>
                <?php else: ?>
                    <div class="mb-6">
                        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg p-6 text-white">
                            <div class="text-center">
                                <p class="text-lg mb-2">เกรดเฉลี่ยสะสม (GPA)</p>
                                <p class="text-5xl font-bold"><?php echo number_format($gpa, 2); ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border border-gray-300 px-4 py-3 text-left font-semibold text-gray-700">ลำดับ</th>
                                    <th class="border border-gray-300 px-4 py-3 text-left font-semibold text-gray-700">รายวิชา</th>
                                    <th class="border border-gray-300 px-4 py-3 text-left font-semibold text-gray-700">หน่วยกิต</th>
                                    <th class="border border-gray-300 px-4 py-3 text-left font-semibold text-gray-700">เกรด</th>
                                    <th class="border border-gray-300 px-4 py-3 text-left font-semibold text-gray-700">Grade Point</th>
                                    <th class="border border-gray-300 px-4 py-3 text-left font-semibold text-gray-700">Weighted Points</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $totalCredits = 0;
                                $totalWeightedPoints = 0;
                                foreach ($grades as $index => $gradeData): 
                                    $courseName = $gradeData['name'];
                                    $grade = $gradeData['grade'];
                                    $credit = 0;
                                    
                                    foreach ($courses as $course) {
                                        if ($course['name'] === $courseName) {
                                            $credit = $course['credit'];
                                            break;
                                        }
                                    }
                                    
                                    $gradePoint = $gradeModel->getGradePoint($grade);
                                    $weightedPoints = $gradePoint * $credit;
                                    $totalCredits += $credit;
                                    $totalWeightedPoints += $weightedPoints;
                                ?>
                                    <tr class="hover:bg-gray-50">
                                        <td class="border border-gray-300 px-4 py-3"><?php echo $index + 1; ?></td>
                                        <td class="border border-gray-300 px-4 py-3"><?php echo htmlspecialchars($courseName); ?></td>
                                        <td class="border border-gray-300 px-4 py-3"><?php echo $credit; ?></td>
                                        <td class="border border-gray-300 px-4 py-3"><?php echo $grade; ?></td>
                                        <td class="border border-gray-300 px-4 py-3"><?php echo number_format($gradePoint, 1); ?></td>
                                        <td class="border border-gray-300 px-4 py-3"><?php echo number_format($weightedPoints, 2); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr class="bg-gray-100 font-semibold">
                                    <td colspan="2" class="border border-gray-300 px-4 py-3 text-right">รวม</td>
                                    <td class="border border-gray-300 px-4 py-3"><?php echo $totalCredits; ?></td>
                                    <td class="border border-gray-300 px-4 py-3">-</td>
                                    <td class="border border-gray-300 px-4 py-3">-</td>
                                    <td class="border border-gray-300 px-4 py-3"><?php echo number_format($totalWeightedPoints, 2); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>

            <div class="flex gap-4">
                <a href="add_grade.php" class="flex-1 bg-green-500 hover:bg-green-600 text-white font-semibold py-3 px-6 rounded-lg text-center transition duration-200 shadow-md hover:shadow-lg">
                    เพิ่มเกรด
                </a>
                <a href="manage_courses.php" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 px-6 rounded-lg text-center transition duration-200 shadow-md hover:shadow-lg">
                    จัดการรายวิชา
                </a>
                <a href="index.php" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 px-6 rounded-lg text-center transition duration-200 shadow-md hover:shadow-lg">
                    กลับหน้าหลัก
                </a>
            </div>
        </div>
    </div>
</body>
</html>
        <?php
    }
}
