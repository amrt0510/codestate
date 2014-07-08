<?php

$userGuid = "bfcfa7fb-b0d6-4702-b0cf-d513dabccb7d";
$apiKey = "R2U4aIRL9f7wzn4+W0JqO63WqXu3qFURBx/vQS2fbgktBQ9SMZGtyX7V+6yvlAXCOCzFto9HWtrpiqRwW5q5Pw==";

function query($connectorGuid, $input, $userGuid, $apiKey, $additionalInput) {

    $url = "http://api.import.io/store/connector/" . $connectorGuid . "/_query?_user=" . urlencode($userGuid) . "&_apikey=" . urlencode($apiKey);

    $data = array("input" => $input);
    if ($additionalInput) {
        $data["additionalInput"] = $additionalInput;
    }

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $result = curl_exec($ch);

    if (curl_error($ch)):
        echo curl_error($ch);
    endif;
    curl_close($ch);

    return json_decode($result);
}

//// Query for tile google_data123
//$result = query("882ffacc-853a-474a-9b70-d6884a4c9331", array(
//    "input_to_query" => "book my show",
//        ), $userGuid, $apiKey, false);
//var_dump($result);

function get_domain($url) {
    $pieces = parse_url($url);
    $domain = isset($pieces['host']) ? $pieces['host'] : '';
    if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
        return $regs['domain'];
    }
    return false;
}

//print get_domain("http://mail.somedomain.co.uk");
$a = 'http://www.google.com/hahhahh';
if (strpos($a, 'http://www.google.com') !== false) {
    echo 'true';
}
