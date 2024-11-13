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

.wrapper {
    display: flex; /* Use flexbox for layout */
}

h1, h3 {
    color: #1E1E1E; /* Change the font color to black */
                    margin: 20px 5;
                    text-align: left; /* Align text to the left */
                    margin-left: 300px; /* Align to the left side, remove excessive margin */
                    font-family: 'Roboto', sans-serif;

}

h4 {
        margin-top: 15px; /* Adjust the value as needed */
        margin-left: 15%;           
        margin-right: 15%;
        margin-bottom: 15px; /* Add space below the title */
        color: #ffffff;    
}

.card-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    gap: 20px;
    padding: 20px;
    margin-top: 50px; /* Adjust the margin as needed */
    margin-left: 15%;
    flex-grow: 1; /* Allow the card-container to take up remaining space */
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
    </style>
    <title>Study Sprouts Course</title>
</head>

<body>
    <h1>Study Sprouts Academia</h1>
    <h3>Assessments</h3>
    <hr class="solid">
    <div class="wrapper">
        <div class="card-container"> <!-- Moved card-container outside of sidebar div -->
            <?php
            include_once '../../classes.php';
            require_once '../../db_config.php';

            // Fetch subject name based on Subject_ID
            $subjectQuery = "SELECT Subject_Name FROM subject WHERE Subject_ID = ".$_SESSION['CurrentSub'].";";
            $subjectResult = $db->query($subjectQuery);

            $subjectName = "Unknown Subject"; // Default value
            if ($subjectResult->num_rows > 0) {
                $subjectRow = $subjectResult->fetch_assoc();
                $subjectName = $subjectRow["Subject_Name"];
            }


            // Fetch content for the selected subject (Quizzes)
            $contentQuery = "SELECT * FROM content WHERE Content_Type = 'Activity' AND Subject_ID = ".$_SESSION['CurrentSub'].";";
            $contentResult = $db->query($contentQuery);

            if ($contentResult->num_rows > 0) {
                while ($row = $contentResult->fetch_assoc()) {
                    $Title = $row["Content_Title"];
                    $Link = $row["Content_Link"];
                    
                    echo "<div class=\"card\">";
                    echo "<div class=\"card-content\">";
                    echo "<h4>" . $Title . "</h4>";
                    echo "<a href=\"" . $Link . "\" target=\"_blank\" class=\"btn\" style=\"background-color: #312583; color: white; padding: 10px 20px; width: auto;\">Take Quiz</a>";
                    echo "<br>";

                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>No quizzes available for this subject.</p>";
            }

            $db->close();
        ?>
        </div>
        <div class="sidebar">
            <a href="../Student.php">
            <img src="Subject_Images/studysprout_logo.png" alt="Sagad High School Logo">
            </a>
            <ul class="list-group">
            <li class="list-group-item"><a href="../Profile.php">Profile</a> </li>
                        <li class="list-group-item"><a href="../Student.php">Course</a> </li>
                <li class="list-group-item"><a href="Subject.php">Lecture Videos</a></li>
                <li class="list-group-item"><a href="SubjectFiles.php">Subject Files</a></li>
                <li class="list-group-item selected"><a href="Assessments.php">Assessments</a></li>
                <li class="list-group-item"><a href="Grades.php">Grades</a></li>
                <li class="list-group-item"><a href="../Student.php">Go Back</a></li>

            </ul>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
