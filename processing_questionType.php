<?php
    $data = array();
    $url = 'localhost/api/api.php';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response_json = curl_exec($ch);
    curl_close($ch);
    $response=json_decode($response_json, true);
    if($response["status"]){
        $data["type"] = $response["type"];
    }
    echo json_encode($data);
?>