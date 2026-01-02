<?php
class AddGradeView {
    public function render($courses) {
        ?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มเกรด</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <header class="bg-gradient-to-r from-emerald-600 to-teal-700 text-white shadow-lg">
        <div class="container mx-auto px-4 sm:px-6 py-4">
            <div class="flex justify-between items-center">
                <h1 class="text-xl sm:text-2xl font-bold"><i class="fas fa-plus-circle mr-2"></i><span class="hidden sm:inline">เพิ่มเกรด</span><span class="sm:hidden">เกรด</span></h1>
                <button id="mobileMenuBtn" class="md:hidden text-white p-2">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <nav id="mainNav" class="hidden md:flex gap-4 lg:gap-6">
                    <a href="index.php" class="text-emerald-300 hover:text-emerald-200 transition"><i class="fas fa-home mr-1"></i><span class="hidden lg:inline">หน้าหลัก</span><span class="lg:hidden">หน้า</span></a>
                    <a href="manage_courses.php" class="text-emerald-300 hover:text-emerald-200 transition"><i class="fas fa-book mr-1"></i><span class="hidden lg:inline">จัดการรายวิชา</span><span class="lg:hidden">วิชา</span></a>
                    <a href="add_grade.php" class="font-bold text-emerald-100 hover:text-emerald-200 transition underline-offset-4 underline"><i class="fas fa-plus-circle mr-1"></i><span class="hidden lg:inline">เพิ่มเกรด</span><span class="lg:hidden">เกรด</span></a>
                    <a href="gpa_calculator.php" class="text-emerald-300 hover:text-emerald-200 transition"><i class="fas fa-calculator mr-1"></i><span class="hidden lg:inline">คำนวณ GPA</span><span class="lg:hidden">GPA</span></a>
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
        <div class="bg-white rounded-lg shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-emerald-600 to-teal-700 text-white py-4 sm:py-6 px-4 sm:px-6">
                <h2 class="text-xl sm:text-2xl font-bold"><i class="fas fa-edit mr-2"></i>บันทึกเกรด</h2>
            </div>
            <div class="p-4 sm:p-6">
                <?php if (empty($courses)): ?>
                    <div class="text-center py-8">
                        <i class="fas fa-exclamation-triangle text-red-500 text-4xl mb-4"></i>
                        <p class="text-red-500 mb-4">ไม่มีรายวิชา กรุณาเพิ่มรายวิชาก่อน</p>
                        <a href="manage_courses.php" class="inline-block bg-gradient-to-r from-emerald-600 to-teal-600 text-white py-2 px-6 rounded-lg hover:from-emerald-700 hover:to-teal-700 transition">
                            <i class="fas fa-book mr-2"></i>ไปจัดการรายวิชา
                        </a>
                    </div>
                <?php else: ?>
                    <form action="add_grade.php" method="POST">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2"><i class="fas fa-book mr-2"></i>เลือกรายวิชา</label>
                            <select name="course_name" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm sm:text-base">
                                <option value="">-- เลือกรายวิชา --</option>
                                <?php foreach ($courses as $course): ?>
                                    <option value="<?php echo htmlspecialchars($course['name']); ?>">
                                        <?php echo htmlspecialchars($course['name']); ?> (<?php echo $course['credit']; ?> หน่วยกิต)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2"><i class="fas fa-star mr-2"></i>เกรด</label>
                            <select name="grade" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm sm:text-base">
                                <option value="">-- เลือกเกรด --</option>
                                <option value="A">A (4.0)</option>
                                <option value="B+">B+ (3.5)</option>
                                <option value="B">B (3.0)</option>
                                <option value="C+">C+ (2.5)</option>
                                <option value="C">C (2.0)</option>
                                <option value="D+">D+ (1.5)</option>
                                <option value="D">D (1.0)</option>
                                <option value="F">F (0.0)</option>
                            </select>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
                            <button type="submit" class="flex-1 bg-gradient-to-r from-emerald-600 to-teal-600 text-white py-2.5 px-4 rounded-lg hover:from-emerald-700 hover:to-teal-700 transition text-sm sm:text-base">
                                <i class="fas fa-check mr-2"></i>เพิ่มเกรด
                            </button>
                            <a href="gpa_calculator.php" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white py-2.5 px-4 rounded-lg text-center transition text-sm sm:text-base">
                                <i class="fas fa-times mr-2"></i>ยกเลิก
                            </a>
                        </div>
                    </form>
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
