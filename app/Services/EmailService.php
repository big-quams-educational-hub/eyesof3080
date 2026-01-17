<?php
class EmailService {
    public static function send($to, $subject, $message) {
        $headers = "From: " . getenv("SMTP_USER");
        mail($to, $subject, $message, $headers);
    }
}
