<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Information -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Study Sprouts Academia</title>

    <!-- Styles -->
    <style>
        /* General Styles */
        body {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            background-color: #EAE7E1; /* Light background color */
            color: black; /* Default text color */
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Header Styles */
        .header {
            width: 100%;
            padding: 20px;
            background-color: #EAE7E1; /* White background */
            text-align: center;
            border-bottom: 2px solid #2B2C9D; /* Dark blue border */
        }

        /* Header Title Styles */
        .header h1 {
            font-size: 1.8em;
            color: black;
            margin: 0;
            font-weight: bold;
        }

        .header h2 {
            font-size: 1.2em;
            font-weight: bold;
            color: #2B2C9D; /* Dark blue text */
            margin: 5px 0 20px;
        }

        /* Logo Styles */
        .circle-logo {
            width: 100px;
            height: 100px;
            background-color: #2B2C9D; /* Dark blue */
            border-radius: 50%;
            position: absolute;
            top: 10px;
            left: 10px;
            background-image: url('adminImages/studysprout_logo.png');
            background-size: cover;
            background-position: center;
        }

        /* Form Container Styles */
        .container {
            background-color: #EAE7E1;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 500px;
            text-align: left;
        }

        /* Form Group Styles */
        .form-group {
            margin-bottom: 15px;
        }

        /* Label and Input Styles */
        label {
            display: block;
            font-size: 16px;
            margin-bottom: 5px;
            font-weight: bold;
            color: #2B2C9D;
        }

        input[type="text"],
        input[type="email"],
        select {
            width: calc(100% - 20px);
            padding: 10px;
            font-size: 14px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        /* Button Styles */
        .button-group {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }

        button {
            background-color: #DFB126;
            color: black;
            border: none;
            border-radius: 25px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.2s ease;
            width: 180px;
            font-weight: bold;
        }

        button:hover {
            background-color: #2B2C9D;
            color: white;
        }

        /* Footer Styles */
        .footer {
            width: 100%;
            height: 50px;
            background-color: #2B2C9D;
            position: fixed;
            bottom: 0;
            text-align: center;
            color: white;
            font-weight: bold;
            line-height: 50px;
        }
    </style>
</head>

<body>
    <!-- Header Section -->
    <div class="header">
        <div class="circle-logo"></div>
        <h1 class="study-sprouts-header">Study Sprouts Academia</h1>
        <h2 class="admin-header">Admin Account</h2>
    </div>

    <!-- Main Title -->
    <h2 style="color: #2B2C9D; font-size: 32px;">New Student</h2>

    <!-- Form Container -->
    <div class="container">
        <form action="ADMIN_CreateStudent.php" method="post">
            <!-- First Name Field -->
            <div class="form-group">
                <label for="studentFName">Student First Name:</label>
                <input type="text" id="studentFName" name="studentFName" required>
            </div>

            <!-- Last Name Field -->
            <div class="form-group">
                <label for="studentLName">Student Last Name:</label>
                <input type="text" id="studentLName" name="studentLName" required>
            </div>

            <!-- Middle Initial Field -->
            <div class="form-group">
                <label for="studentMI">Student Middle Initial:</label>
                <input type="text" id="studentMI" name="studentMI">
            </div>

            <!-- Email Field -->
            <div class="form-group">
                <label for="studentEmail">Student E-Mail:</label>
                <input type="email" id="studentEmail" name="studentEmail" required>
            </div>

            <!-- Phone Number Field -->
            <div class="form-group">
                <label for="studentPhone">Student Phone Number:</label>
                <input type="text" id="studentPhone" name="studentPhone" required>
            </div>

            <!-- Year Level Field -->
            <div class="form-group">
                <label for="yearLevel">Year Level:</label>
                <select id="yearLevel" name="yearLevel">
                    <option value="" disabled selected hidden> </option>
                    <option value="7">Grade 7</option>
                    <option value="8">Grade 8</option>
                    <option value="9">Grade 9</option>
                    <option value="10">Grade 10</option>
                </select>
            </div>

            <!-- Buttons -->
            <div class="button-group">
                <button id="createButton" type="submit">Create</button>
                <button type="button" onclick="window.location.href='ADMIN_AccountInterface.php';">Back</button>
            </div>
        </form>

        <!-- PHP Code Section -->
        <?php 
            // Include necessary files
            include '../classes.php';
            require_once '../db_config.php';

            // Form Handling
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Check if required fields are filled
                if (empty($_POST['studentFName']) || empty($_POST['studentLName']) || empty($_POST['studentEmail']) || empty($_POST['studentPhone']) || !isset($_POST['yearLevel'])) {
                    echo "<p style='color: red; text-align: center;'>Please fill out all necessary fields!</p>";
                } else {
                    // Assign POST data to variables
                    $FN = $_POST['studentFName'];
                    $LN = $_POST['studentLName'];
                    $Email = $_POST['studentEmail'];
                    $Phone = $_POST['studentPhone'];
                    $GradeLVL = intval($_POST['yearLevel']);
                    $MI = empty($_POST['studentMI']) ? "" : $_POST['studentMI'];

                    // Instantiate new Student object and prepare query
                    $std = new Student($FN, $LN, $MI, $Email, $Phone, $GradeLVL);
                    $PW = $std->std_pw;
                    $qry = "INSERT INTO student (Student_FName, Student_LName, Student_MInitial, Student_Email, Student_Password, Student_PhoneNum, Student_GradeLevel) VALUES (?, ?, ?, ?, ?, ?, ?)";

                    // Execute query
                    if ($stmt = $db->prepare($qry)) {
                        $stmt->bind_param("sssssss", $FN, $LN, $MI, $Email, $PW, $Phone, $GradeLVL);
                        if ($stmt->execute()) {
                            echo "<center><br><br><h2>New Student Created:</h2> Name: $FN $MI. $LN <br> Email: $Email <br> Phone: $Phone <br> Grade: $GradeLVL</center>";
                        } else {
                            echo "<p style='color: red; text-align: center;'>Error! Could not execute.</p>";
                        }
                        $stmt->close();
                    }
                    $db->close();
                }
            }
        ?>
    </div>

    <!-- Footer -->
    <div class="footer">
    </div>
</body>

</html>
