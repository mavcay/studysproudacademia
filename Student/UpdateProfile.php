<?php
include '../db_config.php';
session_start();

$ID = $_SESSION['userID'];
$message = ''; // Initialize an empty message variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $FN = $_POST['Student_FName'];
    $MI = $_POST['Student_MInitial'];
    $LN = $_POST['Student_LName'];
    $Email = $_POST['Student_Email'];
    $Password = $_POST['Student_Password'];
    $PhoneNum = $_POST['Student_PhoneNum'];

    $sql = "UPDATE student SET Student_FName = ?, Student_MInitial = ?, Student_LName = ?, Student_Email = ?, Student_Password = ?, Student_PhoneNum = ? WHERE Student_ID = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("ssssssi", $FN, $MI, $LN, $Email, $Password, $PhoneNum, $ID);
    $stmt->execute();

    $message = "Profile updated successfully!";
}

$sql = "SELECT * FROM student WHERE Student_ID = ?";
$stmt = $db->prepare($sql);
$stmt->bind_param("i", $ID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $FN = $row['Student_FName'];
    $MI = $row['Student_MInitial'];
    $LN = $row['Student_LName'];
    $Email = $row['Student_Email'];
    $Password = $row['Student_Password'];
    $PhoneNum = $row['Student_PhoneNum'];

    echo '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        /* Base styles */
        body {
            margin: 0;
            padding: 0;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            background-color: #EAE7E1;
            color: #000;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Header styles */
        .header {
            position: relative;
            background-color: #EAE7E1;
            padding-top: 20px;
            padding-bottom: 10px;
            text-align: center;
            border-bottom: 3px solid #2B2C9D;
        }

        .blue-circle {
            width: 175px; /* Adjust size */
            height: 110px; /* Adjust size */
            background-image: url("logo.png"); /* Corrected image path */
            background-size: cover; /* Ensure the image covers the entire circle */
            background-position: center; /* Center the image */
            border-radius: 50%; /* Make it a circle */
            position: absolute;
            top: 10px;
            left: 20px; /* Adjust position as needed */
        }

        .title {
            color: #000;
            font-size: 36px;
            margin: 0;
            margin-top: 10px;
        }

        .subtitle {
            font-size: 24px;
            color: #000;    
            margin-top: 5px;
            margin-bottom: 0;
        }

        /* Profile title */
        .update-profile-title {
            font-size: 30px;
            color: #000;
            margin-top: 20px;
            text-align: center;
        }

        /* Container for the form */
        .container {
            max-width: 450px; /* Slightly wider */
            width: 100%;
            margin: 0 auto;
            text-align: left; /* Align labels to the left */
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        /* Form container */
        .form-container {
    background-color: #E8E8E8; /* Updated color */
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}

       .form-control {
    margin-bottom: 15px;
    padding: 10px 15px;
    font-size: 16px;
    border-radius: 10px;
    background-color: #D9D9D9; /* Background color for input fields */
    border: 1px solid #ccc; /* Optional: border color for a defined edge */
}

        .form-control {
            margin-bottom: 15px;
            padding: 10px 15px;
            font-size: 16px;
            border-radius: 10px;
        }

        /* Button styles */
        .btn-custom {
            width: 100%;
            background-color: #ffde59;
            color: #000;
            border-radius: 20px;
            padding: 10px;
            margin-bottom: 10px;
            border: none;
            font-size: 16px;
        }

        .btn-custom:hover {
            background-color: #ffc107;
        }

        /* Footer bar */
        .footer-bar {
            width: 100%;
            height: 100px;
            background-color: #2B2C9D;
            position: relative;
        }
    </style>
    <title>Update Student Profile</title>
</head>
<body>
    <!-- Header with title, subtitle, and circle -->
    <div class="header">
        <div class="blue-circle"></div>
        <h2 class="title">Study Sprouts Academia</h2>
        <p class="subtitle">Student</p>
    </div>

    <!-- Update profile title -->
    <h3 class="update-profile-title">Update Profile</h3>

    <!-- Profile update form -->
    <div class="container">
        <div class="form-container">
            <form action="UpdateProfile.php" method="post">
                <label for="Student_FName" class="form-label">First Name:</label>
                <input type="text" name="Student_FName" id="Student_FName" class="form-control" value="' . $FN . '" required>

                <label for="Student_MInitial" class="form-label">Middle Initial:</label>
                <input type="text" name="Student_MInitial" id="Student_MInitial" class="form-control" value="' . $MI . '" maxlength="1" required>

                <label for="Student_LName" class="form-label">Last Name:</label>
                <input type="text" name="Student_LName" id="Student_LName" class="form-control" value="' . $LN . '" required>

                <label for="Student_Email" class="form-label">Email:</label>
                <input type="email" name="Student_Email" id="Student_Email" class="form-control" value="' . $Email . '" required>

                <label for="Student_Password" class="form-label">Password:</label>
                <input type="password" name="Student_Password" id="Student_Password" class="form-control" value="' . $Password . '" required>

                <label for="Student_PhoneNum" class="form-label">Phone Number:</label>
                <input type="text" name="Student_PhoneNum" id="Student_PhoneNum" class="form-control" value="' . $PhoneNum . '" required>

                <button type="submit" class="btn btn-custom">Update</button>
                <a href="Profile.php" class="btn btn-custom">Back</a>
            </form>

            ' . (!empty($message) ? '<p class="text-success mt-2">' . $message . '</p>' : '') . '
        </div>
    </div>

    <!-- Footer bar -->
    <div class="footer-bar"></div>
</body>
</html>';
} else {
    echo "No student found with this ID";
}

$db->close();
?>
