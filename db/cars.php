<?php

	require_once 'connection.php';

	switch($_GET['op']) {
	    case "add_manufacturer":
				add_manufacturer($conn);
	        break;
	    case "add_model":
				add_model($conn);
			break;
		case "update_model":
				update_model($conn);
			break;
		case "get_model":
				get_model($conn);
			break;
		case "get_all_data":
				get_all_data($conn);
			break;
	    default:
        	echo "Your favorite color is neither red, blue, nor green!";
	}



	function add_manufacturer($conn)
	{
		header('Access-Control-Allow-Origin: *');  
		$json = (file_get_contents('php://input'));
		$data = json_decode($json, TRUE);
		$name = $data['name'];
		$sql = "INSERT INTO car_company (name, created) VALUES ('$name', now())";
		if ($conn->query($sql) === TRUE) {
			$output['status'] = 1;
			$output['msg'] = 'New record created successfully.';
		    echo json_encode($output);
		} else {
			$output['status'] = 1;
			$output['msg'] = 'Error.';
		}
	}

	function add_model($conn)
	{
		header('Access-Control-Allow-Origin: *');  
		$json = (file_get_contents('php://input'));
		$data = json_decode($json, TRUE);
		$car_company_id	 = $data['car_company_id'];
		$model_name	 = $data['model_name'];
		$no_of_model	 = $data['no_of_model'];
		
		$sql = "INSERT INTO car_model_name (car_company_id, model_name, no_of_model, created) VALUES ('$car_company_id','$model_name', '$no_of_model', now())";
		if ($conn->query($sql) === TRUE) {
			$output['status'] = 1;
			$output['msg'] = 'New record created successfully.';
		    echo json_encode($output);
		} else {
			$output['status'] = 1;
			$output['msg'] = 'Error.';
		}
	}
	function update_model($conn)
	{
		header('Access-Control-Allow-Origin: *');  
		$id = $_GET['id'];
 		$sql = "UPDATE car_model_name SET no_of_model= no_of_model - 1 WHERE id = '$id'";
		if ($conn->query($sql) === TRUE) {
			$output['status'] = 1;
			$output['msg'] = 'data Updated successfully.';
		    echo json_encode($output);
		} else {
			$output['status'] = 1;
			$output['msg'] = 'Error.';
		}
	}
	function get_all_data($conn)
	{
		header('Access-Control-Allow-Origin: *');  
 		$sql = "SELECT * FROM car_company LEFT JOIN car_model_name ON car_model_name.car_company_id = car_company.id ORDER BY `car_model_name`.`id` DESC";
		$result = $conn->query($sql);
		$new_arry = array();
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				array_push($new_arry, $row);
				
			}
			echo json_encode($new_arry);
		} else {
			$output['status'] = 1;
			$output['msg'] = 'Error.';
		}
	}
	function get_model($conn)
	{
		header('Access-Control-Allow-Origin: *'); 
		 $sql = "SELECT * FROM car_company";
		 $result = $conn->query($sql);
		 $new_arry = array();
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				array_push($new_arry, $row);
			}
			echo json_encode($new_arry);
		} else {
			$output['status'] = 1;
			$output['msg'] = 'Error.';
		}
	}
?>

