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
        <div class="container mx-auto px-4 sm:px-6 py-4">
            <div class="flex justify-between items-center">
                <h1 class="text-xl sm:text-2xl font-bold"><i class="fas fa-graduation-cap mr-2"></i><span class="hidden sm:inline">ระบบคำนวณ GPA</span><span class="sm:hidden">GPA</span></h1>
                <button id="mobileMenuBtn" class="md:hidden text-white p-2">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <nav id="mainNav" class="hidden md:flex gap-4 lg:gap-6">
                    <a href="index.php" class="font-bold text-emerald-100 hover:text-emerald-200 transition underline-offset-4 underline"><i class="fas fa-home mr-1"></i><span class="hidden lg:inline">หน้าหลัก</span><span class="lg:hidden">หน้า</span></a>
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
        <div class="bg-white rounded-lg shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-emerald-600 to-teal-700 text-white py-6 sm:py-8 px-4 sm:px-6">
                <h2 class="text-2xl sm:text-3xl font-bold text-center">ยินดีต้อนรับสู่ระบบคำนวณ GPA</h2>
            </div>

            <div class="p-4 sm:p-8 grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                <div class="bg-white border-2 border-gray-200 rounded-lg p-4 sm:p-6 hover:shadow-lg transition">
                    <div class="text-center mb-3 sm:mb-4">
                        <i class="fas fa-book text-3xl sm:text-4xl text-emerald-600 mb-2 sm:mb-3"></i>
                    </div>
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-800 mb-2 sm:mb-3">จัดการรายวิชา</h3>
                    <p class="text-sm sm:text-base text-gray-600 mb-3 sm:mb-4">เพิ่ม แก้ไข หรือลบรายวิชา</p>
                    <a href="manage_courses.php" class="block w-full bg-gradient-to-r from-emerald-600 to-teal-600 text-white py-2 px-4 rounded-lg hover:from-emerald-700 hover:to-teal-700 transition text-center text-sm sm:text-base"><i class="fas fa-book mr-2"></i>จัดการรายวิชา</a>
                </div>

                <div class="bg-white border-2 border-gray-200 rounded-lg p-4 sm:p-6 hover:shadow-lg transition">
                    <div class="text-center mb-3 sm:mb-4">
                        <i class="fas fa-calculator text-3xl sm:text-4xl text-emerald-600 mb-2 sm:mb-3"></i>
                    </div>
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-800 mb-2 sm:mb-3">คำนวณ GPA</h3>
                    <p class="text-sm sm:text-base text-gray-600 mb-3 sm:mb-4">ดูเกรดเฉลี่ยสะสมและรายละเอียดเกรด</p>
                    <a href="gpa_calculator.php" class="block w-full bg-gradient-to-r from-emerald-600 to-teal-600 text-white py-2 px-4 rounded-lg hover:from-emerald-700 hover:to-teal-700 transition text-center text-sm sm:text-base"><i class="fas fa-calculator mr-2"></i>คำนวณ GPA</a>
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
</body>
</html>
        <?php
    }
}
