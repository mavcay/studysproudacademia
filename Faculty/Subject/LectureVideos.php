<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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

        .list-group-item:hover,
        .list-group-item.selected {
            background-color: #001e3d;
        }
        #video-container {
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    height: 70vh;
    width: 70%; /* Decrease width to allow more space */
    margin-left: 20%; /* Adjust this for better alignment */
}

#video-container iframe {
    width: 100%;  /* Allow iframe to take full width of the container */
    height: 70vh;  /* Keep the height as 70vh */
    margin-bottom: 15%;
}



        .subject-name {
            margin-left: 10%;
        }
    </style>
    <title>Study Sprout Academia</title>
</head>

<body>
    <h1>Study Sprout Academia</h1>
    <h3>Lecture Videos</h3>
    <hr class="solid">
    <div class="sidebar">
        <a href="../Faculty.php">
            <img src="Subject_Images/studysprout_logo.png" alt="Sagad High School Logo">
        </a>
        <ul class="list-group">
            <li class="list-group-item"><a href="../Faculty.php">Section/Subjects</a></li>
            <li class="list-group-item"><a href="../Profile.php">Profile</a></li>
            <li class="list-group-item"><a href="Subject.php">Upload Content</a></li>
            <li class="list-group-item selected"><a href="LectureVideos.php">Lecture Videos</a></li>
            <li class="list-group-item"><a href="SubjectFiles.php">Subject Files</a></li>
            <li class="list-group-item"><a href="Assessments.php">Assessments</a></li>
            <li class="list-group-item"><a href="Grades.php">Grades</a></li>
            <li class="list-group-item"><a href="../Faculty.php">Go Back</a></li>

        </ul>
    </div>

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
    echo '<style>
    .subject-name {
        font-family: \'Roboto\', sans-serif; /* Apply Roboto font */
        margin-left: 15%;  /* Add left margin */
        text-align: center;  /* Center the text */
    }
</style>';
echo '<div class="subject-name"><h2>' . $subjectName . '</h2></div>';
echo "<hr>";

    // Fetch content for the selected subject
    $contentQuery = "SELECT * FROM content WHERE Content_Type = 'Video' AND Subject_ID = ".$_SESSION['CurrentSub'].";";
    $contentResult = $db->query($contentQuery);
    if ($contentResult->num_rows > 0) {
        while ($row = $contentResult->fetch_assoc()) {
            $Title = $row["Content_Title"];
            $Website = $row["Content_Website"];
            $Link = $row["Content_Link"];

            echo "<h4 style='font-size: 1 em; color: #IEIEIE; text-align: center; margin-left: 15%;'>" . $Title . "</h3>";

            echo "<div id=\"video-container\">";
            echo "<br>";                
            echo "<iframe width=\"560\" height=\"315\" src=\"" . $Link . "\" frameborder=\"0\" allowfullscreen></iframe>";
            echo "<br>";
            echo "<br>";
            echo "</div>";
        }
    } else {
        echo "<p> <center>No content available for this subject.</p>";
    }

    $db->close();
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
