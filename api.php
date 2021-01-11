<?php
	$servername = "localhost";
	$username = "root";
	$password = "smoothless";
	$dbname = "survey";
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
	  die("Connection failed: " . mysqli_connect_error());
	}
	$request_method=$_SERVER["REQUEST_METHOD"];
	switch($request_method)
	{
		case 'POST':
			// Retrieve User Ip
			if(!empty($_POST["ip"]))
			{
			  $ip_address=$_POST["ip"];
			  get_user_ip($ip_address);
               // Submiting Survey
			}else if(isset($_POST['consent']) && !empty($_POST['consent']) && isset($_POST['ip_address']) && !empty($_POST['ip_address']) && isset($_POST['attempted_statements']) && !empty($_POST['attempted_statements'])){
			  $ip_address=$_POST["ip_address"];
			  $start_date = $_POST['start_date'];
			  $endDate = $_POST['endDate'];
			  $consent = $_POST['consent'];
			  $attention1_answer = $_POST['attention1_answer'];
			  $attention2_answer = $_POST['attention2_answer'];
			  $surveyType = $_POST['surveyType'];
			  $timer_first_click = $_POST['timer_first_click'];
			  $timer_last_click = $_POST['timer_last_click'];
			  $ageRange=$_POST['ageRange'];
			  $experiment_token = $_POST['experiment_token'];
			  $attempted_statements = $_POST['attempted_statements'];
			  $education_level = $_POST['education_level'];
			  $gender = $_POST['gender'];
			  update_survey($ip_address, $start_date, $endDate, $consent, $attention1_answer, $attention2_answer, $experiment_token, $surveyType, $timer_first_click, $timer_last_click, $ageRange, $attempted_statements, $education_level, $gender);
			}
			break;
		case 'GET':
              // Retrieve Question Type
				get_question_type();
			break;		  
		default:
			// Invalid Request Method
			header("HTTP/1.0 405 Method Not Allowed");
			break;
	}

	function get_user_ip($ip_address)
	{
		global $conn;
		$response=array();
		$query="SELECT IP FROM survey_experiment";
		$result=mysqli_query($conn, $query);
		if( mysqli_num_rows($result) > 0){
		  $query="SELECT IP FROM survey_experiment";
		  if($ip_address != "")
		  {
		    $query.=" WHERE IP=".$ip_address." LIMIT 1";
		  }
		  $result=mysqli_query($conn, $query);
		  if($result && mysqli_num_rows($result) ==1){
			$response=array(
			  'status' => false
			);
		  }else{
			$response=array(
			  'status' => true
			);
		  }		  
		}else{
		  $response=array(
			'status' => false
		  );		  
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}
	function get_question_type()
	{
		global $conn;
		$query="SELECT questions_limit FROM survey_questions_limit LIMIT 1";
		$response=array();
		$result=mysqli_query($conn, $query);
		$row= mysqli_fetch_assoc($result);
		$questionType=$row['questions_limit'];
		$questionType++;
		if($questionType == 10){
		  $questionType =1;
		  $query="UPDATE survey_questions_limit SET questions_limit='$questionType'";
		  if(mysqli_query($conn, $query)){
			  $response=array(
				  'status' => true,
				  'type'=> $questionType
			  );
		  }     		  
		}else{
		  $query="UPDATE survey_questions_limit SET questions_limit='$questionType'";
		  if(mysqli_query($conn, $query)){
			$response=array();
			$query="SELECT questions_limit FROM survey_questions_limit LIMIT 1";
			$result=mysqli_query($conn, $query);
			$row= mysqli_fetch_assoc($result);
			$questionType=$row['questions_limit'];			
			$response=array(
			  'status'=> true,
			  'type'=> $questionType
			);
		  }		  
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}
	function update_survey($ip_address, $start_date, $endDate, $consent, $attention1_answer, $attention2_answer, $experiment_token, $surveyType, $timer_first_click, $timer_last_click, $ageRange, $attempted_statements, $education_level, $gender)
	{
		global $conn;
        $unique_code = random_strings(7);
		if($ip_address != "")
		{
		  $query="SELECT Confirmation FROM survey_experiment WHERE Confirmation='$unique_code' LIMIT 1";
		  $response=array();
		  $result=mysqli_query($conn, $query);
		  if($result && mysqli_num_rows($result) == null){
            $unique_code = random_strings(7);
			$query="INSERT INTO survey_experiment SET StartDate='$start_date', EndDate='$endDate', Consent='$consent', Video_Game='$attention1_answer', ExperimentChoice='$attempted_statements', ExperimentToken='$experiment_token', Timer_First_Click='$timer_first_click', Timer_Last_Click='$timer_last_click', WHO='$attention1_answer', Gender='$gender', Age='$ageRange', Education='$education_level', Confirmation='$unique_code', ExperimentReceived='$surveyType', IP='$ip_address'";
			if(mysqli_query($conn, $query))
			{
			  $response=array(
				'status' => true,
				'unique_code' => $unique_code,
			  );
			} 			
		  }		         		  		
	    }
		header('Content-Type: application/json');
		echo json_encode($response);
	}
    function random_strings($length_of_string) { 
        return substr(md5(time()), 0, $length_of_string); 
    } 
// Close database connection
	mysqli_close($conn);
?>