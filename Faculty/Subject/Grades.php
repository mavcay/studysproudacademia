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
            font-family: 'Roboto', sans-serif;
            background-color: #EAE7E1;
            color: #1E1E1E;
        }

        h1, h3 {
            color: #1E1E1E;
            margin: 20px 5;
            text-align: left;
            margin-left: 300px;
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
            background-color: #2B2C9D;
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

        table {
            width: 80%;
            border-collapse: collapse;
            margin-top: 50px;
            margin-left: 15%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        th, td {
            border: 1px solid #ffffff;
            padding: 10px;
            color: white;
        }

        th {
            background-color: #2B2C9D; /* Updated header background color */
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #DFB126; /* Row background color */
        }
        tr:nth-child(odd) {
            background-color: #DFB126; /* Row background color */
        }

        tr:hover {
            background-color: #C6971A; /* Hover background color */
        }

        td button {
            background-color: #2b2c9d;
            border: none;
            color: white;
            padding: 8px 12px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
        }

        td button:hover {
            background-color: #1a1e78;
        }
    </style>
    <title>Study Sprout Academia</title>
</head>

<body>
    <div class="container-fluid">
        <h1>Study Sprout Academia</h1>
        <h3>Grades</h3>
        <hr class="solid">
        <div class="wrapper">
            <div class="sidebar">
                <a href="../Faculty.php">
                    <img src="Subject_Images/studysprout_logo.png" alt="Study Sprout Academia Logo">
                </a>
                <ul class="list-group">
                    <li class="list-group-item"><a href="../Faculty.php">Section/Subjects</a></li>
                    <li class="list-group-item"><a href="../Profile.php">Profile</a></li>
                    <li class="list-group-item"><a href="Subject.php">Upload Content</a></li>
                    <li class="list-group-item"><a href="LectureVideos.php">Lecture Videos</a></li>
                    <li class="list-group-item"><a href="SubjectFiles.php">Subject Files</a></li>
                    <li class="list-group-item"><a href="Assessments.php">Assessments</a></li>
                    <li class="list-group-item selected"><a href="Grades.php">Grades</a></li>
                    <li class="list-group-item"><a href="../Faculty.php">Go Back</a></li>

                </ul>
            </div>
        </div>

        <?php
        include '../../classes.php';
        require_once '../../db_config.php';
        $subjectQuery = "SELECT Subject_Name FROM subject WHERE Subject_ID = ".$_SESSION['CurrentSub'].";";
        $subjectResult = $db->query($subjectQuery);

        $subjectName = "Unknown Subject"; // Default value
        if ($subjectResult->num_rows > 0) {
            $subjectRow = $subjectResult->fetch_assoc();
            $subjectName = $subjectRow["Subject_Name"];
        }

        echo '<style>
            h2 {
                text-align: center;
                margin: 20px 0;
                margin-left: 250px;
            }
        </style>';
        echo '<h2> Grades of Students Enrolled in ' . $subjectName . '</h2>';
        ?>

        <div class="content">
            <center>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th>Final Grade</th>
                            <th>Remarks</th>
                            <th>Update Grades</th>
                        </tr>
                        <?php
                        $subID = $_SESSION['CurrentSub'];
                        $sql = "SELECT s.Student_ID, s.Student_FName, s.Student_MInitial, s.Student_LName, e.Stud_FinalGrade, e.Remarks
                                FROM student s
                                INNER JOIN enrollment e ON s.Student_ID = e.Student_ID
                                WHERE e.Subject_ID = ".$subID.";";
                        $result = $db->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                $ID = $row["Student_ID"];
                                $FN = $row["Student_FName"];
                                $MI = $row["Student_MInitial"];
                                $LN = $row["Student_LName"];
                                $FinGrade = $row["Stud_FinalGrade"];
                                $remarks = $row["Remarks"];
                                echo "<tr>";
                                echo "<td>".$ID."</td>";
                                echo "<td>".$FN." ".$MI.", ".$LN."</td>";
                                echo "<td>".$FinGrade."</td>";
                                echo "<td>".$remarks."</td>";
                                echo "<td><a href='UpdateGrades.php'><button>Edit</button></a></td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </table>
                </div>
            </center>
        </div>
    </div>

    <!-- Bootstrap JS files (jQuery and Popper.js are required) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
