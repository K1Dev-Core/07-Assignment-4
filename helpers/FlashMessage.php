<?php
class FlashMessage {
    public static function set($type, $message) {
        if (!isset($_SESSION['flash_messages'])) {
            $_SESSION['flash_messages'] = [];
        }
        $_SESSION['flash_messages'][] = [
            'type' => $type,
            'message' => $message
        ];
    }

    public static function get() {
        if (isset($_SESSION['flash_messages']) && !empty($_SESSION['flash_messages'])) {
            $messages = $_SESSION['flash_messages'];
            unset($_SESSION['flash_messages']);
            return $messages;
        }
        return [];
    }

    public static function success($message) {
        self::set('success', $message);
    }

    public static function error($message) {
        self::set('error', $message);
    }

    public static function info($message) {
        self::set('info', $message);
    }

    public static function warning($message) {
        self::set('warning', $message);
    }
}
