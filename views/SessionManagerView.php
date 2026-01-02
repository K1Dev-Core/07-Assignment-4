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
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <header class="bg-gradient-to-r from-emerald-600 to-teal-700 text-white shadow-lg">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold">จัดการ Session</h1>
            <nav class="flex gap-6">
                <a href="index.php" class="text-emerald-300 hover:text-emerald-200 transition">หน้าหลัก</a>
                <a href="manage_courses.php" class="text-emerald-300 hover:text-emerald-200 transition">จัดการรายวิชา</a>
                <a href="add_grade.php" class="text-emerald-300 hover:text-emerald-200 transition">เพิ่มเกรด</a>
                <a href="gpa_calculator.php" class="text-emerald-300 hover:text-emerald-200 transition">คำนวณ GPA</a>
            </nav>
        </div>
    </header>

    <main class="container mx-auto px-6 py-12 flex-grow">
        <div class="bg-white rounded-lg shadow-xl overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-emerald-600 to-teal-700 text-white py-6 px-6">
                <h2 class="text-2xl font-bold">ข้อมูล Session</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">รายวิชา (course_list)</h3>
                        <p class="text-gray-600 mb-2">จำนวน: <span class="font-bold text-emerald-600"><?php echo count($courses); ?></span> รายการ</p>
                        <?php if (!empty($courses)): ?>
                            <div class="mt-3 max-h-40 overflow-y-auto">
                                <ul class="space-y-1">
                                    <?php foreach ($courses as $index => $course): ?>
                                        <li class="text-sm text-gray-700">
                                            <?php echo ($index + 1); ?>. <?php echo htmlspecialchars($course['name']); ?> (<?php echo $course['credit']; ?> หน่วยกิต)
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php else: ?>
                            <p class="text-gray-400 text-sm">ไม่มีข้อมูล</p>
                        <?php endif; ?>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">เกรด (courses)</h3>
                        <p class="text-gray-600 mb-2">จำนวน: <span class="font-bold text-emerald-600"><?php echo count($grades); ?></span> รายการ</p>
                        <?php if (!empty($grades)): ?>
                            <div class="mt-3 max-h-40 overflow-y-auto">
                                <ul class="space-y-1">
                                    <?php foreach ($grades as $index => $grade): ?>
                                        <li class="text-sm text-gray-700">
                                            <?php echo ($index + 1); ?>. <?php echo htmlspecialchars($grade['name']); ?> - <?php echo $grade['grade']; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php else: ?>
                            <p class="text-gray-400 text-sm">ไม่มีข้อมูล</p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-blue-700">
                                <strong>Session ID:</strong> <?php echo session_id(); ?><br>
                                <strong>Session Status:</strong> <?php echo session_status() === PHP_SESSION_ACTIVE ? 'Active' : 'Inactive'; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-emerald-600 to-teal-700 text-white py-6 px-6">
                <h2 class="text-2xl font-bold">เคลียร์ Session</h2>
            </div>
            <div class="p-6">
                <form action="session_manager.php" method="POST" onsubmit="return confirm('คุณแน่ใจหรือไม่?')">
                    <div class="space-y-4">
                        <div class="flex items-center p-4 border-2 border-gray-200 rounded-lg hover:border-emerald-500 transition">
                            <input type="radio" id="clear_courses" name="clear_type" value="courses" class="w-4 h-4 text-emerald-600 focus:ring-emerald-500">
                            <label for="clear_courses" class="ml-3 text-gray-700 font-medium cursor-pointer">
                                ลบรายวิชาทั้งหมด (course_list)
                            </label>
                        </div>

                        <div class="flex items-center p-4 border-2 border-gray-200 rounded-lg hover:border-emerald-500 transition">
                            <input type="radio" id="clear_grades" name="clear_type" value="grades" class="w-4 h-4 text-emerald-600 focus:ring-emerald-500">
                            <label for="clear_grades" class="ml-3 text-gray-700 font-medium cursor-pointer">
                                ลบเกรดทั้งหมด (courses)
                            </label>
                        </div>

                        <div class="flex items-center p-4 border-2 border-red-300 rounded-lg hover:border-red-500 transition bg-red-50">
                            <input type="radio" id="clear_all" name="clear_type" value="all" class="w-4 h-4 text-red-600 focus:ring-red-500">
                            <label for="clear_all" class="ml-3 text-gray-700 font-medium cursor-pointer">
                                ลบข้อมูลทั้งหมด (ทั้งรายวิชาและเกรด)
                            </label>
                        </div>
                    </div>

                    <div class="mt-6 flex gap-4">
                        <button type="submit" class="flex-1 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-semibold py-3 px-6 rounded-lg transition">
                            เคลียร์ข้อมูล
                        </button>
                        <a href="index.php" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 px-6 rounded-lg text-center transition">
                            ยกเลิก
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </main>

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
