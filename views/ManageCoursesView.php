<?php
class ManageCoursesView {
    public function render($courses) {
        ?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการรายวิชา</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <header class="bg-gradient-to-r from-emerald-600 to-teal-700 text-white shadow-lg">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold"><i class="fas fa-book mr-2"></i>จัดการรายวิชา</h1>
            <nav class="flex gap-6">
                <a href="index.php" class="text-emerald-300 hover:text-emerald-200 transition"><i class="fas fa-home mr-1"></i>หน้าหลัก</a>
                <a href="manage_courses.php" class="font-bold text-emerald-100 hover:text-emerald-200 transition underline-offset-4 underline"><i class="fas fa-book mr-1"></i>จัดการรายวิชา</a>
                <a href="add_grade.php" class="text-emerald-300 hover:text-emerald-200 transition"><i class="fas fa-plus-circle mr-1"></i>เพิ่มเกรด</a>
                <a href="gpa_calculator.php" class="text-emerald-300 hover:text-emerald-200 transition"><i class="fas fa-calculator mr-1"></i>คำนวณ GPA</a>
            </nav>
        </div>
    </header>

    <main class="container mx-auto px-6 py-12 flex-grow">
        <?php require_once 'views/components/FlashMessages.php'; ?>
        <div class="bg-white rounded-lg shadow-xl overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-emerald-600 to-teal-700 text-white py-6 px-6">
                <h2 class="text-2xl font-bold"><i class="fas fa-plus-circle mr-2"></i>เพิ่มรายวิชาใหม่</h2>
            </div>
            <div class="p-6">
                <form action="add_course.php" method="POST">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2"><i class="fas fa-book mr-2"></i>ชื่อรายวิชา</label>
                            <input type="text" name="name" required placeholder="เช่น หลักการเขียนโปรแกรม" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2"><i class="fas fa-hashtag mr-2"></i>หน่วยกิต</label>
                            <input type="number" name="credit" step="0.5" min="0.5" required placeholder="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        </div>
                    </div>
                    <button type="submit" class="mt-4 w-full md:w-auto bg-gradient-to-r from-emerald-600 to-teal-600 text-white py-2 px-6 rounded-lg hover:from-emerald-700 hover:to-teal-700 transition">
                        <i class="fas fa-plus mr-2"></i>เพิ่มรายวิชา
                    </button>
                </form>
            </div>
        </div>

            <div class="bg-white rounded-lg shadow-xl overflow-hidden">
                <div class="bg-gradient-to-r from-emerald-600 to-teal-700 text-white py-6 px-6 flex justify-between items-center">
                    <h2 class="text-2xl font-bold"><i class="fas fa-list mr-2"></i>รายการรายวิชา</h2>
                    <?php if (!empty($courses)): ?>
                        <a href="#" onclick="confirmAction('คุณต้องการลบรายวิชาทั้งหมดหรือไม่?', 'clear_all_courses.php'); return false;" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                            <i class="fas fa-trash-alt mr-2"></i>ลบรายวิชาทั้งหมด
                        </a>
                    <?php endif; ?>
                </div>
            <div class="p-6">
                <?php if (empty($courses)): ?>
                    <p class="text-gray-500 text-center py-8">ยังไม่มีรายวิชา</p>
                <?php else: ?>
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border border-gray-300 px-4 py-3 text-left font-semibold text-gray-700">ลำดับ</th>
                                    <th class="border border-gray-300 px-4 py-3 text-left font-semibold text-gray-700">ชื่อรายวิชา</th>
                                    <th class="border border-gray-300 px-4 py-3 text-left font-semibold text-gray-700">หน่วยกิต</th>
                                    <th class="border border-gray-300 px-4 py-3 text-left font-semibold text-gray-700">การจัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($courses as $index => $course): ?>
                                    <tr class="hover:bg-gray-50">
                                        <td class="border border-gray-300 px-4 py-3"><?php echo $index + 1; ?></td>
                                        <td class="border border-gray-300 px-4 py-3"><?php echo htmlspecialchars($course['name']); ?></td>
                                        <td class="border border-gray-300 px-4 py-3"><?php echo $course['credit']; ?></td>
                                        <td class="border border-gray-300 px-4 py-3">
                                            <a href="#" onclick="confirmAction('คุณต้องการลบรายวิชา &quot;<?php echo htmlspecialchars($course['name'], ENT_QUOTES); ?>&quot; หรือไม่?', 'delete_course.php?index=<?php echo $index; ?>'); return false;" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-4 rounded transition">
                                                <i class="fas fa-trash mr-1"></i>ลบ
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
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
