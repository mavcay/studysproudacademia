<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="studentstyles.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            background-color: #004aad;
            color: #ffffff;
        }

        h1, h3 {
            color: #ffffff;
            margin: 20px 0; /* Add margin for better spacing */
    text-align: center; /* Center the text horizontally */
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
            background-color: #ffde59;
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
            background-color: #ffde59;
            color: #fff;
            text-align: center;
            position: fixed;
            left: 0;
            top: 0;
            height: 100%;
            overflow-x: hidden;
        }

        .sidebar img {
            width: 120px;
            height: auto;
            margin-bottom: 15px;
            margin-top: 20px;
        }

        .list-group-item {
            background-color: #ffde59;
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
    <title>Sagad High School Dashboard</title>
</head>

<body>
    <h1>SAGAD HIGH SCHOOL</h1>
    <h3>Assessments</h3>
    <hr class="solid">
    <div class="wrapper">
        <div class="sidebar">
            <a href="Student.php">
                <img src="APan_Images/logo.png" alt="Sagad High School Logo">
            </a>
            <ul class="list-group">
                <li class="list-group-item"><a href="APan.php">Lecture Videos</a></li>
                <li class="list-group-item"><a href="SubjectFiles.php">Subject Files</a></li>
                <li class="list-group-item selected"><a href="Assessments.php">Assessments</a></li>
                <li class="list-group-item"><a href="Grades.php">Grades</a></li>
            </ul>
        </div>
    </div>

    <div class="card-container">
	<!-- Add Quiz Buttons -->
	<?php
		include "classes.php";
		require_once "db_config.php";
		$sql = "SELECT * FROM content WHERE Content_Type = \"Activity\" AND Subject_ID = 1";
		$result = $db->query($sql);
		if ($result->num_rows > 0) {
		  // output data of each row
		  while($row = $result->fetch_assoc()) {
			$Title = $row["Content_Title"];
			$Link = $row["Content_Link"];
			
			echo "<div class=\"card\">";
			echo "<div class=\"card-content\">";
			echo "	<h4>".$Title."</h4>";
			echo "    <a href=\"".$Link."\" target=\"_blank\" class=\"btn btn-primary\">Take Quiz</a>";
			echo "<br>";
			echo "</div>";
			echo "</div>";
		  }
		}
		$db->close();
		?>
        
    </div>

    <!-- Bootstrap JS files (jQuery and Popper.js are required) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
