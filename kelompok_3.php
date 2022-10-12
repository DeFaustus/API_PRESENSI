<?php
/* 
kelompok 3
- Galih Titis Bagus Catry
- Galang Wijaya
- Rafa putra
- Anandha Army Antassa
- Tio Ramadhani
- Aza Faiz Hamdani
*/
$url = "https://api.sandbox.midtrans.com/v2/charge";
$serverKey = "SB-Mid-server-tz0kZd-StlcqL9VWOaKmP7_o";
$date = new DateTimeImmutable();
$data = [
    "payment_type" => "bank_transfer",
    "transaction_details" => [
        "gross_amount" => 6000,
        "order_id" => "order-101c-" . $date->getTimestamp() . ""
    ],
    "customer_details" => [
        "email" => "noreply@example.com",
        "first_name" => "Kelompok ",
        "last_name" => "3 (Telu)",
        "phone" => "+6281 1234 1234"
    ],
    "item_details" => [
        [
            "id" => "item01",
            "price" => 1000,
            "quantity" => 1,
            "name" => "Galih Titis Bagus Catry"
        ],
        [
            "id" => "item02",
            "price" => 1000,
            "quantity" => 1,
            "name" => "Galang Wijaya"
        ],
        [
            "id" => "item03",
            "price" => 1000,
            "quantity" => 1,
            "name" => "Anandha army antassa"
        ],
        [
            "id" => "item04",
            "price" => 1000,
            "quantity" => 1,
            "name" => "Rafa Putra Fiansah"
        ],
        [
            "id" => "item05",
            "price" => 1000,
            "quantity" => 1,
            "name" => "Tio Ramadhani"
        ],
        [
            "id" => "item06",
            "price" => 1000,
            "quantity" => 1,
            "name" => "Aza Faiz Hamdani"
        ],
    ],
    "bank_transfer" => [
        "bank" => "bca",
        "va_number" => "12345678901",
        "free_text" => [
            "inquiry" => [
                [
                    "id" => "Ndang Dibayar Boss",
                    "en" => "Ndang Dibayar Boss"
                ]
            ],
            "payment" => [
                [
                    "id" => "Terimaksih telah membayar",
                    "en" => "Terimaksih telah membayar"
                ]
            ]
        ],
    ]
];
$dataJson = json_encode($data);
$option = [
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_HTTPHEADER => [
        'Accept: application∕json',
        'Content-Type: application/json; charset=utf8',
        'Authorization: Basic ' . base64_encode($serverKey . ":")
    ],
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_POSTFIELDS => $dataJson
];
$ch = curl_init($url);
curl_setopt_array($ch, $option);
$res = curl_exec($ch);
echo "<pre>";
print_r($res);
curl_close($ch);
