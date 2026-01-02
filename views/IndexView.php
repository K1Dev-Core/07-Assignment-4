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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <header class="bg-gradient-to-r from-emerald-600 to-teal-700 text-white shadow-lg">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold"><i class="fas fa-graduation-cap mr-2"></i>ระบบคำนวณ GPA</h1>
            <nav class="flex gap-6">
                <a href="index.php" class="font-bold text-emerald-100 hover:text-emerald-200 transition underline-offset-4 underline"><i class="fas fa-home mr-1"></i>หน้าหลัก</a>
                <a href="manage_courses.php" class="text-emerald-300 hover:text-emerald-200 transition"><i class="fas fa-book mr-1"></i>จัดการรายวิชา</a>
                <a href="add_grade.php" class="text-emerald-300 hover:text-emerald-200 transition"><i class="fas fa-plus-circle mr-1"></i>เพิ่มเกรด</a>
                <a href="gpa_calculator.php" class="text-emerald-300 hover:text-emerald-200 transition"><i class="fas fa-calculator mr-1"></i>คำนวณ GPA</a>
            </nav>
        </div>
    </header>

    <main class="container mx-auto px-6 py-12 flex-grow">
        <div class="bg-white rounded-lg shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-emerald-600 to-teal-700 text-white py-8 px-6">
                <h2 class="text-3xl font-bold text-center">ยินดีต้อนรับสู่ระบบคำนวณ GPA</h2>
            </div>

            <div class="p-8 grid md:grid-cols-2 gap-6">
                <div class="bg-white border-2 border-gray-200 rounded-lg p-6 hover:shadow-lg transition">
                    <div class="text-center mb-4">
                        <i class="fas fa-book text-4xl text-emerald-600 mb-3"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">จัดการรายวิชา</h3>
                    <p class="text-gray-600 mb-4">เพิ่ม แก้ไข หรือลบรายวิชา</p>
                    <a href="manage_courses.php" class="block w-full bg-gradient-to-r from-emerald-600 to-teal-600 text-white py-2 px-4 rounded-lg hover:from-emerald-700 hover:to-teal-700 transition text-center"><i class="fas fa-book mr-2"></i>จัดการรายวิชา</a>
                </div>

                <div class="bg-white border-2 border-gray-200 rounded-lg p-6 hover:shadow-lg transition">
                    <div class="text-center mb-4">
                        <i class="fas fa-calculator text-4xl text-emerald-600 mb-3"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">คำนวณ GPA</h3>
                    <p class="text-gray-600 mb-4">ดูเกรดเฉลี่ยสะสมและรายละเอียดเกรด</p>
                    <a href="gpa_calculator.php" class="block w-full bg-gradient-to-r from-emerald-600 to-teal-600 text-white py-2 px-4 rounded-lg hover:from-emerald-700 hover:to-teal-700 transition text-center"><i class="fas fa-calculator mr-2"></i>คำนวณ GPA</a>
                </div>
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
