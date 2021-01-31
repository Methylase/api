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
    if($response['status']==true){
        $data['status'] = $response['status'];
    }else if($response['status']==null){
        $data['status']= false;
    }else{
        $data["status"] = $response['status'];
    }
    echo json_encode($data);
           
}
?>