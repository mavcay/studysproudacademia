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
                    font-family: 'Roboto', sans-serif; /* Center the text horizontally */
            }

            .card-container {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-around;
                gap: 20px;
                padding: 20px;
            }

            .card {

                background-color: #ffde9;
                border: none;
                border-radius: 5px;
                width: calc(25% - 20px);
                overflow: hidden;
                box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
                margin-bottom: 20px;
                margin-left: 100px;
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

            .form-group {
                margin-top: 20px; /* Space between each form group */
                margin-bottom: 10px; /* Space between each form group */
                margin-left: 300px; /* Space between each form group */

            }

            .form-group label {
                display: block;
                margin-top: 10px; /* Space between each form group */
                margin-bottom: 8px; /* Space between the label and the input field */
                font-weight: bold; /* Optional: make the label text bold for better visibility */
            }

            .form-group input, 
            .form-group select {
                width: 30%; /* Ensure the input fields take up the full width */
                padding: 5px; /* Padding inside the input fields */
                font-size: 15px; /* Font size for the input text */
                margin-bottom: 5px; /* Space below each input field */
                border: 1px solid #ccc; /* Add border around input fields */
                border-radius: 5px; /* Rounded corners */
            }

            .button-group {
                margin-top: 20px; /* Space above the buttons */
                text-align: center;
            }

            button {
                background-color: #DDAA11;
                color: #000000;
                border: none;
                border-radius: 5px;
                padding: 10px 20px;
                font-size: 16px;
                cursor: pointer;
                transition: background-color 0.2s ease;
                width: 14.3%; /* Adjust width to make the buttons more compact */
                margin: 10px;
            }

            #video-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 70vh; /* Adjust the height as needed */
        }

        #video-container iframe {
            width: 50%; /* Adjust the width as needed */
            height: 100%;
        }

        .video-container iframe {
            width: 50%; /* Adjust the width as needed */
            height: 100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
            gap: 20px;
        }

        #content_form {
            /* Add your CSS styles here */
            margin: 20px;
        }

        #content_form select {
            /* Add your CSS styles here */
            padding: 10px;
            font-size: 16px;
        }

        #content_display {
            /* Add your CSS styles here */
            margin: 20px;
        }

        #video_form, #pdf_form, #activity_form {
            /* Add your CSS styles here */
            margin: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: white;
            width: 50%;
            height: 60%;
        }

        #video_form label, #pdf_form label, #activity_form label {
            /* Add your CSS styles here */
            display: block;
            margin-top: 10px;
            
        }

        #video_form input, #pdf_form input, #activity_form input {
            /* Add your CSS styles here */
            margin-top: 5px;
            padding: 5px;
            font-size: 14px;
            margin-bottom: 1%;
        }

        #video_form button, #pdf_form button, #activity_form button {
            /* Add your CSS styles here */
            background-color: #ffde59;
                    color: #000000;
                    border: none;
                    border-radius: 5px;
                    padding: 10px 20px;
                    font-size: 16px;
                    cursor: pointer;
                    transition: background-color 0.2s ease;
                    width: 100%;
                    margin-top: 1%;
        }

        #video_form, #pdf_form, #activity_form, h2 {
                color:#000000;   
        }

        .logo {

                    
width: 500px;  /* Adjust the width as needed */
height: auto;  /* Maintain the aspect ratio */
}

        </style>
        <title>Sagad High School Dashboard</title>
    </head>

    <body>
        <h1>Study Sprouts Academia</h1>
        <h3>Upload Content</h3>
        <hr class="solid">
        <div class="wrapper">
            <div class="sidebar">
                <a href="../Faculty.php">
                <img class="logo"src="Subject_Images/studysprout_logo.png" alt="Sagad High School Logo">
                </a>
                <ul class="list-group">
                    <li class="list-group-item"><a href="../Faculty.php">Section/Subjects</a></li>
                    <li class="list-group-item"><a href="../Profile.php">Profile</a></li>
                    <li class="list-group-item selected"><a href="Subject.php">Upload Content</a></li>
                    <li class="list-group-item"><a href="LectureVideos.php">Lecture Videos  </a></li>
                    <li class="list-group-item"><a href="SubjectFiles.php">Subject Files</a></li>
                    <li class="list-group-item"><a href="Assessments.php">Assessments</a></li>
                    <li class="list-group-item"><a href="Grades.php">Grades</a></li>
                    <li class="list-group-item"><a href="../Faculty.php">Go Back</a></li>


                </ul>
            </div>
        </div>
<center style="margin-top: 50px;">
<form action="Subject.php" method="post">
            <div class="form-group">
                <label for="content-title">Title of Content:</label>
                <input type="text" id="content-title" name="content-title" required>
            
                <label for="content-site">Content Website:</label>
                <input type="text" id="content-site" name="content-site" required>
         
                <label for="content-link">Content Link:</label>
                <input type="text" id="content-link" name="content-link">
            
                <label for="content-type">Content Type:</label>
                <select id="content-type" name="content-type" >
                    <option value="" disabled selected hidden> </option>
                    <option value="Video">Video</option>
                    <option value="PDF">PDF File</option>
                    <option value="Activity">Activity (Quizzes, SWs, etc.)</option>
                </select>
            
			<div class="button-group">
				<button id="createButton" type="submit" value="Submit">Create</button>
				<button type="button" onclick="window.location.href='Subject.php';">Back</button>
			</div>
    </div>
        </form>
</center>

<?php

include "../../classes.php";
require_once "../../db_config.php";

        
			$output = "";
			if (empty($_POST['content-title']) || empty($_POST['content-site']) || empty($_POST['content-link']) || !isset($_POST['content-type'])){
				$output = "<br> Please fill out all necessary fields! <br>";
			}
			else{
				$title = $_POST['content-title'];
				$website = $_POST['content-site'];
				$TeachID = $_SESSION['userID'];
				$subID = $_SESSION['CurrentSub'];
                $conlink = $_POST['content-link'];
				$type = $_POST['content-type'];
				$content = new Content($title, $type, $conlink, $subID, $TeachID);
				if($_SERVER["REQUEST_METHOD"] == "POST"){
				$qry = "Insert into content(Content_Type, Content_Title, Content_Website, Content_Link, Subject_ID, Teacher_ID) values (?, ?, ?, ?, ?, ?)";
		 
				if($stmt = $db->prepare($qry)){
					$stmt->bind_param("ssssii", $param_type, $param_title, $param_website, $param_link, $param_SID, $param_TID);
					
					$param_type = $content->content_type; 
					$param_title = $content->content_title;
					$param_website = $website; 
					$param_link = $content->content_link;
					$param_SID = $content->content_subID;
					$param_TID = $content->content_TeachID; 
					
					if($stmt->execute()){
						echo "<center><br><br><h2>New Content Added to Subject! </h2></center>";
						exit();
					} else{
						echo "Error!";
					}
				}
				$stmt->close();
				}
				$db->close();
            }
    // Fetch subject name based on Subject_ID
    $subjectQuery = "SELECT Subject_Name FROM subject WHERE Subject_ID = ".$_SESSION['CurrentSub'].";";
    $subjectResult = $db->query($subjectQuery);
	
    $subjectName = "Unknown Subject"; // Default value
    if ($subjectResult->num_rows > 0) {
        $subjectRow = $subjectResult->fetch_assoc();
        $subjectName = $subjectRow["Subject_Name"];
    }

    



    $db->close();
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>