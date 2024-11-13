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
                    font-family: 'Roboto'

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
        .pdf-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 70vh;
    margin-left: 15%; /* Center horizontally */
    margin-top: 0; /* Reset top margin */
    margin-bottom: 0; /* Reset bottom margin */
}


        .pdf-iframe {
            width: 50%;
            height: 80vh;
        }
    </style>
    <title>Study Sprouts Course</title>
</head>

<body>
<h1>Study Sprouts Academia</h1>
<h3>Subject Files</h3>
    <hr class="solid">
    <div class="wrapper">
        <div class="sidebar">
            <a href="../Student.php">
            <img src="Subject_Images/studysprout_logo.png" alt="Sagad High School Logo">
            </a>
            <ul class="list-group">
            <li class="list-group-item"><a href="../Profile.php">Profile</a> </li>
                        <li class="list-group-item"><a href="../Student.php">Course</a> </li>
                <li class="list-group-item"><a href="Subject.php">Lecture Videos</a></li>
                <li class="list-group-item selected"><a href="SubjectFiles.php">Subject Files</a></li>
                <li class="list-group-item"><a href="Assessments.php">Assessments</a></li>
                <li class="list-group-item"><a href="Grades.php">Grades</a></li>
                <li class="list-group-item"><a href="../Student.php">Go Back</a></li>

            </ul>
        </div>
    </div>
	<center>
    <?php
    include "../../classes.php";
    require_once "../../db_config.php";

    // Assuming you get the subject ID from somewhere, replace '1' with your dynamic subject ID

    $sql = "SELECT * FROM content WHERE Content_Type = 'PDF' AND Subject_ID = ".$_SESSION['CurrentSub'].";";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $Title = $row["Content_Title"];
            $Website = $row["Content_Website"];
            $Link = $row["Content_Link"];

            echo "<div id=\"pdf-container\">";
            echo "<br>";
            echo "<h4 style='font-size: 1 em; color: #1E1E1E; text-align: center; margin-left: 15%;'>" . $Title;
            echo "<div style='height: 15px;'></div>";
            echo "<iframe width=\"700px\" height=\"900px\" src=\"" . $Link . "\"></iframe>";
            echo "<br>";
            echo "<br>";
            echo "</div>";
        }
    } else {
        echo "No content available for this subject.";
    }

    $db->close();
?>
	</center>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
