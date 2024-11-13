<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Information -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Study Sprouts Academia</title>

    <!-- Internal CSS Styles -->
    <style>
        /* Basic Layout and Font */
        body {
            margin: 0;
            padding: 0;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            background-color: #EAE7E1;
            color: black;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        /* Header Styling */
        .header {
            width: 100%;
            padding: 20px;
            background-color: #EAE7E1;
            text-align: center;
            border-bottom: 2px solid #2B2C9D;
        }

        .header h1 {
            font-size: 1.8em;
            color: black;
            margin: 0;
            font-weight: bold;
        }

        .header h2 {
            font-size: 1.2em;
            font-weight: bold;
            color: #2B2C9D;
            margin: 5px 0 20px;
        }

        /* Logo Styling */
        .circle-logo {
            width: 100px;
            height: 100px;
            background-color: #2B2C9D;
            border-radius: 50%;
            position: absolute;
            top: 10px;
            left: 10px;
            background-image: url('adminImages/studysprout_logo.png');
            background-size: cover;
            background-position: center;
        }

        /* Form Container Styling */
        .container {
            width: 90%;
            max-width: 600px;
            margin: 60px auto;
            padding: 15px;
            background-color: #EAE7E1;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        /* Form Element Styling */
        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-size: 16px;
            margin-bottom: 5px;
            font-weight: bold;
            color: #2B2C9D;
        }

        input[type="text"], input[type="email"], select, input[type="file"] {
            width: calc(100% - 20px);
            padding: 10px;
            font-size: 14px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        /* Button Group Styling */
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

        /* Footer Styling */
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
    <!-- Header Section with Logo and Titles -->
    <div class="header">
        <div class="circle-logo"></div>
        <h1>Study Sprouts Academia</h1>
        <h2>Admin Account</h2>
    </div>

    <!-- Main Page Title -->
    <h2 style="color: #2B2C9D; font-size: 32px;">New Teacher</h2>

    <!-- Form Section -->
    <div class="container">
        <form action="ADMIN_CreateTeacher.php" method="post">
            <!-- Teacher First Name Input -->
            <div class="form-group">
                <label for="teacherFName">Teacher First Name:</label>
                <input type="text" id="teacherFName" name="teacherFName" required>
            </div>

            <!-- Teacher Last Name Input -->
            <div class="form-group">
                <label for="teacherLName">Teacher Last Name:</label>
                <input type="text" id="teacherLName" name="teacherLName" required>
            </div>

            <!-- Teacher Middle Initial Input -->
            <div class="form-group">
                <label for="teacherMI">Teacher Middle Initial:</label>
                <input type="text" id="teacherMI" name="teacherMI">
            </div>

            <!-- Teacher Email Input -->
            <div class="form-group">
                <label for="teacherEmail">Teacher E-Mail:</label>
                <input type="email" id="teacherEmail" name="teacherEmail" required>
            </div>

            <!-- Teacher Phone Number Input -->
            <div class="form-group">
                <label for="teacherPhone">Teacher Phone Number:</label>
                <input type="text" id="teacherPhone" name="teacherPhone" required>
            </div>

            <!-- Form Buttons -->
            <div class="button-group">
                <button id="createButton" type="submit" value="Submit">Create</button>
                <button type="button" onclick="window.location.href='ADMIN_AccountInterface.php';">Back</button>
            </div>
        </form>

        <!-- PHP Section: Form Submission and Database Interaction -->
        <?php 
            // Include necessary files for database connection and class definition
            include '../classes.php';
            require_once '../db_config.php';

            // Check for required fields and output an error if any are missing
            $output = "";
            if (empty($_POST['teacherFName']) || empty($_POST['teacherLName']) || empty($_POST['teacherEmail']) || empty($_POST['teacherPhone'])) {
                $output = "<br> Please fill out all necessary fields! <br>";
            } else {
                // Assign POST data to variables
                $FN = $_POST['teacherFName'];
                $LN = $_POST['teacherLName'];
                $Email = $_POST['teacherEmail'];
                $Phone = $_POST['teacherPhone'];
                
                $MI = empty($_POST['teacherMI']) ? "" : $_POST['teacherMI'];
                
                // Instantiate a Teacher object and generate password
                $teach = new Teacher($FN, $LN, $MI, $Email, $Phone);
                $PW = $teach->teach_pw;
                
                $output = "<br> Name: $teach->teach_Fname $teach->teach_MI. $teach->teach_Lname <br> Email: $teach->teach_Email <br> Phone: $teach->teach_phoneNum";
                
                // Insert data into the database if the form is submitted via POST
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $qry = "INSERT INTO teacher (Teacher_FName, Teacher_LName, Teacher_MInitial, Teacher_Email, Teacher_Password, Teacher_PhoneNum) VALUES (?, ?, ?, ?, ?, ?)";
                    
                    if ($stmt = $db->prepare($qry)) {
                        // Bind parameters to query and execute
                        $stmt->bind_param("ssssss", $param_FN, $param_LN, $param_MI, $param_Email, $param_PW, $param_Phone);
                        
                        $param_FN = $FN; 
                        $param_LN = $LN;
                        $param_MI = $MI; 
                        $param_Email = $Email;
                        $param_PW = $PW;
                        $param_Phone = $Phone; 
                        
                        // Execute and display success message if successful
                        if ($stmt->execute()) {
                            echo "<center><br><br><h2>New Teacher Created:</h2> $output</center>";
                            exit();
                        } else {
                            echo "Error!";
                        }
                    }
                    $stmt->close();
                }
                $db->close();
            }
        ?>
    </div>

    <!-- Footer Section -->
    <div class="footer">
    </div>
</body>
</html>
