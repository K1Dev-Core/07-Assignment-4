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
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-lg shadow-xl p-8 mb-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-6">จัดการรายวิชา</h1>
                
                <form action="add_course.php" method="POST" class="mb-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">ชื่อรายวิชา</label>
                            <input type="text" name="name" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">หน่วยกิต</label>
                            <input type="number" name="credit" step="0.5" min="0.5" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>
                    <button type="submit" class="mt-4 w-full md:w-auto bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-6 rounded-lg transition duration-200 shadow-md hover:shadow-lg">
                        เพิ่มรายวิชา
                    </button>
                </form>
            </div>

            <div class="bg-white rounded-lg shadow-xl p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">รายการรายวิชา</h2>
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
                                            <a href="delete_course.php?index=<?php echo $index; ?>" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-4 rounded transition duration-200">
                                                ลบ
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
                
                <div class="mt-6">
                    <a href="index.php" class="inline-block bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded-lg transition duration-200 shadow-md hover:shadow-lg">
                        กลับหน้าหลัก
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
        <?php
    }
}
