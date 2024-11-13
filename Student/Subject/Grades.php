<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="studentstyles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif; /* Roboto is modern and legible for LMS websites */
            background-color: #EAE7E1;
            color: #1E1E1E;
        }

        h1, h3 {
            color: #1E1E1E; /* Change the font color to black */
                    margin: 20px 5;
                    text-align: left; /* Align text to the left */
                    margin-left: 300px; /* Align to the left side, remove excessive margin */
                    font-family: 'Roboto', sans-serif; 
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            gap: 20px;
            padding: 20px;
            margin-left: 15%;
        }

        .card {
            background-color: #DDAA11;
            border: none;
            border-radius: 5px;
            width: calc(25% - 20px);
            overflow: hidden;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card a {
            text-decoration: none;
            color: #000000;
        }

        .card img {
            width: 100%;
            height: auto;
        }

        .card-content {
            padding: 10px;
            text-align: center;
        }

        .sidebar {
            width: 15%;
            padding: 15px;
            background-color: #2B2C9D; /*sidebar color*/
            color: #fff;
            text-align: center;
            position: fixed;
            left: 0;
            top: 0;
            height: 100%;
            overflow-x: hidden;
        }

        .sidebar img {
            width: 200px;
            height: auto;
            margin-bottom: 15px;
            margin-top: 20px;
        }

        .list-group-item {
            background-color: #312583;
            border: none;
            color: #fff;
            cursor: pointer;
        }

        .list-group-item a {
            color: #fff;
            text-decoration: none;
        }

        .list-group-item:hover {
            background-color: #001e3d;
        }

        .selected {
            background-color: #001e3d;
        }
        .grades-container {
    margin-top: 50px; /* Adjust margin-top as needed */
    margin-left: 15%; /* Adjust left margin */
    display: flex;
    justify-content: center;
    align-items: center;
}


        .grades-table {
            width: 80%; /* Adjust width as needed */
            border-collapse: collapse;
        }

        .grades-table th,
        .grades-table td {
            border: 1px solid #ffffff; /* Adjust border color as needed */
            padding: 10px;
        }

        .grades-table th {
            background-color: #001e3d; /* Adjust background color for table header */
            color: #ffffff; /* Adjust text color for table header */
            text-align: center;
        }

        .grades-table td {
            background-color: #EEBF6D; /* Adjust background color for table cells */
            color: #000000; /* Adjust text color for table cells */
            text-align: center;
        }
    </style>
    <title>Study Sprouts Course</title>
</head>

<body>
    <h1>Study Sprouts Academia</h1>
    <h3>Grades</h3>
    <hr class="solid">
    <div class="wrapper">
        <div class="sidebar">
            <a href="../Student.php">
            <img src="Subject_Images/studysprout_logo.png" alt="Sagad High School Logo">
            </a>
            <ul class="list-group">
                <li class="list-group-item"><a href="../Profile.php">Profile</a></li>
                <li class="list-group-item"><a href="../Student.php">Course</a></li>
                <li class="list-group-item"><a href="Subject.php">Lecture Videos</a></li>
                <li class="list-group-item"><a href="SubjectFiles.php">Subject Files</a></li>
                <li class="list-group-item"><a href="Assessments.php">Assessments</a></li>
                <li class="list-group-item selected"><a href="Grades.php">Grades</a></li>
                <li class="list-group-item"><a href="../Student.php">Go Back</a></li>

            </ul>
        </div>
    </div>
    <div class="grades-container">
        <center>
            <?php
            include '../../classes.php';
            require_once '../../db_config.php';

            // Fetch subject name based on Subject_ID
            $subjectQuery = "SELECT Subject_Name FROM subject WHERE Subject_ID = ".$_SESSION['CurrentSub'].";";
            $subjectResult = $db->query($subjectQuery);

            $subjectName = "Unknown Subject"; // Default value
            if ($subjectResult->num_rows > 0) {
                $subjectRow = $subjectResult->fetch_assoc();
                $subjectName = $subjectRow["Subject_Name"];
            }
            echo '<h2> Grade for ' . $subjectName . '</h2>';

            $studID = $_SESSION['userID'];
            $subID = $_SESSION['CurrentSub'];
            $sql = "SELECT s.Student_ID, s.Student_FName, s.Student_MInitial, s.Student_LName, e.Stud_FinalGrade, e.Remarks
            FROM student s
            INNER JOIN enrollment e ON s.Student_ID = e.Student_ID
            WHERE e.Subject_ID = ".$subID." AND s.Student_ID = ".$studID.";";
            $result = $db->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                echo '<table class="grades-table">';
                echo '<tr>';
                echo '<th>Student ID</th>';
                echo '<th>Name</th>';
                echo '<th>Final Grade</th>';
                echo '<th>Remarks</th>';
                echo '</tr>';
                while($row = $result->fetch_assoc()) {
                    $ID = $row["Student_ID"];
                    $FN = $row["Student_FName"];
                    $MI = $row["Student_MInitial"];
                    $LN = $row["Student_LName"];
                    $FinGrade = $row["Stud_FinalGrade"];
                    $remarks = $row["Remarks"];
                    echo "<tr>";
                    echo "<td>".$ID."</td>";
                    echo "<td>".$FN." ".$MI.". ".$LN."</td>";
                    echo "<td>".$FinGrade."</td>";
                    echo "<td>".$remarks."</td>";
                    echo "</tr>";
                }
                echo '</table>';
            } else {
                echo "No data available";
            }
            ?>
        </center>
    </div>
    <!-- Removed card-container section -->

    <!-- Bootstrap JS files (jQuery and Popper.js are required) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
