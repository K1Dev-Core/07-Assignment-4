<?php
class SessionManagerView {
    public function render($courses, $grades) {
        ?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการ Session</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <header class="bg-gradient-to-r from-emerald-600 to-teal-700 text-white shadow-lg">
        <div class="container mx-auto px-4 sm:px-6 py-4">
            <div class="flex justify-between items-center">
                <h1 class="text-xl sm:text-2xl font-bold"><i class="fas fa-cog mr-2"></i><span class="hidden sm:inline">จัดการ Session</span><span class="sm:hidden">Session</span></h1>
                <button id="mobileMenuBtn" class="md:hidden text-white p-2">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <nav id="mainNav" class="hidden md:flex gap-4 lg:gap-6">
                    <a href="index.php" class="text-emerald-300 hover:text-emerald-200 transition"><i class="fas fa-home mr-1"></i><span class="hidden lg:inline">หน้าหลัก</span><span class="lg:hidden">หน้า</span></a>
                    <a href="manage_courses.php" class="text-emerald-300 hover:text-emerald-200 transition"><i class="fas fa-book mr-1"></i><span class="hidden lg:inline">จัดการรายวิชา</span><span class="lg:hidden">วิชา</span></a>
                    <a href="add_grade.php" class="text-emerald-300 hover:text-emerald-200 transition"><i class="fas fa-plus-circle mr-1"></i><span class="hidden lg:inline">เพิ่มเกรด</span><span class="lg:hidden">เกรด</span></a>
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
        <div class="bg-white rounded-lg shadow-xl overflow-hidden mb-4 sm:mb-6">
            <div class="bg-gradient-to-r from-emerald-600 to-teal-700 text-white py-4 sm:py-6 px-4 sm:px-6">
                <h2 class="text-xl sm:text-2xl font-bold"><i class="fas fa-info-circle mr-2"></i>ข้อมูล Session</h2>
            </div>
            <div class="p-4 sm:p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6 mb-4 sm:mb-6">
                    <div class="bg-gray-50 rounded-lg p-3 sm:p-4">
                        <h3 class="text-base sm:text-lg font-semibold text-gray-800 mb-2"><i class="fas fa-book mr-2"></i>รายวิชา (course_list)</h3>
                        <p class="text-sm sm:text-base text-gray-600 mb-2">จำนวน: <span class="font-bold text-emerald-600"><?php echo count($courses); ?></span> รายการ</p>
                        <?php if (!empty($courses)): ?>
                            <div class="mt-3 max-h-40 overflow-y-auto">
                                <ul class="space-y-1">
                                    <?php foreach ($courses as $index => $course): ?>
                                        <li class="text-xs sm:text-sm text-gray-700">
                                            <?php echo ($index + 1); ?>. <?php echo htmlspecialchars($course['name']); ?> (<?php echo $course['credit']; ?> หน่วยกิต)
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php else: ?>
                            <p class="text-gray-400 text-xs sm:text-sm">ไม่มีข้อมูล</p>
                        <?php endif; ?>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-3 sm:p-4">
                        <h3 class="text-base sm:text-lg font-semibold text-gray-800 mb-2"><i class="fas fa-star mr-2"></i>เกรด (courses)</h3>
                        <p class="text-sm sm:text-base text-gray-600 mb-2">จำนวน: <span class="font-bold text-emerald-600"><?php echo count($grades); ?></span> รายการ</p>
                        <?php if (!empty($grades)): ?>
                            <div class="mt-3 max-h-40 overflow-y-auto">
                                <ul class="space-y-1">
                                    <?php foreach ($grades as $index => $grade): ?>
                                        <li class="text-xs sm:text-sm text-gray-700">
                                            <?php echo ($index + 1); ?>. <?php echo htmlspecialchars($grade['name']); ?> - <?php echo $grade['grade']; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php else: ?>
                            <p class="text-gray-400 text-xs sm:text-sm">ไม่มีข้อมูล</p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="bg-blue-50 border-l-4 border-blue-500 p-3 sm:p-4 rounded">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-info-circle text-blue-400 text-lg sm:text-xl"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-xs sm:text-sm text-blue-700">
                                <strong>Session ID:</strong> <span class="break-all"><?php echo session_id(); ?></span><br>
                                <strong>Session Status:</strong> <?php echo session_status() === PHP_SESSION_ACTIVE ? 'Active' : 'Inactive'; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-emerald-600 to-teal-700 text-white py-4 sm:py-6 px-4 sm:px-6">
                <h2 class="text-xl sm:text-2xl font-bold"><i class="fas fa-trash-alt mr-2"></i>เคลียร์ Session</h2>
            </div>
            <div class="p-4 sm:p-6">
                <div class="space-y-3 sm:space-y-4">
                    <div class="flex items-center p-3 sm:p-4 border-2 border-gray-200 rounded-lg hover:border-emerald-500 transition cursor-pointer" onclick="selectOption('courses')">
                        <input type="radio" id="clear_courses" name="clear_type" value="courses" class="w-4 h-4 text-emerald-600 focus:ring-emerald-500 flex-shrink-0">
                        <label for="clear_courses" class="ml-3 text-gray-700 font-medium cursor-pointer text-sm sm:text-base flex-1">
                            ลบรายวิชาทั้งหมด (course_list)
                        </label>
                    </div>

                    <div class="flex items-center p-3 sm:p-4 border-2 border-gray-200 rounded-lg hover:border-emerald-500 transition cursor-pointer" onclick="selectOption('grades')">
                        <input type="radio" id="clear_grades" name="clear_type" value="grades" class="w-4 h-4 text-emerald-600 focus:ring-emerald-500 flex-shrink-0">
                        <label for="clear_grades" class="ml-3 text-gray-700 font-medium cursor-pointer text-sm sm:text-base flex-1">
                            ลบเกรดทั้งหมด (courses)
                        </label>
                    </div>

                    <div class="flex items-center p-3 sm:p-4 border-2 border-red-300 rounded-lg hover:border-red-500 transition bg-red-50 cursor-pointer" onclick="selectOption('all')">
                        <input type="radio" id="clear_all" name="clear_type" value="all" class="w-4 h-4 text-red-600 focus:ring-red-500 flex-shrink-0">
                        <label for="clear_all" class="ml-3 text-gray-700 font-medium cursor-pointer text-sm sm:text-base flex-1">
                            ลบข้อมูลทั้งหมด (ทั้งรายวิชาและเกรด)
                        </label>
                    </div>
                </div>

                <div class="mt-4 sm:mt-6 flex flex-col sm:flex-row gap-3 sm:gap-4">
                    <button onclick="handleClear()" class="flex-1 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-semibold py-2.5 sm:py-3 px-4 sm:px-6 rounded-lg transition text-sm sm:text-base">
                        <i class="fas fa-trash-alt mr-2"></i>เคลียร์ข้อมูล
                    </button>
                    <a href="index.php" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2.5 sm:py-3 px-4 sm:px-6 rounded-lg text-center transition text-sm sm:text-base">
                        <i class="fas fa-times mr-2"></i>ยกเลิก
                    </a>
                </div>
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
    <script>
        function selectOption(value) {
            document.getElementById('clear_' + value).checked = true;
        }

        function handleClear() {
            const selected = document.querySelector('input[name="clear_type"]:checked');
            if (!selected) {
                alert('กรุณาเลือกประเภทข้อมูลที่ต้องการลบ');
                return;
            }
            const messages = {
                'courses': 'คุณต้องการลบรายวิชาทั้งหมดหรือไม่?',
                'grades': 'คุณต้องการลบเกรดทั้งหมดหรือไม่?',
                'all': 'คุณต้องการลบข้อมูลทั้งหมด (ทั้งรายวิชาและเกรด) หรือไม่?'
            };
            const url = 'session_manager.php?clear_type=' + selected.value;
            confirmAction(messages[selected.value], url);
        }
    </script>
</body>
</html>
        <?php
    }
}
