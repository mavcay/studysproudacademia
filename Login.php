<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
 body {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh; /* Ensure full height of the viewport */
    margin: 0;
    background-color: #EAE7E1; /* Set a solid background color */
    color: white;
    border: 70px solid #2B2C9D; /* Add a thick blue border around the whole page */
    box-sizing: border-box; /* Include padding and border in the element's total width and height */
}

.container {
    text-align: center;
    max-width: 600px; /* Adjust the maximum width of the wrapper */
    width: 100%; /* Make the wrapper take full width */
    padding: 30px; /* Add padding inside the wrapper */
    background-color: rgba(255, 255, 255, 0); /* Fully transparent background */
    outline: none; /* Remove the outline */
}

.header {
    font-size: 50px; /* Increased font size */
    font-weight: bold;
    margin-bottom: 20px; /* Increased bottom margin */
    color: #001f3f; /* Dark blue color */
}

.subheader {
    font-size: 18px;
    color: #001f3f; /* Dark blue color */
    margin-bottom: 20px; /* Increased bottom margin */
}

.Logo {
    height: auto; /* Maintain aspect ratio */
    margin-top: -100px; /* Move the logo 50px higher */
}

.lms {
    max-width: 70%; /* Make sure the image takes the full width of its container */
    height: auto; /* Maintain aspect ratio */
    margin-top: 10px; /* Adjust margin as needed */
}

.header2 {
    font-size: 20px; /* Increased font size */
    font-family: "Arial Black", sans-serif; /* Ensure proper font-family usage */
    font-weight: bold;
    color: #004AAD; /* Dark blue color */
    margin-top: 10px;
    margin-bottom: 10px; /* Increased bottom margin */
}

.login-container {
    text-align: center;
    max-width: 400px;
    width: 100%;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.login-container h2 {
    color: #333;
    margin-bottom: 20px;
}

.login-form {
    margin-top: 20px;
}

.login-form label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    color: #555;
}

.login-form input {
    width: 100%;
    padding: 10px;
    margin-bottom: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

.login-form input[type="submit"] {
    background-color: #007BFF;
    color: #fff;
    cursor: pointer;
    border: none;
    font-weight: bold;
}

.login-form input[type="submit"]:hover {
    background-color: #0056b3;
}

.login-form p {
    margin-top: 16px;
    color: #888;
}

.divider {
    border-top: 5px solid #2B2C9D;
    margin-top: -130px;
    margin-bottom: 30px;
}

button.proceed {
    background-color: #2B2C9D;
    color: #fff;
    width: 100%;
    padding: 10px;
    margin-bottom: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    cursor: pointer;
}

button.proceed:hover {
    background-color: #0056b3;
}

</style>
</head>
<body>
    <div class="container">
        <!-- Insert PNG image at the top left corner -->
        <img class="Logo" src="Login_image/studysprout_logo.png" alt="Study Sprouts">

  
        <!-- Divider line -->
        <div class="divider"></div>
        <div class="header2">LOGIN PAGE</div>

        <!-- Your login form goes here -->
        <form class="login-form" method="post" action="Login.php">
            <!-- Add your form fields (e.g., username, password) here -->
			<label for="studentnum">ID Number:</label>
            <input type="text" name="IDnum" required>
			
			<br>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <br>
			
			<div class="form-group">
                <div class="radio-group">
                    <input type="radio" id="teach" name="type" value="TEACHER" >
                    <label for="paid">Teacher</label>
                    <input type="radio" id="stud" name="type" value="STUDENT">
                    <label for="notPaid">Student</label>
                </div>
            </div>
			
            <input type="submit" value="Login">
        </form>
		<?php 
		include "classes.php";
		require_once 'db_config.php';
		if (empty($_POST['IDnum']) || empty($_POST['password']) || !isset($_POST['type'])){
			$output = "<br> Please fill out all necessary fields! <br>";
		}
		else if ($_POST['type'] == "STUDENT"){
			$sql = "SELECT * FROM student WHERE Student_ID = ? AND Student_Password = ?";
			$IDnum = trim($_POST['IDnum']);
			$pw = $_POST['password'];
			
			if($stmt = $db->prepare($sql)){
			// Bind variables to the prepared statement as parameters
			$stmt->bind_param("is", $param_IDnum, $param_pw);
			
			// Set parameters
			$param_IDnum = $IDnum;
			$param_pw = $pw;
			
			// Attempt to execute the prepared statement
			if($stmt->execute()){
				$result = $stmt->get_result();
				
				if($result->num_rows == 1){
					$row = $result->fetch_array(MYSQLI_ASSOC);
					$ID = $row["Student_ID"];
					$FN = $row["Student_FName"];
					$MI = $row["Student_MInitial"];
					$LN = $row["Student_LName"];
					$Email = $row["Student_Email"];
					$Password = $row["Student_Password"];
					$PhoneNum = $row["Student_PhoneNum"];
					$GradeLevel = $row["Student_GradeLevel"];
				} else{
					echo "Invalid login credentials!";
					exit();
				}
				
			} else{
				echo "Something went wrong. Please try again later.";
			}
			}
			$stmt->close();
			$db->close();
			$_SESSION['userID'] = $ID;
			$_SESSION['FN'] = $FN;
			$_SESSION['MI'] = $MI;
			$_SESSION['LN'] = $LN;
			$_SESSION['Email'] = $Email;	
			$_SESSION['Password'] = $Password;
			$_SESSION['PhoneNum'] = $PhoneNum;
			$_SESSION['GradeLevel'] = $GradeLevel;		
			echo "<script type=\"text/javascript\"> 
			window.location.href=\"Student/Student.php\" 
			</script>";
		}
		
		else if ($_POST['type'] == "TEACHER"){
			$sql = "SELECT * FROM teacher WHERE Teacher_ID = ? AND Teacher_Password = ?";
			$IDnum = trim($_POST['IDnum']);
			$pw = $_POST['password'];
			
			if($stmt = $db->prepare($sql)){
			// Bind variables to the prepared statement as parameters
			$stmt->bind_param("is", $param_IDnum, $param_pw);
			
			// Set parameters
			$param_IDnum = $IDnum;
			$param_pw = $pw;
			
			// Attempt to execute the prepared statement
			if($stmt->execute()){
				$result = $stmt->get_result();
				
				if($result->num_rows == 1){
					$row = $result->fetch_array(MYSQLI_ASSOC);
					$ID = $row["Teacher_ID"];
					$FN = $row["Teacher_FName"];
					$MI = $row["Teacher_MInitial"];
					$LN = $row["Teacher_LName"];
					$Email = $row["Teacher_Email"];
					$Password = $row["Teacher_Password"];
					$PhoneNum = $row["Teacher_PhoneNum"];
				} else{
					echo "Invalid login credentials!";
					exit();
				}
				
			} else{
				echo "Something went wrong. Please try again later.";
			}
			}
			$stmt->close();
			$db->close();
			$_SESSION['userID'] = $ID;
			$_SESSION['FN'] = $FN;
			$_SESSION['MI'] = $MI;
			$_SESSION['LN'] = $LN;
			$_SESSION['Email'] = $Email;	
			$_SESSION['Password'] = $Password;
			$_SESSION['PhoneNum'] = $PhoneNum;	
			echo "<script type=\"text/javascript\"> 
			window.location.href=\"Faculty/Faculty.php\" 
			</script>";
		}
		?>
    </div>

</body>
</html>
