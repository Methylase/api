<?php
    $data = array();
    if(isset($_POST['consent']) && !empty($_POST['consent']) && isset($_POST['ip']) && !empty($_POST['ip']) && isset($_POST['attempted_statements']) && !empty($_POST['attempted_statements'])){
        $attempted_statements =   $_POST['attempted_statements'];
        $surveyType ="";
        $attempted_statements_numbers="";
        $experiment_token ="";
        foreach($attempted_statements as $key=> $value){
            $surveyType = $attempted_statements[$key]['type'];
            $attempted_statements_numbers .= $attempted_statements[$key]['id'].' ';                
            $experiment_token .= $attempted_statements[$key]['coins'].' ';                     
        }            
        $data =array(
                    'ip_address'=>$_POST["ip"],
                    'start_date' => $_POST['start_date'],
                    'endDate' => $_POST['endDate'],
                    'consent' => $_POST['consent'],
                    'attention1_answer' => $_POST['attention1_answer'],
                    'attention2_answer' => $_POST['attention2_answer'],
                    'surveyType' => $surveyType,
                    'timer_first_click' => $_POST['timer_first_click'],
                    'timer_last_click' => $_POST['timer_last_click'],
                    'ageRange'=>$_POST['ageRange'],
                    'experiment_token'=> $experiment_token,
                    'attempted_statements' => $attempted_statements_numbers,
                    'education_level' => $_POST['educationLevel'],
                    'gender' => $_POST['gender']
                );
    $url = 'localhost/api/api.php';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response_json = curl_exec($ch);
    curl_close($ch);
    $response=json_decode($response_json, true);
    if($response["status"]){
        $data["code"] = $response["unique_code"];
    }
    echo json_encode($data);

}