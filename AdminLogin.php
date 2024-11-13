<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Page</title>
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
        transform: scale(1.5); /* Scale the logo 1.5 times larger */
        height: auto; /* Maintain aspect ratio */
		margin-top: -40px; /* Move the logo 20px higher */
    }
    
    .lms {
        max-width: 70%; /* Make sure the image takes the full width of its container */
        height: auto; /* Maintain aspect ratio */
        margin-top: 1px; /* Adjust margin as needed */
    }

    .header2 {
        font-size: 20px; /* Increased font size */
        font-style: ARIAL BLACK;
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
		margin-top: 80px;
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

        <div class="header2">ADMIN LOGIN PAGE</div>

        <!-- Your login form goes here -->
        <form class="login-form" method="post" action="AdminLogin.php">
            <!-- Add your form fields (e.g., username, password) here -->
			<label for="IDnum">ID Number:</label>
            <input type="text" name="IDnum" required>
			
			<br>

            <label for="password">Password:</label>
            <input type="password" name="password" required>
			
            <input type="submit" value="Login">
        </form>
		<?php 
		include "classes.php";
		require_once 'db_config.php';
		if (empty($_POST['IDnum']) || empty($_POST['password'])){
			$output = "<br> Please fill out all necessary fields! <br>";
		}
		else {
			$sql = "SELECT * FROM admin WHERE Admin_ID = ? AND Admin_Password = ?";
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
					$allow = True;
				} else{
					$allow = False;
					exit();
				}
				
			} else{
				echo "Something went wrong. Please try again later.";
			}
			}
			$stmt->close();
			$db->close();
			if($allow == False){
				echo "Invalid Login Credentials!";
			}
			else{
				echo "<script type=\"text/javascript\"> 
					window.location.href=\"Admin/ADMIN_AccountInterface.php\" 
					</script>";
			}
		}
		?>
    </div>

</body>
</html>
