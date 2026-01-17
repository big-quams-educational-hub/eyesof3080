<?php
class WhatsAppService {
    public static function link($phone, $message) {
        return "https://wa.me/$phone?text=" . urlencode($message);
    }
}
