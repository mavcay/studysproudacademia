<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Study Sprouts Admin</title>
    <style>
        /* Page Reset and Body Styling */
        html, body {
            margin: 0;
            padding: 0;
        }

        /* Body styling */
        body {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            background-color: #EAE7E1; /* Light background color */
            color: black; /* Default text color */
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Header styling */
        .header {
            width: 100%;
            padding: 20px;
            background-color: #EAE7E1; /* White background */
            text-align: center;
            border-bottom: 2px solid #2B2C9D; /* Dark blue border */
        }

        /* Header Titles Styling */
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

        /* Circle Logo Styling */
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

        /* Container styling */
        .container {
            background-color: #EAE7E1;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 500px;
            text-align: left;
        }

        /* Form Labels */
        label {
            display: block;
            margin: 10px 0 5px;
            color: #2B2C9D;
            font-weight: bold;
        }

        /* Input Field Styling */
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #CCC;
            border-radius: 5px;
            box-sizing: border-box;
        }

        /* Button Styling */
        button {
            background-color: #DFB126; /* Gold */
            color: black;
            border: none;
            padding: 10px 20px;
            font-size: 1em;
            font-weight: bold;
            border-radius: 25px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
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

        /* Responsive Styling */
        @media (max-width: 768px) {
            .header h1 {
                font-size: 36px;
            }
            .header h2 {
                font-size: 20px;
            }
            .container {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <!-- Header Section with Logo and Titles -->
    <div class="header">
        <div class="circle-logo"></div>
        <h1 class="study-sprouts-header">Study Sprouts Academia</h1>
        <h2 class="admin-header">Admin Account</h2>
    </div>

    <!-- Main Title for Form -->
    <h3 style="color: #2B2C9D; font-size: 32px;">Create Subject</h3>

    <!-- Content Container with Subject Creation Form -->
    <div class="content">
        <div class="container">
            <form action="ADMIN_CreateSubject.php" method="post">
                <label for="subject-name">Subject Name:</label>
                <input type="text" id="subject-name" name="subject-name" required>
                
                <label for="subject-desc">Subject Description:</label>
                <input type="text" id="subject-desc" name="subject-desc" required>
                
                <label for="subject-sched">Subject Schedule:</label>
                <input type="text" id="subject-sched" name="subject-sched" required>
                
                <label for="subject-sec">Subject Section:</label>
                <input type="text" id="subject-sec" name="subject-sec" required>
                
                <!-- Submit and Back Buttons -->
                <button type="submit">Create</button>
                <button type="button" onclick="window.location.href='ADMIN_AccountInterface.php';">Back</button>
            </form>

            <!-- PHP Code to Handle Form Submission -->
            <?php 
            include '../classes.php';
            require_once '../db_config.php';
        
            $output = "";
            if (empty($_POST['subject-name']) || empty($_POST['subject-desc']) || empty($_POST['subject-sched']) || empty($_POST['subject-sec'])){
                $output = "<br> Please fill out all necessary fields! <br>";
            } else {
                $name = $_POST['subject-name'];
                $desc = $_POST['subject-desc'];
                $sched = $_POST['subject-sched'];
                $sec = $_POST['subject-sec'];
                $sub = new Subject($name, $desc, $sched, $sec);
                $output = "<br> Subject Name: $sub->sub_name <br> Description: $sub->sub_desc <br> Schedule: $sub->sub_sched <br> Section: $sub->sub_section";

                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    $qry = "Insert into subject(Subject_Name, Subject_Description, Subject_Schedule, Subject_Section) values (?, ?, ?, ?)";
                
                    if($stmt = $db->prepare($qry)){
                        $stmt->bind_param("ssss", $param_Name, $param_Desc, $param_Sched, $param_Sec);
                        
                        $param_Name = $name; 
                        $param_Desc = $desc;
                        $param_Sched = $sched; 
                        $param_Sec = $sec;
                        
                        if($stmt->execute()){
                            echo "<center><br><br><h2>New Subject Created:</h2> $output</center> <br> ";
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
    </div>

    <!-- Footer Section -->
    <div class="footer">
        <!-- Placeholder for Footer Content -->
    </div>
</body>

</html>
