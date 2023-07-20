<?php  
	// connect database
	include "db_connect.php";

	// variables
	$input_error = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// user input validations
		if (empty(trim($_POST['input']))) {
			echo '<font color="red"><i>Input is empty</i></font>';
    		$input_error = true; // user input is empty
    	} elseif (strlen($_POST['input']) < 10) {
    		echo '<font color="red"><i>Your input is less than 10</i></font>';
            $input_error = true; // user input is less than 10
        } elseif (!preg_match("/^[a-zA-Z0-9\s]{10,100}+$/", $_POST['input'])) {
        	echo '<font color="red"><i>Your input must be in letters with either number(s) and a space</i></font>';
            $input_error = true; // user input is invalid
        } elseif (strlen($_POST['input']) > 100) {
        	echo '<font color="red"><i>Your input is greater than 100</i></font>';
            $input_error = true; // user input is greater than 100
        } else {
            $input_error = false; // no error
            $user_input = $_POST['input'];
        }

		// if no errors
		if ($input_error == false) {
			// PREPARE INSERT STATEMENT
			// `users_input`
			$insert = "INSERT INTO inputs(data) VALUES(?)";

			if ($stmt = mysqli_prepare($db, $insert)) {
				// SET PARAMETERS
				$param_user_input = $user_input; // user input

				// `users_input`
				$insert = "INSERT INTO inputs(data) VALUES(?)";
				$stmt = mysqli_prepare($db, $insert);
				mysqli_stmt_bind_param($stmt, "s", $param_user_input);
				mysqli_stmt_execute($stmt);

				echo '<font color="green"><i>User input has been inserted into database successfully!</i></font>';
			} else {
				echo '<font color="red"><i>Ops! A problem occurred, pls try again.</i></font>';
			}	

			// close statement
			mysqli_stmt_close($stmt);		
		}		
		
  	}
  	// close database connection
  	mysqli_close($db);
?>