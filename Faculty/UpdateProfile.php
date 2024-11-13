<?php
session_start();
include '../db_config.php';

$ID = $_SESSION['userID'];
$message = ''; // Initialize an empty message variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $FN = $_POST['Teacher_FName'];
    $MI = $_POST['Teacher_MInitial'];
    $LN = $_POST['Teacher_LName'];
    $Email = $_POST['Teacher_Email'];
    $Password = $_POST['Teacher_Password'];
    $PhoneNum = $_POST['Teacher_PhoneNum'];

    $sql = "UPDATE teacher SET Teacher_FName = ?, Teacher_MInitial = ?, Teacher_LName = ?, Teacher_Email = ?, Teacher_Password = ?, Teacher_PhoneNum = ? WHERE Teacher_ID = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("ssssssi", $FN, $MI, $LN, $Email, $Password, $PhoneNum, $ID);
    $stmt->execute();

    $message = "Profile updated successfully!";
}

// Fetch teacher details from the database
$sql = "SELECT * FROM teacher WHERE Teacher_ID = ?";
$stmt = $db->prepare($sql);
$stmt->bind_param("i", $ID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $FN = $row['Teacher_FName'];
    $MI = $row['Teacher_MInitial'];
    $LN = $row['Teacher_LName'];
    $Email = $row['Teacher_Email'];
    $Password = $row['Teacher_Password'];
    $PhoneNum = $row['Teacher_PhoneNum'];

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
                width: 175px;
                height: 110px;
                background-image: url("logo.png");
                background-size: cover;
                background-position: center;
                border-radius: 50%;
                position: absolute;
                top: 10px;
                left: 20px;
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
                max-width: 450px;
                width: 100%;
                margin: 0 auto;
                text-align: left;
                padding: 20px;
                flex-grow: 1;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }

            /* Form container */
            .form-container {
                background-color: #E8E8E8;
                padding: 25px;
                border-radius: 12px;
                box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            }

            .form-control {
                margin-bottom: 15px;
                padding: 10px 15px;
                font-size: 16px;
                border-radius: 10px;
                background-color: #D9D9D9;
                border: 1px solid #ccc;
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
                text-align: center;
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
        <title>Update Teacher Profile</title>
    </head>
    <body>
        <div class="header">
            <div class="blue-circle"></div>
            <h1 class="title">Teacher Profile</h1>
            <p class="subtitle">Update your information below</p>
        </div>
        <div class="container">
            <h2 class="update-profile-title">Update Teacher Profile</h2>
            <form action="UpdateProfile.php" method="post" class="form-container">
                <label for="Teacher_FName">First Name:</label>
                <input type="text" name="Teacher_FName" id="Teacher_FName" class="form-control" value="' . $FN . '" required>

                <label for="Teacher_MInitial">Middle Initial:</label>
                <input type="text" name="Teacher_MInitial" id="Teacher_MInitial" class="form-control" value="' . $MI . '" maxlength="1" required>

                <label for="Teacher_LName">Last Name:</label>
                <input type="text" name="Teacher_LName" id="Teacher_LName" class="form-control" value="' . $LN . '" required>

                <label for="Teacher_Email">Email:</label>
                <input type="email" name="Teacher_Email" id="Teacher_Email" class="form-control" value="' . $Email . '" required>

                <label for="Teacher_Password">Password:</label>
                <input type="password" name="Teacher_Password" id="Teacher_Password" class="form-control" value="' . $Password . '" required>

                <label for="Teacher_PhoneNum">Phone Number:</label>
                <input type="text" name="Teacher_PhoneNum" id="Teacher_PhoneNum" class="form-control" value="' . $PhoneNum . '" required>

                <button type="submit" name="update_profile" class="btn-custom">Update</button>
                <a href="Profile.php" class="btn-custom">Back to Profile</a>
            </form>';

    // Display the message if it's not empty
    if (!empty($message)) {
        echo "<center><p>$message</p></center>";
    }

    echo '
        </div>
        <div class="footer-bar"></div>
    </body>
    </html>';
} else {
    echo "No teacher found with this ID";
}

$db->close();
?>
