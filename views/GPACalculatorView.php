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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <header class="bg-gradient-to-r from-emerald-600 to-teal-700 text-white shadow-lg">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold"><i class="fas fa-calculator mr-2"></i>คำนวณ GPA</h1>
            <nav class="flex gap-6">
                <a href="index.php" class="text-emerald-300 hover:text-emerald-200 transition"><i class="fas fa-home mr-1"></i>หน้าหลัก</a>
                <a href="manage_courses.php" class="text-emerald-300 hover:text-emerald-200 transition"><i class="fas fa-book mr-1"></i>จัดการรายวิชา</a>
                <a href="add_grade.php" class="text-emerald-300 hover:text-emerald-200 transition"><i class="fas fa-plus-circle mr-1"></i>เพิ่มเกรด</a>
                <a href="gpa_calculator.php" class="font-bold text-emerald-100 hover:text-emerald-200 transition underline-offset-4 underline"><i class="fas fa-calculator mr-1"></i>คำนวณ GPA</a>
            </nav>
        </div>
    </header>

    <main class="container mx-auto px-6 py-12 flex-grow">
        <?php require_once 'views/components/FlashMessages.php'; ?>
        <?php if (empty($grades)): ?>
            <div class="bg-white rounded-lg shadow-xl overflow-hidden">
                <div class="bg-gradient-to-r from-emerald-600 to-teal-700 text-white py-8 px-6">
                    <h2 class="text-3xl font-bold text-center">ยินดีต้อนรับสู่ระบบคำนวณ GPA</h2>
                </div>
                <div class="p-8 text-center">
                    <p class="text-gray-600 mb-6">เพิ่มเกรดเพื่อเริ่มคำนวณ GPA</p>
                    <a href="add_grade.php" class="inline-block bg-gradient-to-r from-emerald-600 to-teal-600 text-white py-2 px-6 rounded-lg hover:from-emerald-700 hover:to-teal-700 transition">
                        <i class="fas fa-plus-circle mr-2"></i>เพิ่มเกรดแรก
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                <div class="bg-white border-2 border-gray-200 rounded-lg p-6 hover:shadow-lg transition text-center">
                    <div class="text-center mb-4">
                        <i class="fas fa-plus-circle text-4xl text-emerald-600 mb-3"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">เพิ่มเกรด</h3>
                    <p class="text-gray-600 mb-4">บันทึกเกรดสำหรับรายวิชา</p>
                    <a href="add_grade.php" class="block w-full bg-gradient-to-r from-emerald-600 to-teal-600 text-white py-2 px-4 rounded-lg hover:from-emerald-700 hover:to-teal-700 transition"><i class="fas fa-plus-circle mr-2"></i>เพิ่มเกรด</a>
                </div>
                <div class="bg-white border-2 border-gray-200 rounded-lg p-6 hover:shadow-lg transition text-center">
                    <div class="text-center mb-4">
                        <i class="fas fa-book text-4xl text-emerald-600 mb-3"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">จัดการรายวิชา</h3>
                    <p class="text-gray-600 mb-4">เพิ่ม แก้ไข หรือลบรายวิชา</p>
                    <a href="manage_courses.php" class="block w-full bg-gradient-to-r from-emerald-600 to-teal-600 text-white py-2 px-4 rounded-lg hover:from-emerald-700 hover:to-teal-700 transition"><i class="fas fa-book mr-2"></i>จัดการรายวิชา</a>
                </div>
                <div class="bg-white border-2 border-gray-200 rounded-lg p-6 hover:shadow-lg transition text-center">
                    <div class="text-center mb-4">
                        <i class="fas fa-home text-4xl text-emerald-600 mb-3"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">กลับหน้าหลัก</h3>
                    <p class="text-gray-600 mb-4">กลับไปยังหน้าหลัก</p>
                    <a href="index.php" class="block w-full bg-gradient-to-r from-emerald-600 to-teal-600 text-white py-2 px-4 rounded-lg hover:from-emerald-700 hover:to-teal-700 transition"><i class="fas fa-home mr-2"></i>กลับหน้าหลัก</a>
                </div>
            </div>
        <?php else: ?>
            <div class="bg-white rounded-lg shadow-xl overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-emerald-600 to-teal-700 text-white py-8 px-6">
                    <div class="text-center">
                        <p class="text-lg mb-2"><i class="fas fa-trophy mr-2"></i>เกรดเฉลี่ยสะสม (GPA)</p>
                        <p class="text-5xl font-bold"><?php echo number_format($gpa, 2); ?></p>
                        <p class="text-emerald-100 text-sm mt-2">
                            <?php
                            $totalCredits = 0;
                            foreach ($grades as $gradeData) {
                                foreach ($courses as $course) {
                                    if ($course['name'] === $gradeData['name']) {
                                        $totalCredits += $course['credit'];
                                        break;
                                    }
                                }
                            }
                            echo "จาก " . count($grades) . " รายวิชา รวม " . $totalCredits . " หน่วยกิต";
                            ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-xl overflow-hidden mb-6">
                <div class="bg-gradient-to-r from-emerald-600 to-teal-700 text-white py-6 px-6 flex justify-between items-center">
                    <h2 class="text-2xl font-bold"><i class="fas fa-list-alt mr-2"></i>รายละเอียดเกรด</h2>
                    <a href="#" onclick="confirmAction('คุณต้องการลบข้อมูลทั้งหมด (รายวิชาและเกรด) หรือไม่?', 'clear_all.php'); return false;" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                        <i class="fas fa-trash-alt mr-2"></i>ลบข้อมูลทั้งหมด
                    </a>
                </div>
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border border-gray-300 px-4 py-3 text-left font-semibold text-gray-700">ลำดับ</th>
                                    <th class="border border-gray-300 px-4 py-3 text-left font-semibold text-gray-700">รายวิชา</th>
                                    <th class="border border-gray-300 px-4 py-3 text-left font-semibold text-gray-700">หน่วยกิต</th>
                                    <th class="border border-gray-300 px-4 py-3 text-left font-semibold text-gray-700">เกรด</th>
                                    <th class="border border-gray-300 px-4 py-3 text-left font-semibold text-gray-700">Grade Point</th>
                                    <th class="border border-gray-300 px-4 py-3 text-left font-semibold text-gray-700">การจัดการ</th>
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
                                        <td class="border border-gray-300 px-4 py-3">
                                            <a href="#" onclick="confirmAction('คุณต้องการลบเกรด &quot;<?php echo htmlspecialchars($grade, ENT_QUOTES); ?>&quot; ของรายวิชา &quot;<?php echo htmlspecialchars($courseName, ENT_QUOTES); ?>&quot; หรือไม่?', 'clear_grade.php?index=<?php echo $index; ?>'); return false;" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-3 rounded transition">
                                                <i class="fas fa-trash mr-1"></i>ลบ
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr class="bg-gray-100 font-semibold">
                                    <td colspan="2" class="border border-gray-300 px-4 py-3 text-right">รวม</td>
                                    <td class="border border-gray-300 px-4 py-3"><?php echo $totalCredits; ?></td>
                                    <td class="border border-gray-300 px-4 py-3">-</td>
                                    <td class="border border-gray-300 px-4 py-3">-</td>
                                    <td class="border border-gray-300 px-4 py-3">
                                        <a href="#" onclick="confirmAction('คุณต้องการลบเกรดทั้งหมดหรือไม่?', 'clear_all_grades.php'); return false;" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-1 px-3 rounded transition">
                                            <i class="fas fa-trash-alt mr-1"></i>ลบทั้งหมด
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </main>

    <?php require_once 'views/components/ConfirmModal.php'; ?>

    <footer class="bg-gradient-to-r from-emerald-600 to-teal-700 text-white mt-auto">
        <div class="container mx-auto px-6 py-6">
            <div class="text-center">
                <p class="text-emerald-100">© 2025 ระบบคำนวณ GPA สงวนลิขสิทธิ์</p>
            </div>
        </div>
    </footer>
</body>
</html>
        <?php
    }
}
