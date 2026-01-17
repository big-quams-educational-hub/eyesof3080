<?php
class PaystackService {
    public static function verify($reference) {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/$reference",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer " . getenv("PAYSTACK_SECRET_KEY")
            ],
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response, true);
    }
}
