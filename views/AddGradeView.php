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
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-lg shadow-xl p-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-6">เพิ่มเกรด</h1>
                
                <?php if (empty($courses)): ?>
                    <p class="text-red-500 mb-4">ไม่มีรายวิชา กรุณาเพิ่มรายวิชาก่อน</p>
                    <a href="manage_courses.php" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-6 rounded-lg transition duration-200 shadow-md hover:shadow-lg">
                        ไปจัดการรายวิชา
                    </a>
                <?php else: ?>
                    <form action="add_grade.php" method="POST">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">เลือกรายวิชา</label>
                            <select name="course_name" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">-- เลือกรายวิชา --</option>
                                <?php foreach ($courses as $course): ?>
                                    <option value="<?php echo htmlspecialchars($course['name']); ?>">
                                        <?php echo htmlspecialchars($course['name']); ?> (<?php echo $course['credit']; ?> หน่วยกิต)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">เกรด</label>
                            <select name="grade" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
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
                        
                        <div class="flex gap-4">
                            <button type="submit" class="flex-1 bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-6 rounded-lg transition duration-200 shadow-md hover:shadow-lg">
                                เพิ่มเกรด
                            </button>
                            <a href="gpa_calculator.php" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded-lg text-center transition duration-200 shadow-md hover:shadow-lg">
                                ยกเลิก
                            </a>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
        <?php
    }
}
