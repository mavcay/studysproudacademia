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
                    font-family: 'Roboto', sans-serif; /* Roboto is modern and legible for LMS websites */
                        }   
              
                h2{
                    font-family: 'Roboto', sans-serif; /* Roboto is modern and legible for LMS websites */
                    
                }


                h4 {
                    margin-top: 30px; /* Adjust the value as needed */
                    margin-left: 15%;
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


                #video-container {
                    display: flex;
                    flex-wrap: wrap;
                    justify-content: space-around;
                    align-items: center;
                    height: 70vh;
                    margin-left: 15%; /* Add margin to the left */
                    margin-bottom: 15%;
                }

                #video-container iframe {
                    width: 70%;
                    height: 100%;
                    margin-bottom: 15%;
                }

                .subject-name{
                    margin-left: 10%;
                }

                .logo {
                    
                width: 500px;  /* Adjust the width as needed */
                height: auto;  /* Maintain the aspect ratio */
                }

            </style>
            <title>Study Sprouts Course</title>
        </head>

        <body>
        
            <h1>Study Sprouts Academia</h1>
            <h3>Lecture Videos</h3>
            <hr class="solid">
            <div class="wrapper">
                <div class="sidebar">
                    <a href="../Student.php">
                    <img class ="logo"src="Subject_Images/studysprout_logo.png" alt="Study Sprout Academia Logo">
                    </a>
                    <ul class="list-group">
                        <li class="list-group-item"><a href="../Profile.php">Profile</a> </li>
                        <li class="list-group-item"><a href="../Student.php">Course</a> </li>
                        <li class="list-group-item selected"><a href="Subject.php">Lecture Videos</a></li>
                        <li class="list-group-item"><a href="SubjectFiles.php">Subject Files</a></li>
                        <li class="list-group-item"><a href="Assessments.php">Assessments</a></li>
                        <li class="list-group-item"><a href="Grades.php">Grades</a></li>
                        <li class="list-group-item"><a href="../Student.php">Go Back</a></li>


                    </ul>
                </div>
            </div>
            <?php
        include_once '../../classes.php';
        require_once '../../db_config.php';

        // Get Subject_ID from the URL parameter
        //$subjectId = isset($_GET['subject_id']) ? $_GET['subject_id'] : 1; // Default to Subject_ID = 1 if not provided
        //$_SESSION['CurrentSub'] = $subjectId;
    
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