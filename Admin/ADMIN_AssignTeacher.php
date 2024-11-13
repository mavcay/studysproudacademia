<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Study Sprouts Academia</title>
    <style>
        /* General body styling */
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

        /* Header Section */
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


        /* Footer Section Styling */
        .footer {
            width: 100%;
            height: 50px;
            background-color: #2B2C9D;
            text-align: center;
            color: white;
            font-weight: bold;
            line-height: 50px;
            position: fixed;
            bottom: 0;
        }

        /* Main container for form elements */
        .container {
            width: 90%;
            max-width: 600px;
            margin: 60px auto;
            padding: 15px;
            background-color: #EAE7E1;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        /* Form group (input fields and labels) */
        .form-group {
            margin-bottom: 15px;
        }

        /* Label styling */
        label {
            display: block;
            font-size: 16px;
            margin-bottom: 5px;
            font-weight: bold;
            color: #2B2C9D;
        }

        /* Input fields, select dropdown, and file input styling */
        input[type="text"],
        input[type="email"],
        select,
        input[type="file"] {
            width: calc(100% - 20px);
            padding: 10px;
            font-size: 14px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        /* Radio button group styling */
        .radio-group {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
        }

        input[type="radio"] {
            margin-right: 5px;
        }

        /* Button styling */
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

        /* Photo preview section */
        .photo-preview {
            margin-top: 20px;
            text-align: center;
        }

        .photo-preview img {
            max-width: 250px;
            width: 100%;
            height: auto;
            border-radius: 5px;
            margin-top: 10px;
        }

        /* Title styling */
        h2.title {
            color: #2B2C9D; /* Dark blue */
            text-align: center;
            margin-top: 10px;
            font-size: 30px;
        }
    </style>
</head>

<body>
    <!-- Header Section -->
    <div class="header">
        <div class="circle-logo"></div>
        <h1>Study Sprouts Academia</h1>
        <h2>Admin Account</h2>
    </div>

    <br>
    <br>

    <!-- Page Title Section -->
    <h2 class="title">Assign Teacher</h2>

    <!-- Form Container -->
    <div class="container">
        <form action="ADMIN_AssignTeacher.php" method="post">
            
            <!-- Teacher Selection -->
            <div class="form-group">
                <label for="selectTeach">Select Teacher To Assign:</label>
                <select id="selectTeach" name="selectTeach">
                    <option value="" disabled selected hidden> </option>
                    <?php 
                    include '../classes.php';
                    require '../db_config.php';
                    $sql = "SELECT * FROM teacher";
                    
                    $result = $db->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $teachID = $row["Teacher_ID"];
                            $FN = $row["Teacher_FName"];
                            $MI = $row["Teacher_MInitial"];
                            $LN = $row["Teacher_LName"];
                            echo "<option value =".$teachID."> ID: ".$teachID." | Name: ".$FN." ".$MI." ".$LN."</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <!-- Subject Selection -->
            <div class="form-group">
                <label for="selectSub">Select Subject:</label>
                <select id="selectSub" name="selectSub">
                    <option value="" disabled selected hidden> </option>
                    <?php 
                    $sql = "SELECT * FROM subject";
                    
                    $result = $db->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $subID = $row["Subject_ID"];
                            $Name = $row["Subject_Name"];
                            $sched = $row["Subject_Schedule"];
                            $sec = $row["Subject_Section"];
                            echo "<option value =".$subID."> ID: ".$subID." Name: ".$Name." | Schedule: ".$sched." | Section: ".$sec."</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <!-- Buttons Section -->
            <div class="button-group">
                <button id="createButton" type="submit" value="Submit">Assign</button>
                <button type="button" onclick="window.location.href='ADMIN_AccountInterface.php';">Back</button>
            </div>
        </form>

        <!-- Output section after form submission -->
        <?php 
        $output = "";
        if (!isset($_POST['selectTeach']) || !isset($_POST['selectSub'])){
            echo "<br> Please fill out all necessary fields! <br>";
        } else {
            $TeachID = intval($_POST['selectTeach']);
            $SubID = intval($_POST['selectSub']);
            $output = "<br>Teacher ID: $TeachID <br>Subject ID: $SubID <br>";
            
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $qry = "Insert into assignment(Teacher_ID, Subject_ID) values (?, ?)";
         
                if($stmt = $db->prepare($qry)){
                    $stmt->bind_param("ss", $param_Teach, $param_Sub);
                    
                    $param_Teach = $TeachID; 
                    $param_Sub = $SubID;
                    
                    if($stmt->execute()){
                        echo "<center><br><br><h2>Teacher Assigned:</h2> $output</center>";
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

    <br>
    <br>

    <!-- Footer Section -->
    <div class="footer">
        <!-- Footer content goes here -->
    </div>

</body>
</html>
