<?php
    $data = array();
    if(isset($_POST['ip']) && !empty($_POST['ip'])){
    $ip=array(
        'ip' =>$_POST['ip']
    );
    $url = 'localhost/api/api.php';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $ip);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response_json = curl_exec($ch);
    curl_close($ch);
    $response=json_decode($response_json, true);
    if($response["status"]){
        $data["status"] = true;
    }else{
        $data["status"] =false;
    }
    echo json_encode($data);
}


?>