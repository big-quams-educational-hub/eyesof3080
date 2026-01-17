<?php
require "config.php";

$ref = $_GET['ref'];
$name = $_GET['name'];
$email = $_GET['email'];
$phone = $_GET['phone'];
$service = $_GET['service'];
$amount = $_GET['amount'] / 100;

$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.paystack.co/transaction/verify/$ref",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HTTPHEADER => [
    "Authorization: Bearer " . PAYSTACK_SECRET
  ],
]);

$response = curl_exec($curl);
curl_close($curl);
$data = json_decode($response, true);

if ($data['data']['status'] === "success") {

  /* 📧 EMAIL CONFIRMATION */
  $subject = "Payment Confirmation";
  $message = "
  Hello $name,

  Your payment was successful.

  Service: $service
  Amount: ₦$amount
  Reference: $ref

  Thank you.
  ";
  mail($email, $subject, $message, "From: " . SCHOOL_EMAIL);

  /* 📲 WHATSAPP CONFIRMATION (Click-to-chat) */
  $msg = urlencode(
    "Payment Received ✅\n
Name: $name\n
Service: $service\n
Amount: ₦$amount\n
Ref: $ref"
  );

  // Student WhatsApp
  $studentWhatsapp = "https://wa.me/234" . substr($phone,1) . "?text=$msg";

  // Admin WhatsApp
  $adminWhatsapp = "https://wa.me/" . ADMIN_PHONE . "?text=$msg";

  header("Location: success.html?student=$studentWhatsapp&admin=$adminWhatsapp");

} else {
  header("Location: failed.html");
}
