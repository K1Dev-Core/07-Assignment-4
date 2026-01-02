<?php
require_once __DIR__ . '/../../helpers/FlashMessage.php';

$messages = FlashMessage::get();

if (!empty($messages)):
    $notificationId = 'notification-' . uniqid();
?>
<div id="notification-container" class="fixed top-4 right-2 sm:right-4 z-50 space-y-3" style="max-width: calc(100% - 1rem); width: 100%; max-width: 400px;">
<?php
    foreach ($messages as $index => $message):
        $type = $message['type'];
        $text = $message['message'];
        
        $bgColor = '';
        $icon = '';
        $iconColor = '';
        
        switch ($type) {
            case 'success':
                $bgColor = 'bg-emerald-500';
                $icon = 'fa-check-circle';
                break;
            case 'error':
                $bgColor = 'bg-red-500';
                $icon = 'fa-exclamation-circle';
                break;
            case 'warning':
                $bgColor = 'bg-yellow-500';
                $icon = 'fa-exclamation-triangle';
                break;
            case 'info':
                $bgColor = 'bg-blue-500';
                $icon = 'fa-info-circle';
                break;
            default:
                $bgColor = 'bg-gray-500';
                $icon = 'fa-info-circle';
        }
        $itemId = 'notif-' . $index . '-' . uniqid();
?>
    <div id="<?php echo $itemId; ?>" class="<?php echo $bgColor; ?> rounded-lg shadow-xl p-3 sm:p-4 text-white animate-slide-in">
        <div class="flex items-center">
            <i class="fas <?php echo $icon; ?> text-lg sm:text-xl mr-2 sm:mr-3 flex-shrink-0"></i>
            <p class="flex-1 font-medium text-sm sm:text-base pr-2"><?php echo htmlspecialchars($text); ?></p>
            <button onclick="removeNotification('<?php echo $itemId; ?>')" class="ml-2 text-white hover:text-gray-200 transition flex-shrink-0">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
<?php
    endforeach;
?>
</div>
<script>
function removeNotification(id) {
    const el = document.getElementById(id);
    if (el) {
        el.style.opacity = '0';
        el.style.transform = 'translateX(100%)';
        setTimeout(() => el.remove(), 300);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('notification-container');
    if (container) {
        const notifications = container.querySelectorAll('[id^="notif-"]');
        notifications.forEach((notif, index) => {
            setTimeout(() => {
                removeNotification(notif.id);
            }, 5000 + (index * 100));
        });
    }
});
</script>
<style>
@keyframes slide-in {
    from {
        opacity: 0;
        transform: translateX(100%);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}
.animate-slide-in {
    animation: slide-in 0.3s ease-out;
}
[id^="notif-"] {
    transition: all 0.3s ease-out;
}
</style>
<?php
endif;
?>