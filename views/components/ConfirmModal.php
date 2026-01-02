<div id="confirmModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm">
    <div class="bg-white rounded-lg shadow-2xl max-w-md w-full mx-4 transform transition-all modal-content">
        <div class="p-6">
            <div class="flex items-center mb-4">
                <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-full flex items-center justify-center mr-4 shadow-lg">
                    <i class="fas fa-exclamation-triangle text-white text-xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">ยืนยันการดำเนินการ</h3>
            </div>
            <p id="confirmMessage" class="text-gray-700 mb-6 leading-relaxed"></p>
            <div class="flex gap-3 justify-end">
                <button id="confirmCancel" class="px-5 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg transition font-medium shadow-sm hover:shadow">
                    <i class="fas fa-times mr-2"></i>ยกเลิก
                </button>
                <button id="confirmOk" class="px-5 py-2.5 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white rounded-lg transition font-medium shadow-md hover:shadow-lg">
                    <i class="fas fa-check mr-2"></i>ยืนยัน
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let currentCallback = null;

function showConfirm(message, callback) {
    const modal = document.getElementById('confirmModal');
    const messageEl = document.getElementById('confirmMessage');
    const okBtn = document.getElementById('confirmOk');
    const cancelBtn = document.getElementById('confirmCancel');
    
    messageEl.textContent = message;
    currentCallback = callback;
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    
    setTimeout(() => {
        modal.querySelector('.modal-content').style.transform = 'scale(1)';
        modal.querySelector('.modal-content').style.opacity = '1';
    }, 10);
    
    const handleConfirm = () => {
        modal.querySelector('.modal-content').style.transform = 'scale(0.95)';
        modal.querySelector('.modal-content').style.opacity = '0';
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 200);
        if (currentCallback) currentCallback(true);
        currentCallback = null;
    };
    
    const handleCancel = () => {
        modal.querySelector('.modal-content').style.transform = 'scale(0.95)';
        modal.querySelector('.modal-content').style.opacity = '0';
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 200);
        if (currentCallback) currentCallback(false);
        currentCallback = null;
    };
    
    okBtn.onclick = handleConfirm;
    cancelBtn.onclick = handleCancel;
    
    const handleBackdropClick = (e) => {
        if (e.target === modal) {
            handleCancel();
        }
    };
    
    modal.onclick = handleBackdropClick;
}

function confirmAction(message, url) {
    showConfirm(message, (confirmed) => {
        if (confirmed) {
            window.location.href = url;
        }
    });
}
</script>

<style>
#confirmModal .modal-content {
    transform: scale(0.9);
    opacity: 0;
    transition: all 0.2s ease-out;
}
#confirmModal.flex .modal-content {
    transform: scale(1);
    opacity: 1;
}
</style>
