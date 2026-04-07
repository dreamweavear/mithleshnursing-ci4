<?php

namespace App\Libraries;

class WhatsAppService
{
    protected $apiUrl = "https://arun-whatsapp-bot-production.up.railway.app/send";

    public function send($number, $message)
    {
        $number = preg_replace('/[^0-9]/', '', $number);

        $data = [
            "number" => $number,
            "message" => $message
        ];

        $ch = curl_init($this->apiUrl);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}