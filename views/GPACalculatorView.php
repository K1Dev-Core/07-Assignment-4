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
        <div class="container mx-auto px-4 sm:px-6 py-4">
            <div class="flex justify-between items-center">
                <h1 class="text-xl sm:text-2xl font-bold"><i class="fas fa-calculator mr-2"></i><span class="hidden sm:inline">คำนวณ GPA</span><span class="sm:hidden">GPA</span></h1>
                <button id="mobileMenuBtn" class="md:hidden text-white p-2">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <nav id="mainNav" class="hidden md:flex gap-4 lg:gap-6">
                    <a href="index.php" class="text-emerald-300 hover:text-emerald-200 transition"><i class="fas fa-home mr-1"></i><span class="hidden lg:inline">หน้าหลัก</span><span class="lg:hidden">หน้า</span></a>
                    <a href="manage_courses.php" class="text-emerald-300 hover:text-emerald-200 transition"><i class="fas fa-book mr-1"></i><span class="hidden lg:inline">จัดการรายวิชา</span><span class="lg:hidden">วิชา</span></a>
                    <a href="add_grade.php" class="text-emerald-300 hover:text-emerald-200 transition"><i class="fas fa-plus-circle mr-1"></i><span class="hidden lg:inline">เพิ่มเกรด</span><span class="lg:hidden">เกรด</span></a>
                    <a href="gpa_calculator.php" class="font-bold text-emerald-100 hover:text-emerald-200 transition underline-offset-4 underline"><i class="fas fa-calculator mr-1"></i><span class="hidden lg:inline">คำนวณ GPA</span><span class="lg:hidden">GPA</span></a>
                </nav>
            </div>
            <nav id="mobileNav" class="hidden md:hidden mt-4 space-y-2">
                <a href="index.php" class="block py-2 px-4 rounded hover:bg-emerald-700 transition"><i class="fas fa-home mr-2"></i>หน้าหลัก</a>
                <a href="manage_courses.php" class="block py-2 px-4 rounded hover:bg-emerald-700 transition"><i class="fas fa-book mr-2"></i>จัดการรายวิชา</a>
                <a href="add_grade.php" class="block py-2 px-4 rounded hover:bg-emerald-700 transition"><i class="fas fa-plus-circle mr-2"></i>เพิ่มเกรด</a>
                <a href="gpa_calculator.php" class="block py-2 px-4 rounded hover:bg-emerald-700 transition"><i class="fas fa-calculator mr-2"></i>คำนวณ GPA</a>
            </nav>
        </div>
    </header>
    <script>
        document.getElementById('mobileMenuBtn')?.addEventListener('click', function() {
            const mobileNav = document.getElementById('mobileNav');
            mobileNav?.classList.toggle('hidden');
        });
    </script>

    <main class="container mx-auto px-4 sm:px-6 py-6 sm:py-12 flex-grow">
        <?php require_once 'views/components/FlashMessages.php'; ?>
        <div class="bg-white rounded-lg shadow-xl overflow-hidden mb-4 sm:mb-6">
            <div class="bg-gradient-to-r from-emerald-600 to-teal-700 text-white py-6 sm:py-8 px-4 sm:px-6">
                <div class="text-center">
                    <p class="text-base sm:text-lg mb-2"><i class="fas fa-trophy mr-2"></i>เกรดเฉลี่ยสะสม (GPA)</p>
                    <p class="text-4xl sm:text-5xl font-bold"><?php echo number_format($gpa, 2); ?></p>
                    <p class="text-emerald-100 text-xs sm:text-sm mt-2">
                        <?php if (empty($grades)): ?>
                            <i class="fas fa-info-circle mr-1"></i>ยังไม่มีข้อมูลเกรด
                        <?php else: ?>
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
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-xl overflow-hidden mb-4 sm:mb-6">
            <div class="bg-gradient-to-r from-emerald-600 to-teal-700 text-white py-4 sm:py-6 px-4 sm:px-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                <h2 class="text-xl sm:text-2xl font-bold"><i class="fas fa-list-alt mr-2"></i>รายละเอียดเกรด</h2>
                <?php if (!empty($grades)): ?>
                    <a href="#" onclick="confirmAction('คุณต้องการลบข้อมูลทั้งหมด (รายวิชาและเกรด) หรือไม่?', 'clear_all.php'); return false;" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg transition text-sm sm:text-base whitespace-nowrap">
                        <i class="fas fa-trash-alt mr-2"></i>ลบข้อมูลทั้งหมด
                    </a>
                <?php endif; ?>
            </div>
            <div class="p-4 sm:p-6">
                <?php if (empty($grades)): ?>
                    <div class="text-center py-8 sm:py-12">
                        <i class="fas fa-inbox text-gray-300 text-5xl sm:text-6xl mb-4"></i>
                        <p class="text-gray-500 text-base sm:text-lg mb-2">ยังไม่มีข้อมูลเกรด</p>
                        <p class="text-gray-400 text-sm sm:text-base mb-6">เพิ่มเกรดเพื่อเริ่มคำนวณ GPA</p>
                        <a href="add_grade.php" class="inline-block bg-gradient-to-r from-emerald-600 to-teal-600 text-white py-2.5 px-6 rounded-lg hover:from-emerald-700 hover:to-teal-700 transition text-sm sm:text-base">
                            <i class="fas fa-plus-circle mr-2"></i>เพิ่มเกรดแรก
                        </a>
                    </div>
                <?php else: ?>
                    <div class="overflow-x-auto -mx-4 sm:mx-0">
                        <div class="inline-block min-w-full align-middle">
                            <table class="min-w-full border-collapse">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="border border-gray-300 px-3 sm:px-4 py-2 sm:py-3 text-left font-semibold text-gray-700 text-xs sm:text-sm">ลำดับ</th>
                                        <th class="border border-gray-300 px-3 sm:px-4 py-2 sm:py-3 text-left font-semibold text-gray-700 text-xs sm:text-sm">รายวิชา</th>
                                        <th class="border border-gray-300 px-3 sm:px-4 py-2 sm:py-3 text-left font-semibold text-gray-700 text-xs sm:text-sm">หน่วยกิต</th>
                                        <th class="border border-gray-300 px-3 sm:px-4 py-2 sm:py-3 text-left font-semibold text-gray-700 text-xs sm:text-sm">เกรด</th>
                                        <th class="border border-gray-300 px-3 sm:px-4 py-2 sm:py-3 text-left font-semibold text-gray-700 text-xs sm:text-sm">Grade Point</th>
                                        <th class="border border-gray-300 px-3 sm:px-4 py-2 sm:py-3 text-left font-semibold text-gray-700 text-xs sm:text-sm">การจัดการ</th>
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
                                            <td class="border border-gray-300 px-3 sm:px-4 py-2 sm:py-3 text-xs sm:text-sm"><?php echo $index + 1; ?></td>
                                            <td class="border border-gray-300 px-3 sm:px-4 py-2 sm:py-3 text-xs sm:text-sm"><?php echo htmlspecialchars($courseName); ?></td>
                                            <td class="border border-gray-300 px-3 sm:px-4 py-2 sm:py-3 text-xs sm:text-sm"><?php echo $credit; ?></td>
                                            <td class="border border-gray-300 px-3 sm:px-4 py-2 sm:py-3 text-xs sm:text-sm"><?php echo $grade; ?></td>
                                            <td class="border border-gray-300 px-3 sm:px-4 py-2 sm:py-3 text-xs sm:text-sm"><?php echo number_format($gradePoint, 1); ?></td>
                                            <td class="border border-gray-300 px-3 sm:px-4 py-2 sm:py-3">
                                                <a href="#" onclick="confirmAction('คุณต้องการลบเกรด &quot;<?php echo htmlspecialchars($grade, ENT_QUOTES); ?>&quot; ของรายวิชา &quot;<?php echo htmlspecialchars($courseName, ENT_QUOTES); ?>&quot; หรือไม่?', 'clear_grade.php?index=<?php echo $index; ?>'); return false;" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-2 sm:px-3 rounded transition text-xs sm:text-sm">
                                                    <i class="fas fa-trash mr-1"></i><span class="hidden sm:inline">ลบ</span>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr class="bg-gray-100 font-semibold">
                                        <td colspan="2" class="border border-gray-300 px-3 sm:px-4 py-2 sm:py-3 text-right text-xs sm:text-sm">รวม</td>
                                        <td class="border border-gray-300 px-3 sm:px-4 py-2 sm:py-3 text-xs sm:text-sm"><?php echo $totalCredits; ?></td>
                                        <td class="border border-gray-300 px-3 sm:px-4 py-2 sm:py-3 text-xs sm:text-sm">-</td>
                                        <td class="border border-gray-300 px-3 sm:px-4 py-2 sm:py-3 text-xs sm:text-sm">-</td>
                                        <td class="border border-gray-300 px-3 sm:px-4 py-2 sm:py-3">
                                            <a href="#" onclick="confirmAction('คุณต้องการลบเกรดทั้งหมดหรือไม่?', 'clear_all_grades.php'); return false;" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-1 px-2 sm:px-3 rounded transition text-xs sm:text-sm">
                                                <i class="fas fa-trash-alt mr-1"></i><span class="hidden sm:inline">ลบทั้งหมด</span><span class="sm:hidden">ลบ</span>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <?php require_once 'views/components/ConfirmModal.php'; ?>

    <footer class="bg-gradient-to-r from-emerald-600 to-teal-700 text-white mt-auto">
        <div class="container mx-auto px-4 sm:px-6 py-4 sm:py-6">
            <div class="text-center">
                <p class="text-emerald-100 text-sm sm:text-base">© 2025 ระบบคำนวณ GPA สงวนลิขสิทธิ์</p>
            </div>
        </div>
    </footer>
</body>
</html>
        <?php
    }
}
