<?php
class IndexView {
    public function render() {
        ?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบคำนวณ GPA</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
    <div class="container mx-auto px-4 py-16">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-lg shadow-xl p-8">
                <h1 class="text-4xl font-bold text-center text-gray-800 mb-8">ระบบคำนวณ GPA</h1>
                <div class="space-y-4">
                    <a href="manage_courses.php" class="block w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-4 px-6 rounded-lg text-center transition duration-200 shadow-md hover:shadow-lg">
                        จัดการรายวิชา
                    </a>
                    <a href="gpa_calculator.php" class="block w-full bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-4 px-6 rounded-lg text-center transition duration-200 shadow-md hover:shadow-lg">
                        คำนวณ GPA
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
